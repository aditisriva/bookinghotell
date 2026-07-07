/**
 * supabase-client.js — bookHotel
 * Single shared Supabase client used across all pages.
 * Import via: <script src="supabase-client.js"></script>
 */

const SUPABASE_URL  = 'https://qanadevczpeaxypcnvlb.supabase.co';
const SUPABASE_ANON = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFhbmFkZXZjenBlYXh5cGNudmxiIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODMzMTU1OTUsImV4cCI6MjA5ODg5MTU5NX0.4oqh_XKGINFq4wHmrXvgpGHLrPlcGDwzIiJ0XTcB784';

// Load Supabase CDN client then expose window.sb
(function () {
  const script = document.createElement('script');
  script.src = 'https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2/dist/umd/supabase.min.js';
  script.onload = () => {
    window.sb = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON);
    document.dispatchEvent(new Event('supabase:ready'));
  };
  document.head.appendChild(script);
})();

/* ── Auth helpers ── */
async function sbSignUp(email, password, fullName) {
  const { data, error } = await window.sb.auth.signUp({
    email,
    password,
    options: { data: { full_name: fullName } }
  });
  return { data, error };
}

async function sbSignIn(email, password) {
  const { data, error } = await window.sb.auth.signInWithPassword({ email, password });
  if (data?.user) {
    // Store user in localStorage for navbar.js compatibility
    localStorage.setItem('bh_user', JSON.stringify({
      name:  data.user.user_metadata?.full_name || email.split('@')[0],
      email: data.user.email,
      id:    data.user.id
    }));
  }
  return { data, error };
}

async function sbSignOut() {
  await window.sb.auth.signOut();
  localStorage.removeItem('bh_user');
}

async function sbGetUser() {
  const { data: { user } } = await window.sb.auth.getUser();
  return user;
}

/* ── Hotel helpers ── */
async function sbGetHotels(filters = {}) {
  let query = window.sb.from('hotels').select('*');
  if (filters.city)       query = query.eq('city', filters.city);
  if (filters.maxPrice)   query = query.lte('price_per_night', filters.maxPrice);
  if (filters.minRating)  query = query.gte('rating', filters.minRating);
  if (filters.type)       query = query.eq('property_type', filters.type);
  if (filters.featured)   query = query.eq('is_featured', true);
  const { data, error } = await query.order('rating', { ascending: false });
  return { data, error };
}

/* ── Booking helpers ── */
async function sbGetBookings(userId) {
  const { data, error } = await window.sb
    .from('bookings')
    .select('*, hotels(name, image_url, city)')
    .eq('user_id', userId)
    .order('created_at', { ascending: false });
  return { data, error };
}

async function sbCreateBooking(booking) {
  const { data, error } = await window.sb.from('bookings').insert([booking]).select().single();
  return { data, error };
}

async function sbCancelBooking(bookingId) {
  const { data, error } = await window.sb
    .from('bookings')
    .update({ status: 'cancelled', payment_status: 'refund_initiated' })
    .eq('id', bookingId)
    .select()
    .single();
  return { data, error };
}

/* ── Wishlist helpers ── */
async function sbGetWishlist(userId) {
  const { data, error } = await window.sb
    .from('wishlist')
    .select('*, hotels(*)')
    .eq('user_id', userId);
  return { data, error };
}

async function sbToggleWishlist(userId, hotelId) {
  // Check if already in wishlist
  const { data: existing } = await window.sb
    .from('wishlist')
    .select('id')
    .eq('user_id', userId)
    .eq('hotel_id', hotelId)
    .maybeSingle();

  if (existing) {
    const { error } = await window.sb.from('wishlist').delete().eq('id', existing.id);
    return { added: false, error };
  } else {
    const { error } = await window.sb.from('wishlist').insert([{ user_id: userId, hotel_id: hotelId }]);
    return { added: true, error };
  }
}

/* ── Profile helpers ── */
async function sbGetProfile(userId) {
  const { data, error } = await window.sb.from('profiles').select('*').eq('id', userId).single();
  return { data, error };
}

async function sbUpdateProfile(userId, updates) {
  const { data, error } = await window.sb
    .from('profiles')
    .update({ ...updates, updated_at: new Date().toISOString() })
    .eq('id', userId)
    .select()
    .single();
  return { data, error };
}
