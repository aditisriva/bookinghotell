/**
 * auth.js — bookHotel  (Supabase-powered)
 * Handles login, signup, forgot password — all wired to Supabase Auth.
 * UI helpers (floating labels, validation, strength meter, transitions) are preserved.
 */

'use strict';

/* ── Supabase client (loaded inline — no module bundler needed) ── */
const SUPABASE_URL  = 'https://qanadevczpeaxypcnvlb.supabase.co';
const SUPABASE_ANON = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFhbmFkZXZjenBlYXh5cGNudmxiIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODMzMTU1OTUsImV4cCI6MjA5ODg5MTU5NX0.4oqh_XKGINFq4wHmrXvgpGHLrPlcGDwzIiJ0XTcB784';

let sb = null; // will be set once CDN loads

/* ════════════════════════════════════════
   UI  UTILITIES  (unchanged from before)
════════════════════════════════════════ */
function setInvalid(input, errEl, msg) {
  input.classList.add('is-invalid');
  input.classList.remove('is-valid');
  if (errEl) errEl.textContent = msg;
  const statusEl = input.closest('.fl-wrap')?.querySelector('.fl-status');
  if (statusEl) statusEl.innerHTML = '<i class="bi bi-x-circle-fill" style="color:#dc2626"></i>';
}
function setValid(input, errEl) {
  input.classList.remove('is-invalid');
  input.classList.add('is-valid');
  if (errEl) errEl.textContent = '';
  const statusEl = input.closest('.fl-wrap')?.querySelector('.fl-status');
  if (statusEl) statusEl.innerHTML = '<i class="bi bi-check-circle-fill" style="color:#16a34a"></i>';
}
function clearState(input, errEl) {
  input.classList.remove('is-invalid', 'is-valid');
  if (errEl) errEl.textContent = '';
  const statusEl = input.closest('.fl-wrap')?.querySelector('.fl-status');
  if (statusEl) statusEl.innerHTML = '';
}
function shakeField(input) {
  const wrap = input.closest('.fl-group') || input;
  wrap.animate([
    { transform: 'translateX(0)' }, { transform: 'translateX(-6px)' },
    { transform: 'translateX(6px)' }, { transform: 'translateX(-4px)' },
    { transform: 'translateX(4px)' }, { transform: 'translateX(0)' }
  ], { duration: 320, easing: 'ease-out' });
}
function showToast(message, type = 'success') {
  const container = document.getElementById('toastContainer');
  if (!container) return;
  const toast = document.createElement('div');
  toast.className = `toast-item toast-${type}`;
  const icon = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill';
  toast.innerHTML = `<i class="bi ${icon}"></i><span>${message}</span>`;
  container.appendChild(toast);
  setTimeout(() => {
    toast.style.animation = 'toastIn .3s ease reverse forwards';
    setTimeout(() => toast.remove(), 300);
  }, 3500);
}
function pageTransition(targetURL) {
  const overlay = document.getElementById('pageOverlay');
  if (!overlay) { window.location.href = targetURL; return; }
  overlay.classList.add('slide-in');
  setTimeout(() => { window.location.href = targetURL; }, 500);
}
function isValidEmail(str) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(str); }
function isValidMobile(str) { return /^[6-9]\d{9}$/.test(str.replace(/\D/g, '')); }
function scorePassword(password) {
  if (!password) return 0;
  let score = 0;
  if (password.length >= 8) score++;
  if (/[A-Z]/.test(password)) score++;
  if (/\d/.test(password)) score++;
  if (/[^A-Za-z0-9]/.test(password)) score++;
  return score;
}

/* ════════════════════════════════════════
   ENTRANCE ANIMATION
════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
  const overlay = document.getElementById('pageOverlay');
  if (overlay) {
    overlay.classList.add('slide-in');
    requestAnimationFrame(() => requestAnimationFrame(() => {
      overlay.classList.remove('slide-in');
      overlay.classList.add('slide-out');
      setTimeout(() => overlay.classList.remove('slide-out'), 500);
    }));
  }
  const fields = document.querySelectorAll('.fl-group, .check-row, .btn-submit, .or-divider, .social-row, .switch-txt, .form-head');
  fields.forEach((el, i) => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(16px)';
    el.style.transition = `opacity .4s ease ${i * 0.06}s, transform .4s ease ${i * 0.06}s`;
    setTimeout(() => { el.style.opacity = '1'; el.style.transform = 'translateY(0)'; }, 80 + i * 60);
  });
});

/* ════════════════════════════════════════
   LOAD SUPABASE SDK then init pages
════════════════════════════════════════ */
(function loadSupabase() {
  const s = document.createElement('script');
  s.src = 'https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2/dist/umd/supabase.min.js';
  s.onload = () => {
    sb = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON);
    if (document.getElementById('loginForm'))  initLoginPage();
    if (document.getElementById('signupForm')) initSignupPage();
  };
  document.head.appendChild(s);
})();

