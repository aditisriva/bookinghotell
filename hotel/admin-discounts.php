<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"/><meta name="viewport" content="width=device-width,initial-scale=1.0"/><title>Discount Management -- Hotel Manager</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"/><link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" crossorigin="anonymous"/><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/><link rel="stylesheet" href="dashboard.css"/></head><body><div class="ds-ov" id="dsOv"></div><aside class="ds-sb" id="dsSb"><a href="admin-dashboard.php" class="ds-logo"><div class="ds-logo-icon"><i class="bi bi-building-fill"></i></div><div><div class="ds-logo-name">bookHotel</div><div class="ds-logo-role">Manager Portal</div></div></a><nav class="ds-nav"><div class="ds-sec">Main</div><a href="admin-dashboard.php" class="ds-link"><i class="bi bi-grid-fill"></i> Dashboard</a><a href="admin-hotel-profile.php" class="ds-link "><i class="bi bi-building"></i> Hotel Profile</a><div class="ds-sec">Operations</div><a href="admin-rooms.php" class="ds-link "><i class="bi bi-door-open-fill"></i> Rooms</a><a href="admin-bookings.php" class="ds-link "><i class="bi bi-calendar2-check-fill"></i> Bookings <span class="badge bg-danger">3</span></a><a href="admin-guests.php" class="ds-link "><i class="bi bi-people-fill"></i> Guests</a><div class="ds-sec">Inventory & Pricing</div><a href="admin-availability.php" class="ds-link "><i class="bi bi-calendar-range-fill"></i> Availability</a><a href="admin-pricing.php" class="ds-link "><i class="bi bi-tags-fill"></i> Pricing</a><a href="admin-discounts.php" class="ds-link active"><i class="bi bi-percent"></i> Discounts</a><div class="ds-sec">Insights</div><a href="admin-reviews.php" class="ds-link "><i class="bi bi-star-fill"></i> Reviews <span class="badge bg-warning text-dark">5</span></a><a href="admin-revenue.php" class="ds-link "><i class="bi bi-bar-chart-fill"></i> Revenue</a><a href="admin-notifications.php" class="ds-link "><i class="bi bi-bell-fill"></i> Notifications <span class="badge bg-primary">8</span></a><div class="ds-sec">Account</div><a href="admin-settings.php" class="ds-link "><i class="bi bi-gear-fill"></i> Settings</a><a href="index.php" class="ds-link"><i class="bi bi-box-arrow-left"></i> Back to Website</a></nav><div class="ds-foot"><a href="admin-hotel-profile.php" class="ds-hpill"><img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=80&q=80" alt=""/><div><div class="ds-hpill-name">The Grand Palace</div><div class="ds-hpill-status">Active</div></div></a></div></aside><header class="ds-top"><div class="ds-top-l"><button class="ds-ibtn d-lg-none" id="dsTog"><i class="bi bi-list fs-5"></i></button><div><div class="ds-page-title">Discount Management</div><div class="ds-breadcrumb">Dashboard / Inventory & Pricing / Discounts</div></div></div><div class="ds-top-r"><a href="admin-notifications.php" class="ds-ibtn"><i class="bi bi-bell-fill"></i><span class="ds-dot"></span></a><div class="ds-avbtn" id="dsAvBtn"><div class="ds-av">AD</div><span class="ds-avname d-none d-sm-block">Aditi</span><div class="ds-dropdown" id="dsAvMenu"><a href="admin-settings.php" class="ds-drop-item"><i class="bi bi-person-fill text-primary"></i> My Profile</a><hr class="my-1 mx-2"/><a href="login.php" class="ds-drop-item danger"><i class="bi bi-box-arrow-right"></i> Sign Out</a></div></div></div></header><main class="ds-main">
  <!-- Stat Cards -->
  <div class="row g-3 mb-4">
    <div class="col-12 col-md-4"><div class="ds-stat blue"><div class="ds-si"><i class="bi bi-percent"></i></div><div class="ds-sn">4</div><div class="ds-sl">Active Offers</div></div></div>
    <div class="col-12 col-md-4"><div class="ds-stat orange"><div class="ds-si"><i class="bi bi-clock-history"></i></div><div class="ds-sn">1</div><div class="ds-sl">Expiring Soon</div></div></div>
    <div class="col-12 col-md-4"><div class="ds-stat green"><div class="ds-si"><i class="bi bi-calendar2-check-fill"></i></div><div class="ds-sn">42</div><div class="ds-sl">Discounted Bookings This Month</div></div></div>
  </div>

  <!-- Discounts Table -->
  <div class="ds-card">
    <div class="ds-ch">
      <div class="ds-ct"><i class="bi bi-tags-fill"></i> All Discounts & Offers</div>
      <div class="d-flex gap-2 flex-wrap">
        <div class="ds-sw"><i class="bi bi-search ds-si-ic"></i><input class="ds-inp search" placeholder="Search offers…" style="width:200px" oninput="filterOffers(this.value)"/></div>
        <select class="ds-inp ds-sel" style="width:auto" onchange="filterType(this.value)">
          <option value="">All Types</option><option>Percentage Discount</option><option>Flat Discount</option><option>Weekend Discount</option><option>Early Bird Discount</option><option>Last Minute Discount</option>
        </select>
        <button class="ds-btn prim" data-bs-toggle="modal" data-bs-target="#offerModal"><i class="bi bi-plus-lg"></i> Create Offer</button>
      </div>
    </div>
    <div style="overflow-x:auto">
      <table class="ds-tbl" id="offerTable">
        <thead><tr><th>Offer Name</th><th>Type</th><th>Value</th><th>Validity (Start - End)</th><th>Applicable Rooms</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
          <tr data-type="Percentage Discount">
            <td class="fw-700">Summer Getaway 2026</td>
            <td>Percentage Discount</td>
            <td class="fw-700 text-primary">15% Off</td>
            <td>01 Jun 2026 - 31 Aug 2026</td>
            <td>Standard, Deluxe</td>
            <td><span class="ds-badge available">Active</span></td>
            <td><div class="d-flex gap-1">
              <button class="ds-btn gho ico" data-bs-toggle="modal" data-bs-target="#offerModal" title="Edit"><i class="bi bi-pencil-fill"></i></button>
              <button class="ds-btn dng ico" onclick="dsConfirm('Delete Offer Summer Getaway 2026?',()=>{this.closest('tr').remove();dsToast('Offer deleted','error')})" title="Delete"><i class="bi bi-trash-fill"></i></button>
            </div></td>
          </tr>
          <tr data-type="Early Bird Discount">
            <td class="fw-700">Book 60 Days Ahead</td>
            <td>Early Bird Discount</td>
            <td class="fw-700 text-primary">20% Off</td>
            <td>Ongoing</td>
            <td>All Rooms</td>
            <td><span class="ds-badge available">Active</span></td>
            <td><div class="d-flex gap-1">
              <button class="ds-btn gho ico" data-bs-toggle="modal" data-bs-target="#offerModal"><i class="bi bi-pencil-fill"></i></button>
              <button class="ds-btn dng ico" onclick="dsConfirm('Delete Offer?',()=>{this.closest('tr').remove();dsToast('Offer deleted','error')})"><i class="bi bi-trash-fill"></i></button>
            </div></td>
          </tr>
          <tr data-type="Flat Discount">
            <td class="fw-700">Business Traveler Promo</td>
            <td>Flat Discount</td>
            <td class="fw-700 text-primary">₹500 Off</td>
            <td>01 Jan 2026 - 31 Dec 2026</td>
            <td>Deluxe, Suite</td>
            <td><span class="ds-badge maintenance">Inactive</span></td>
            <td><div class="d-flex gap-1">
              <button class="ds-btn gho ico" data-bs-toggle="modal" data-bs-target="#offerModal"><i class="bi bi-pencil-fill"></i></button>
              <button class="ds-btn dng ico" onclick="dsConfirm('Delete Offer?',()=>{this.closest('tr').remove();dsToast('Offer deleted','error')})"><i class="bi bi-trash-fill"></i></button>
            </div></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</main>

