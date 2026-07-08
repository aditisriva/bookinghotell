<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"/><meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>Settings — Hotel Manager</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" crossorigin="anonymous"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="dashboard.css"/>
</head><body>
<div class="ds-ov" id="dsOv"></div>
<aside class="ds-sb" id="dsSb">
  <a href="admin-dashboard.php" class="ds-logo"><div class="ds-logo-icon"><i class="bi bi-building-fill"></i></div><div><div class="ds-logo-name">bookHotel</div><div class="ds-logo-role">Manager Portal</div></div></a>
  <nav class="ds-nav">
    <div class="ds-sec">Main</div>
    <a href="admin-dashboard.php" class="ds-link"><i class="bi bi-grid-fill"></i> Dashboard</a>
    <a href="admin-hotel-profile.php" class="ds-link"><i class="bi bi-building"></i> Hotel Profile</a>
    <div class="ds-sec">Operations</div>
    <a href="admin-rooms.php" class="ds-link"><i class="bi bi-door-open-fill"></i> Rooms</a>
    <a href="admin-bookings.php" class="ds-link"><i class="bi bi-calendar2-check-fill"></i> Bookings <span class="badge bg-danger">3</span></a>
    <a href="admin-guests.php" class="ds-link"><i class="bi bi-people-fill"></i> Guests</a>
    <div class="ds-sec">Insights</div>
    <a href="admin-reviews.php" class="ds-link"><i class="bi bi-star-fill"></i> Reviews <span class="badge bg-warning text-dark">5</span></a>
    <a href="admin-revenue.php" class="ds-link"><i class="bi bi-bar-chart-fill"></i> Revenue</a>
    <a href="admin-notifications.php" class="ds-link"><i class="bi bi-bell-fill"></i> Notifications <span class="badge bg-primary">8</span></a>
    <div class="ds-sec">Account</div>
    <a href="admin-settings.php" class="ds-link active"><i class="bi bi-gear-fill"></i> Settings</a>
    <a href="index.php" class="ds-link"><i class="bi bi-box-arrow-left"></i> Back to Website</a>
  </nav>
  <div class="ds-foot"><a href="admin-hotel-profile.php" class="ds-hpill"><img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=80&q=80" alt=""/><div><div class="ds-hpill-name">The Grand Palace</div><div class="ds-hpill-status">● Active · Mumbai</div></div></a></div>
</aside>
<header class="ds-top">
  <div class="ds-top-l">
    <button class="ds-ibtn d-lg-none" id="dsTog"><i class="bi bi-list fs-5"></i></button>
    <div><div class="ds-page-title">Settings</div><div class="ds-breadcrumb">Account &rsaquo; Settings</div></div>
  </div>
  <div class="ds-top-r">
    <a href="admin-notifications.php" class="ds-ibtn"><i class="bi bi-bell-fill"></i><span class="ds-dot"></span></a>
    <div class="ds-avbtn" id="dsAvBtn"><div class="ds-av">AD</div><span class="ds-avname d-none d-sm-block">Aditi</span><i class="bi bi-chevron-down ms-1" style="font-size:.7rem;color:var(--mut)"></i>
      <div class="ds-dropdown" id="dsAvMenu">
        <a href="admin-settings.php" class="ds-drop-item"><i class="bi bi-person-fill text-primary"></i> My Profile</a>
        <a href="admin-settings.php" class="ds-drop-item"><i class="bi bi-gear-fill text-primary"></i> Settings</a>
        <hr class="my-1 mx-2"/>
        <a href="login.php" class="ds-drop-item danger"><i class="bi bi-box-arrow-right"></i> Sign Out</a>
      </div>
    </div>
  </div>
