<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"/><meta name="viewport" content="width=device-width,initial-scale=1.0"/><title>Pricing Management -- Hotel Manager</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"/><link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" crossorigin="anonymous"/><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/><link rel="stylesheet" href="dashboard.css"/></head><body><div class="ds-ov" id="dsOv"></div><aside class="ds-sb" id="dsSb"><a href="admin-dashboard.php" class="ds-logo"><div class="ds-logo-icon"><i class="bi bi-building-fill"></i></div><div><div class="ds-logo-name">bookHotel</div><div class="ds-logo-role">Manager Portal</div></div></a><nav class="ds-nav"><div class="ds-sec">Main</div><a href="admin-dashboard.php" class="ds-link"><i class="bi bi-grid-fill"></i> Dashboard</a><a href="admin-hotel-profile.php" class="ds-link "><i class="bi bi-building"></i> Hotel Profile</a><div class="ds-sec">Operations</div><a href="admin-rooms.php" class="ds-link "><i class="bi bi-door-open-fill"></i> Rooms</a><a href="admin-bookings.php" class="ds-link "><i class="bi bi-calendar2-check-fill"></i> Bookings <span class="badge bg-danger">3</span></a><a href="admin-guests.php" class="ds-link "><i class="bi bi-people-fill"></i> Guests</a><div class="ds-sec">Inventory & Pricing</div><a href="admin-availability.php" class="ds-link "><i class="bi bi-calendar-range-fill"></i> Availability</a><a href="admin-pricing.php" class="ds-link active"><i class="bi bi-tags-fill"></i> Pricing</a><a href="admin-discounts.php" class="ds-link "><i class="bi bi-percent"></i> Discounts</a><div class="ds-sec">Insights</div><a href="admin-reviews.php" class="ds-link "><i class="bi bi-star-fill"></i> Reviews <span class="badge bg-warning text-dark">5</span></a><a href="admin-revenue.php" class="ds-link "><i class="bi bi-bar-chart-fill"></i> Revenue</a><a href="admin-notifications.php" class="ds-link "><i class="bi bi-bell-fill"></i> Notifications <span class="badge bg-primary">8</span></a><div class="ds-sec">Account</div><a href="admin-settings.php" class="ds-link "><i class="bi bi-gear-fill"></i> Settings</a><a href="index.php" class="ds-link"><i class="bi bi-box-arrow-left"></i> Back to Website</a></nav><div class="ds-foot"><a href="admin-hotel-profile.php" class="ds-hpill"><img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=80&q=80" alt=""/><div><div class="ds-hpill-name">The Grand Palace</div><div class="ds-hpill-status">Active</div></div></a></div></aside><header class="ds-top"><div class="ds-top-l"><button class="ds-ibtn d-lg-none" id="dsTog"><i class="bi bi-list fs-5"></i></button><div><div class="ds-page-title">Pricing Management</div><div class="ds-breadcrumb">Dashboard / Inventory & Pricing / Pricing</div></div></div><div class="ds-top-r"><a href="admin-notifications.php" class="ds-ibtn"><i class="bi bi-bell-fill"></i><span class="ds-dot"></span></a><div class="ds-avbtn" id="dsAvBtn"><div class="ds-av">AD</div><span class="ds-avname d-none d-sm-block">Aditi</span><div class="ds-dropdown" id="dsAvMenu"><a href="admin-settings.php" class="ds-drop-item"><i class="bi bi-person-fill text-primary"></i> My Profile</a><hr class="my-1 mx-2"/><a href="login.php" class="ds-drop-item danger"><i class="bi bi-box-arrow-right"></i> Sign Out</a></div></div></div></header><main class="ds-main">
  
  <div class="row g-3">
    <!-- Base Rates Table -->
    <div class="col-12 col-lg-5">
      <div class="ds-card h-100">
        <div class="ds-ch">
          <div class="ds-ct"><i class="bi bi-cash-stack"></i> Base Room Rates</div>
        </div>
        <div style="overflow-x:auto">
          <table class="ds-tbl">
            <thead><tr><th>Room Type</th><th>Base Rate</th><th>Action</th></tr></thead>
            <tbody>
              <tr><td>Standard Single</td><td class="fw-700 text-primary">₹2,500</td><td><button class="ds-btn gho sm" onclick="editBaseRate('Standard Single', 2500)"><i class="bi bi-pencil"></i> Edit</button></td></tr>
              <tr><td>Standard Twin</td><td class="fw-700 text-primary">₹3,500</td><td><button class="ds-btn gho sm" onclick="editBaseRate('Standard Twin', 3500)"><i class="bi bi-pencil"></i> Edit</button></td></tr>
              <tr><td>Deluxe King</td><td class="fw-700 text-primary">₹5,500</td><td><button class="ds-btn gho sm" onclick="editBaseRate('Deluxe King', 5500)"><i class="bi bi-pencil"></i> Edit</button></td></tr>
              <tr><td>Ocean Suite</td><td class="fw-700 text-primary">₹9,000</td><td><button class="ds-btn gho sm" onclick="editBaseRate('Ocean Suite', 9000)"><i class="bi bi-pencil"></i> Edit</button></td></tr>
              <tr><td>Presidential Suite</td><td class="fw-700 text-primary">₹24,000</td><td><button class="ds-btn gho sm" onclick="editBaseRate('Presidential Suite', 24000)"><i class="bi bi-pencil"></i> Edit</button></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Dynamic Pricing Rules -->
    <div class="col-12 col-lg-7">
      <div class="ds-card h-100">
        <div class="ds-ch">
          <div class="ds-ct"><i class="bi bi-graph-up-arrow"></i> Dynamic Pricing Rules</div>
          <button class="ds-btn prim sm" data-bs-toggle="modal" data-bs-target="#ruleModal"><i class="bi bi-plus-lg"></i> Add Rule</button>
        </div>
        <div style="overflow-x:auto">
          <table class="ds-tbl">
            <thead><tr><th>Rule Name</th><th>Type</th><th>Room Types</th><th>Adjustment</th><th>Dates</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
              <tr>
                <td class="fw-600">Weekend Surge</td>
                <td>Weekend Pricing</td>
                <td>All Rooms</td>
                <td class="text-success fw-700">+15%</td>
                <td>Every Fri, Sat</td>
                <td><span class="ds-badge available">Active</span></td>
                <td><div class="d-flex gap-1"><button class="ds-btn gho ico" data-bs-toggle="modal" data-bs-target="#ruleModal"><i class="bi bi-pencil"></i></button><button class="ds-btn dng ico"><i class="bi bi-trash"></i></button></div></td>
              </tr>
              <tr>
                <td class="fw-600">Diwali Festival</td>
                <td>Festival Pricing</td>
                <td>Deluxe, Suite</td>
                <td class="text-success fw-700">+₹2,000</td>
                <td>08 Nov - 15 Nov</td>
                <td><span class="ds-badge available">Active</span></td>
                <td><div class="d-flex gap-1"><button class="ds-btn gho ico" data-bs-toggle="modal" data-bs-target="#ruleModal"><i class="bi bi-pencil"></i></button><button class="ds-btn dng ico"><i class="bi bi-trash"></i></button></div></td>
              </tr>
              <tr>
                <td class="fw-600">Monsoon Drop</td>
                <td>Seasonal Pricing</td>
                <td>All Rooms</td>
                <td class="text-danger fw-700">-10%</td>
                <td>01 Jul - 30 Sep</td>
                <td><span class="ds-badge maintenance">Inactive</span></td>
                <td><div class="d-flex gap-1"><button class="ds-btn gho ico" data-bs-toggle="modal" data-bs-target="#ruleModal"><i class="bi bi-pencil"></i></button><button class="ds-btn dng ico"><i class="bi bi-trash"></i></button></div></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Edit Base Rate Modal -->