/* ════════════════════════════════════════
   LOGIN PAGE
════════════════════════════════════════ */
function initLoginPage() {
  const form           = document.getElementById('loginForm');
  const identifier     = document.getElementById('identifier');
  const password       = document.getElementById('password');
  const identifierErr  = document.getElementById('identifierErr');
  const passwordErr    = document.getElementById('passwordErr');
  const togglePwd      = document.getElementById('togglePwd');
  const eyeIcon        = document.getElementById('eyeIcon');
  const loginBtn       = document.getElementById('loginBtn');
  const loginBtnLabel  = document.getElementById('loginBtnLabel');
  const loginBtnLoader = document.getElementById('loginBtnLoader');
  const alertError     = document.getElementById('alertError');
  const alertSuccess   = document.getElementById('alertSuccess');
  const alertErrorMsg  = document.getElementById('alertErrorMsg');

  // Show/hide password
  togglePwd?.addEventListener('click', () => {
    const show = password.type === 'password';
    password.type = show ? 'text' : 'password';
    eyeIcon.className = show ? 'bi bi-eye-slash-fill' : 'bi bi-eye-fill';
  });

  // Live validation
  identifier?.addEventListener('blur', () => {
    const v = identifier.value.trim();
    if (!v) setInvalid(identifier, identifierErr, 'Email or mobile is required.');
    else if (!isValidEmail(v) && !isValidMobile(v)) setInvalid(identifier, identifierErr, 'Enter a valid email or 10-digit mobile.');
    else setValid(identifier, identifierErr);
  });
  identifier?.addEventListener('input', () => { if (identifier.classList.contains('is-invalid')) clearState(identifier, identifierErr); });
  password?.addEventListener('blur', () => { if (!password.value) setInvalid(password, passwordErr, 'Password is required.'); else setValid(password, passwordErr); });
  password?.addEventListener('input', () => { if (password.classList.contains('is-invalid')) clearState(password, passwordErr); });

  // Forgot password modal
  const forgotLink    = document.getElementById('forgotLink');
  const forgotModal   = document.getElementById('forgotModal');
  const closeModal    = document.getElementById('closeModal');
  const sendResetBtn  = document.getElementById('sendResetBtn');
  const resetEmail    = document.getElementById('resetEmail');
  const resetErr      = document.getElementById('resetErr');
  const resetSuccess  = document.getElementById('resetSuccess');

  forgotLink?.addEventListener('click', (e) => { e.preventDefault(); forgotModal?.classList.add('open'); });
  closeModal?.addEventListener('click', () => forgotModal?.classList.remove('open'));
  forgotModal?.addEventListener('click', (e) => { if (e.target === forgotModal) forgotModal.classList.remove('open'); });

  sendResetBtn?.addEventListener('click', async () => {
    const email = resetEmail.value.trim();
    if (!email || !isValidEmail(email)) { setInvalid(resetEmail, resetErr, 'Enter a valid email.'); shakeField(resetEmail); return; }
    setValid(resetEmail, resetErr);
    sendResetBtn.disabled = true;
    sendResetBtn.textContent = 'Sending…';

    const { error } = await sb.auth.resetPasswordForEmail(email, {
      redirectTo: window.location.origin + '/login.php'
    });

    sendResetBtn.disabled = false;
    sendResetBtn.innerHTML = '<span class="btn-label">Send Reset Link</span>';

    if (error) {
      setInvalid(resetEmail, resetErr, error.message);
    } else {
      resetSuccess?.classList.remove('d-none');
      setTimeout(() => {
        forgotModal?.classList.remove('open');
        resetSuccess?.classList.add('d-none');
        resetEmail.value = '';
        clearState(resetEmail, resetErr);
      }, 2500);
    }
  });

  // Form submit — Supabase sign in
  form?.addEventListener('submit', async (e) => {
    e.preventDefault();
    let valid = true;
    const idVal = identifier.value.trim();
    const pwVal = password.value;

    if (!idVal) { setInvalid(identifier, identifierErr, 'Email or mobile is required.'); shakeField(identifier); valid = false; }
    else if (!isValidEmail(idVal) && !isValidMobile(idVal)) { setInvalid(identifier, identifierErr, 'Enter a valid email or mobile.'); shakeField(identifier); valid = false; }
    else setValid(identifier, identifierErr);

    if (!pwVal) { setInvalid(password, passwordErr, 'Password is required.'); shakeField(password); valid = false; }
    else setValid(password, passwordErr);

    if (!valid) { alertErrorMsg.textContent = 'Please fix the errors above.'; alertError?.classList.remove('d-none'); return; }

    alertError?.classList.add('d-none');
    loginBtnLabel?.classList.add('d-none');
    loginBtnLoader?.classList.remove('d-none');
    loginBtn.disabled = true;

    // Use email only — if mobile entered, still try as email
    const emailToUse = isValidEmail(idVal) ? idVal : idVal + '@bookhotel.com';
    const { data, error } = await sb.auth.signInWithPassword({ email: emailToUse, password: pwVal });

    loginBtnLabel?.classList.remove('d-none');
    loginBtnLoader?.classList.add('d-none');
    loginBtn.disabled = false;

    if (error) {
      alertErrorMsg.textContent = error.message === 'Invalid login credentials'
        ? 'Incorrect email or password. Please try again.'
        : error.message;
      alertError?.classList.remove('d-none');
      setInvalid(password, passwordErr, 'Incorrect password.');
      shakeField(password);
      showToast('Login failed. Check your credentials.', 'error');
      return;
    }

    // Save to localStorage for navbar compatibility
    localStorage.setItem('bh_user', JSON.stringify({
      name:  data.user.user_metadata?.full_name || data.user.email.split('@')[0],
      email: data.user.email,
      id:    data.user.id
    }));

    alertSuccess?.classList.remove('d-none');
    showToast('Signed in successfully! Welcome back 👋', 'success');
    setTimeout(() => pageTransition('index.php'), 1200);
  });

  // Google OAuth
  document.getElementById('googleBtn')?.addEventListener('click', async () => {
    await sb.auth.signInWithOAuth({
      provider: 'google',
      options:  { redirectTo: window.location.origin + '/index.php' }
    });
  });

  // Transition links
  document.querySelectorAll('#goSignup, #switchToSignup').forEach(link => {
    link.addEventListener('click', (e) => { e.preventDefault(); pageTransition('signup.php'); });
  });
}