</header>
<main class="ds-main">
  <div class="row g-3">
    <!-- Left Column -->
    <div class="col-lg-6">
      <!-- Change Password -->
      <div class="ds-card mb-3">
        <div class="ds-ch"><div class="ds-ct"><i class="bi bi-shield-lock-fill"></i> Change Password</div></div>
        <div class="ds-cb">
          <div class="mb-3">
            <label class="ds-lbl" for="curPwd">Current Password</label>
            <input class="ds-inp" type="password" id="curPwd" placeholder="Enter current password"/>
          </div>
          <div class="mb-3">
            <label class="ds-lbl" for="newPwd">New Password</label>
            <input class="ds-inp" type="password" id="newPwd" placeholder="Enter new password"/>
          </div>
          <div class="mb-3">
            <label class="ds-lbl" for="confPwd">Confirm New Password</label>
            <input class="ds-inp" type="password" id="confPwd" placeholder="Confirm new password"/>
          </div>
          <button class="ds-btn prim" onclick="dsToast('Password updated successfully!','success')"><i class="bi bi-shield-check me-1"></i>Update Password</button>
        </div>
      </div>
      <!-- Hotel Policies -->
      <div class="ds-card">
        <div class="ds-ch"><div class="ds-ct"><i class="bi bi-file-earmark-text-fill"></i> Hotel Policies</div></div>
        <div class="ds-cb">
          <div class="row g-3">
            <div class="col-6">
              <label class="ds-lbl" for="ciTime">Check-in Time</label>
              <input class="ds-inp" type="time" id="ciTime" value="14:00"/>
            </div>
            <div class="col-6">
              <label class="ds-lbl" for="coTime">Check-out Time</label>
              <input class="ds-inp" type="time" id="coTime" value="11:00"/>
            </div>
            <div class="col-12">
              <label class="ds-lbl" for="cancelPol">Cancellation Policy</label>
              <select class="ds-inp ds-sel" id="cancelPol">
                <option>Free cancellation up to 24h before check-in</option>
                <option>Free cancellation up to 48h before check-in</option>
                <option>Free cancellation up to 72h before check-in</option>
                <option>Non-refundable</option>
              </select>
            </div>
            <div class="col-6">
              <label class="ds-lbl" for="petPol">Pet Policy</label>
              <select class="ds-inp ds-sel" id="petPol">
                <option>No pets allowed</option>
                <option>Pets allowed (small)</option>
                <option>All pets welcome</option>
              </select>
            </div>
            <div class="col-6">
              <label class="ds-lbl" for="smokePol">Smoking Policy</label>
              <select class="ds-inp ds-sel" id="smokePol">
                <option>No smoking indoors</option>
                <option>Designated smoking areas</option>
                <option>Smoking permitted in rooms</option>
              </select>
            </div>
            <div class="col-12">
              <label class="ds-lbl" for="addRules">Additional Rules</label>
              <textarea class="ds-inp" id="addRules" rows="3" placeholder="Any additional hotel rules or policies...">Quiet hours: 10 PM – 7 AM. No outside food delivery in common areas. ID proof mandatory at check-in.</textarea>
            </div>
          </div>
          <button class="ds-btn prim mt-3" onclick="dsToast('Hotel policies saved!','success')"><i class="bi bi-floppy-fill me-1"></i>Save Policies</button>
        </div>
      </div>
    </div>
    <!-- Right Column -->
    <div class="col-lg-6">
      <!-- Manager Profile -->
      <div class="ds-card mb-3">
        <div class="ds-ch"><div class="ds-ct"><i class="bi bi-person-fill"></i> Manager Profile</div></div>
        <div class="ds-cb">
          <div class="d-flex align-items-center gap-3 mb-4">
            <div class="ds-hpill" style="pointer-events:none;background:none;padding:0;gap:.75rem">
              <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=80&q=80" alt="" style="width:60px;height:60px;border-radius:12px;object-fit:cover"/>
            </div>
            <button class="ds-btn outl sm" onclick="dsToast('Avatar upload coming soon!','info')"><i class="bi bi-camera-fill me-1"></i>Change Avatar</button>
          </div>
          <div class="row g-3">
            <div class="col-6">
              <label class="ds-lbl" for="mgrFirst">First Name</label>
              <input class="ds-inp" type="text" id="mgrFirst" value="Aditi"/>
            </div>
            <div class="col-6">
              <label class="ds-lbl" for="mgrLast">Last Name</label>
              <input class="ds-inp" type="text" id="mgrLast" value="Sharma"/>
            </div>
            <div class="col-12">
              <label class="ds-lbl" for="mgrEmail">Email Address</label>
              <input class="ds-inp" type="email" id="mgrEmail" value="aditi.sharma@grandpalace.com"/>
            </div>
            <div class="col-12">
              <label class="ds-lbl" for="mgrPhone">Phone Number</label>
              <input class="ds-inp" type="tel" id="mgrPhone" value="+91 98765 43210"/>
            </div>
          </div>
          <button class="ds-btn prim mt-3" onclick="dsToast('Profile saved successfully!','success')"><i class="bi bi-floppy-fill me-1"></i>Save Profile</button>
        </div>
      </div>
      <!-- Notification Preferences -->
      <div class="ds-card mb-3">
        <div class="ds-ch"><div class="ds-ct"><i class="bi bi-bell-fill"></i> Notification Preferences</div></div>
        <div class="ds-cb d-flex flex-column gap-3">
          <div class="d-flex align-items-center justify-content-between">
            <div><div class="fw-600">New Bookings</div><div style="font-size:.78rem;color:var(--mut)">Get notified when a new booking is made</div></div>
            <div class="ds-tog"><input type="checkbox" id="nt1" checked/><label for="nt1"></label></div>
          </div>
          <div class="d-flex align-items-center justify-content-between border-top pt-3">
            <div><div class="fw-600">Cancellations</div><div style="font-size:.78rem;color:var(--mut)">Alert when a guest cancels a booking</div></div>
            <div class="ds-tog"><input type="checkbox" id="nt2" checked/><label for="nt2"></label></div>
          </div>
          <div class="d-flex align-items-center justify-content-between border-top pt-3">
            <div><div class="fw-600">New Reviews</div><div style="font-size:.78rem;color:var(--mut)">Notify when a guest posts a review</div></div>
            <div class="ds-tog"><input type="checkbox" id="nt3" checked/><label for="nt3"></label></div>
          </div>
          <div class="d-flex align-items-center justify-content-between border-top pt-3">
            <div><div class="fw-600">Check-in Reminders</div><div style="font-size:.78rem;color:var(--mut)">Daily reminder for upcoming check-ins</div></div>
            <div class="ds-tog"><input type="checkbox" id="nt4" checked/><label for="nt4"></label></div>
          </div>
          <div class="d-flex align-items-center justify-content-between border-top pt-3">
            <div><div class="fw-600">Revenue Reports</div><div style="font-size:.78rem;color:var(--mut)">Weekly revenue summary emails</div></div>
            <div class="ds-tog"><input type="checkbox" id="nt5"/><label for="nt5"></label></div>
          </div>
          <div class="d-flex align-items-center justify-content-between border-top pt-3">
            <div><div class="fw-600">SMS Alerts</div><div style="font-size:.78rem;color:var(--mut)">Receive SMS for critical alerts</div></div>
            <div class="ds-tog"><input type="checkbox" id="nt6"/><label for="nt6"></label></div>
          </div>
          <button class="ds-btn prim mt-1" onclick="dsToast('Notification preferences saved!','success')"><i class="bi bi-floppy-fill me-1"></i>Save Preferences</button>
        </div>
      </div>
      <!-- Danger Zone -->
      <div class="ds-card" style="border:1.5px solid var(--red)">
        <div class="ds-ch"><div class="ds-ct" style="color:var(--red)"><i class="bi bi-exclamation-triangle-fill"></i> Danger Zone</div></div>
        <div class="ds-cb d-flex flex-column gap-3">
          <div>
            <div class="fw-600 mb-1">Deactivate Hotel Listing</div>
            <div style="font-size:.8rem;color:var(--mut);margin-bottom:.75rem">Temporarily hide your hotel from search results and prevent new bookings. Existing bookings are not affected.</div>
            <button class="ds-btn outl sm" style="border-color:var(--org);color:var(--org)" onclick="dsConfirm('Deactivate your hotel listing? Guests will not be able to find or book your hotel.',()=>dsToast('Hotel deactivated. Contact support to reactivate.','error'))"><i class="bi bi-pause-circle-fill me-1"></i>Deactivate Hotel</button>
          </div>
          <div class="border-top pt-3">
            <div class="fw-600 mb-1" style="color:var(--red)">Delete Account</div>
            <div style="font-size:.8rem;color:var(--mut);margin-bottom:.75rem">Permanently delete your manager account and all associated data. This action is <strong>irreversible</strong>.</div>
            <button class="ds-btn dng sm" onclick="dsConfirm('Permanently delete your account? This cannot be undone.',()=>dsToast('Account deletion requested. Check your email.','error'))"><i class="bi bi-trash3-fill me-1"></i>Delete Account</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="dashboard.js"></script>
</body></html>