<div class="modal fade ds-modal" id="baseRateModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title"><i class="bi bi-cash me-2"></i>Edit Base Rate</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
      <div class="modal-body p-4">
        <div class="mb-3">
          <label class="ds-lbl">Room Type</label>
          <input class="ds-inp" id="brRoomType" readonly />
        </div>
        <div class="mb-3">
          <label class="ds-lbl">New Base Rate (₹)</label>
          <input type="number" class="ds-inp" id="brRate" />
        </div>
      </div>
      <div class="modal-footer">
        <button class="ds-btn gho" data-bs-dismiss="modal">Cancel</button>
        <button class="ds-btn prim" onclick="dsToast('Base rate updated!','success')" data-bs-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Add/Edit Pricing Rule Modal -->
<div class="modal fade ds-modal" id="ruleModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title"><i class="bi bi-tags-fill me-2"></i>Pricing Rule</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
      <div class="modal-body p-4">
        <div class="row g-3">
          <div class="col-md-6"><label class="ds-lbl">Rule Name</label><input class="ds-inp" placeholder="e.g. Summer Surge"/></div>
          <div class="col-md-6"><label class="ds-lbl">Rule Type</label>
            <select class="ds-inp ds-sel">
              <option>Weekend Pricing</option><option>Festival Pricing</option><option>Seasonal Pricing</option><option>Dynamic Event Rate</option>
            </select>
          </div>
          <div class="col-md-6"><label class="ds-lbl">Adjustment (+ or -)</label>
            <div class="input-group">
              <select class="ds-inp ds-sel" style="max-width: 80px;"><option>+</option><option>-</option></select>
              <input type="number" class="ds-inp" placeholder="15"/>
              <select class="ds-inp ds-sel" style="max-width: 100px;"><option>%</option><option>₹</option></select>
            </div>
          </div>
          <div class="col-md-6"><label class="ds-lbl">Applicable Days/Dates</label>
            <input type="text" class="ds-inp" placeholder="e.g. Every Fri, Sat OR 01 Jan - 10 Jan"/>
          </div>
          <div class="col-12"><label class="ds-lbl">Applicable Rooms (Hold Ctrl/Cmd to multi-select)</label>
            <select class="ds-inp ds-sel" multiple style="height: 100px;">
              <option value="all" selected>All Rooms</option><option>Standard Single</option><option>Standard Twin</option><option>Deluxe King</option><option>Ocean Suite</option><option>Presidential Suite</option>
            </select>
          </div>
          <div class="col-md-6"><label class="ds-lbl">Status</label>
            <select class="ds-inp ds-sel"><option>Active</option><option>Inactive</option></select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="ds-btn gho" data-bs-dismiss="modal">Cancel</button>
        <button class="ds-btn prim" onclick="dsToast('Rule saved!','success')" data-bs-dismiss="modal"><i class="bi bi-check-lg"></i> Save Rule</button>
      </div>
    </div>
  </div>
</div>

<script>
  let brModalInstance = null;
  function editBaseRate(type, rate) {
    document.getElementById('brRoomType').value = type;
    document.getElementById('brRate').value = rate;
    if(!brModalInstance) brModalInstance = new bootstrap.Modal(document.getElementById('baseRateModal'));
    brModalInstance.show();
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js" crossorigin="anonymous"></script><script src="dashboard.js"></script></body></html>