/* ════════════════════════════════════════
   SIGNUP PAGE
════════════════════════════════════════ */
function initSignupPage() {
  const form            = document.getElementById('signupForm');
  const fullName        = document.getElementById('fullName');
  const email           = document.getElementById('email');
  const mobile          = document.getElementById('mobile');
  const password        = document.getElementById('password');
  const confirmPassword = document.getElementById('confirmPassword');
  const agreeTerms      = document.getElementById('agreeTerms');

  const fullNameErr     = document.getElementById('fullNameErr');
  const emailErr        = document.getElementById('emailErr');
  const mobileErr       = document.getElementById('mobileErr');
  const passwordErr     = document.getElementById('passwordErr');
  const confirmErr      = document.getElementById('confirmErr');
  const termsErr        = document.getElementById('termsErr');

  const signupBtn       = document.getElementById('signupBtn');
  const signupBtnLabel  = document.getElementById('signupBtnLabel');
  const signupBtnLoader = document.getElementById('signupBtnLoader');
  const alertError      = document.getElementById('alertError');
  const alertErrorMsg   = document.getElementById('alertErrorMsg');
  const alertSuccess    = document.getElementById('alertSuccess');

  // Strength meter
  const strengthWrap  = document.getElementById('strengthWrap');
  const strengthFill  = document.getElementById('strengthFill');
  const strengthLabel = document.getElementById('strengthLabel');
  const ruleLen   = document.getElementById('rule-len');
  const ruleUpper = document.getElementById('rule-upper');
  const ruleNum   = document.getElementById('rule-num');
  const ruleSym   = document.getElementById('rule-sym');
  const strengthText  = ['', 'Weak', 'Fair', 'Good', 'Strong'];
  const strengthColor = ['', '#ef4444', '#f97316', '#eab308', '#22c55e'];

  function updateStrength(pwd) {
    if (!strengthWrap) return;
    if (!pwd) { strengthWrap.style.display = 'none'; return; }
    strengthWrap.style.display = 'block';
    const score = scorePassword(pwd);
    if (strengthFill) strengthFill.setAttribute('data-s', score);
    if (strengthLabel) { strengthLabel.textContent = strengthText[score] || ''; strengthLabel.style.color = strengthColor[score] || ''; }
    function rulePass(el, pass) { if (!el) return; el.classList.toggle('pass', pass); const i = el.querySelector('i'); if (i) i.className = pass ? 'bi bi-check-circle-fill' : 'bi bi-circle'; }
    rulePass(ruleLen,   pwd.length >= 8);
    rulePass(ruleUpper, /[A-Z]/.test(pwd));
    rulePass(ruleNum,   /\d/.test(pwd));
    rulePass(ruleSym,   /[^A-Za-z0-9]/.test(pwd));
  }

  // Eye toggles
  function initEye(btnId, iconId, inputEl) {
    const btn = document.getElementById(btnId), icon = document.getElementById(iconId);
    if (!btn || !icon || !inputEl) return;
    btn.addEventListener('click', () => { const show = inputEl.type === 'password'; inputEl.type = show ? 'text' : 'password'; icon.className = show ? 'bi bi-eye-slash-fill' : 'bi bi-eye-fill'; });
  }
  initEye('togglePwd', 'eyeIcon', password);
  initEye('toggleConfirm', 'eyeConfirmIcon', confirmPassword);

  // Mobile digits only
  mobile?.addEventListener('input', () => { mobile.value = mobile.value.replace(/\D/g, '').slice(0, 10); });
  password?.addEventListener('input', () => updateStrength(password.value));

  // Validators
  function validateFullName() { const v = fullName.value.trim(); if (!v) { setInvalid(fullName, fullNameErr, 'Full name is required.'); return false; } if (v.length < 3) { setInvalid(fullName, fullNameErr, 'Name must be at least 3 characters.'); return false; } setValid(fullName, fullNameErr); return true; }
  function validateEmail()    { const v = email.value.trim(); if (!v) { setInvalid(email, emailErr, 'Email is required.'); return false; } if (!isValidEmail(v)) { setInvalid(email, emailErr, 'Enter a valid email.'); return false; } setValid(email, emailErr); return true; }
  function validateMobile()   { const v = mobile.value.trim(); if (!v) { setInvalid(mobile, mobileErr, 'Mobile number is required.'); return false; } if (!isValidMobile(v)) { setInvalid(mobile, mobileErr, 'Enter a valid 10-digit mobile.'); return false; } setValid(mobile, mobileErr); return true; }
  function validatePassword() { const v = password.value; if (!v) { setInvalid(password, passwordErr, 'Password is required.'); return false; } if (v.length < 8) { setInvalid(password, passwordErr, 'Min 8 characters required.'); return false; } if (!/[A-Z]/.test(v)) { setInvalid(password, passwordErr, 'Include at least one uppercase letter.'); return false; } if (!/\d/.test(v)) { setInvalid(password, passwordErr, 'Include at least one number.'); return false; } setValid(password, passwordErr); return true; }
  function validateConfirm()  { const v = confirmPassword.value; if (!v) { setInvalid(confirmPassword, confirmErr, 'Please confirm your password.'); return false; } if (v !== password.value) { setInvalid(confirmPassword, confirmErr, 'Passwords do not match.'); return false; } setValid(confirmPassword, confirmErr); return true; }

  fullName?.addEventListener('blur', validateFullName);
  email?.addEventListener('blur', validateEmail);
  mobile?.addEventListener('blur', validateMobile);
  password?.addEventListener('blur', validatePassword);
  confirmPassword?.addEventListener('blur', validateConfirm);
  [[fullName,fullNameErr],[email,emailErr],[mobile,mobileErr],[password,passwordErr],[confirmPassword,confirmErr]].forEach(([inp,err]) => {
    inp?.addEventListener('input', () => { if (inp.classList.contains('is-invalid')) clearState(inp, err); });
  });

  // Form submit — Supabase sign up
  form?.addEventListener('submit', async (e) => {
    e.preventDefault();
    const checks   = [validateFullName(), validateEmail(), validateMobile(), validatePassword(), validateConfirm()];
    let   termsOk  = true;
    if (agreeTerms && !agreeTerms.checked) { if (termsErr) termsErr.textContent = 'You must agree to the Terms of Service.'; termsOk = false; }
    else { if (termsErr) termsErr.textContent = ''; }

    if (!checks.every(Boolean) || !termsOk) {
      alertErrorMsg.textContent = 'Please fix the errors above.';
      alertError?.classList.remove('d-none');
      form.querySelector('.is-invalid')?.focus();
      return;
    }

    alertError?.classList.add('d-none');
    signupBtnLabel?.classList.add('d-none');
    signupBtnLoader?.classList.remove('d-none');
    signupBtn.disabled = true;

    const { data, error } = await sb.auth.signUp({
      email:    email.value.trim(),
      password: password.value,
      options:  { data: { full_name: fullName.value.trim(), phone: '+91' + mobile.value.trim() } }
    });

    signupBtnLabel?.classList.remove('d-none');
    signupBtnLoader?.classList.add('d-none');
    signupBtn.disabled = false;

    if (error) {
      alertErrorMsg.textContent = error.message;
      alertError?.classList.remove('d-none');
      showToast(error.message, 'error');
      return;
    }

    alertSuccess?.classList.remove('d-none');
    showToast('Account created! Welcome to bookHotel 🎉', 'success');
    form.reset();
    if (strengthWrap) strengthWrap.style.display = 'none';
    setTimeout(() => pageTransition('login.php'), 2000);
  });
}