<!-- Offer Modal -->
<div class="modal fade ds-modal" id="offerModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title"><i class="bi bi-tags-fill me-2"></i>Create / Edit Offer</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
      <div class="modal-body p-4">
        <div class="row g-3">
          <div class="col-md-6"><label class="ds-lbl">Offer Name</label><input class="ds-inp" placeholder="e.g. Winter Special"/></div>
          <div class="col-md-6"><label class="ds-lbl">Offer Type</label>
            <select class="ds-inp ds-sel">
              <option>Percentage Discount</option><option>Flat Discount</option><option>Weekend Discount</option><option>Festival Discount</option><option>Seasonal Discount</option><option>Long Stay Discount</option><option>Early Bird Discount</option><option>Last Minute Discount</option><option>Promo Code Discount</option>
            </select>
          </div>
          <div class="col-md-6"><label class="ds-lbl">Discount Value (e.g., 15 or 500)</label><input type="number" class="ds-inp" placeholder="15"/></div>
          <div class="col-md-6"><label class="ds-lbl">Value Type</label>
            <select class="ds-inp ds-sel"><option>Percentage (%)</option><option>Flat Amount (₹)</option></select>
          </div>
          <div class="col-md-6"><label class="ds-lbl">Start Date</label><input type="date" class="ds-inp"/></div>
          <div class="col-md-6"><label class="ds-lbl">End Date</label><input type="date" class="ds-inp"/></div>
          <div class="col-12"><label class="ds-lbl">Applicable Rooms (Hold Ctrl/Cmd to multi-select)</label>
            <select class="ds-inp ds-sel" multiple style="height: 100px;">
              <option value="all">All Rooms</option><option>Standard Single</option><option>Standard Twin</option><option>Deluxe King</option><option>Ocean Suite</option><option>Presidential Suite</option>
            </select>
          </div>
          <div class="col-md-6"><label class="ds-lbl">Status</label>
            <select class="ds-inp ds-sel"><option>Active</option><option>Inactive</option></select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="ds-btn gho" data-bs-dismiss="modal">Cancel</button>
        <button class="ds-btn prim" onclick="dsToast('Offer saved successfully!','success')" data-bs-dismiss="modal"><i class="bi bi-check-lg"></i> Save Offer</button>
      </div>
    </div>
  </div>
</div>

<script>
function filterOffers(q){
  q=q.toLowerCase();
  document.querySelectorAll('#offerTable tbody tr').forEach(r=>{r.style.display=r.textContent.toLowerCase().includes(q)?'':'none'});
}
function filterType(t){
  document.querySelectorAll('#offerTable tbody tr').forEach(r=>{r.style.display=(!t||r.dataset.type===t)?'':'none'});
}
</script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js" crossorigin="anonymous"></script><script src="dashboard.js"></script></body></html>
