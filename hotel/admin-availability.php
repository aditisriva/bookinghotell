<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"/><meta name="viewport" content="width=device-width,initial-scale=1.0"/><title>Availability Management -- Hotel Manager</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"/><link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" crossorigin="anonymous"/><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/><link rel="stylesheet" href="dashboard.css"/>
<style>
  .calendar-grid { display: flex; flex-direction: column; overflow-x: auto; background: var(--bg-card); border-radius: 12px; border: 1px solid var(--border); }
  .cal-row { display: flex; border-bottom: 1px solid var(--border); min-width: max-content; }
  .cal-row:last-child { border-bottom: none; }
  .cal-cell { width: 80px; padding: 10px; border-right: 1px solid var(--border); text-align: center; font-size: 0.85rem; font-weight: 500; }
  .cal-cell.header { background: #f8f9fa; color: var(--mut); font-weight: 600; }
  .cal-cell.room-name { width: 150px; text-align: left; background: #fff; position: sticky; left: 0; z-index: 2; border-right: 2px solid var(--border); font-weight: 600; }
  .cal-cell.available { background-color: rgba(16,185,129,0.1); color: var(--grn); cursor: pointer; }
  .cal-cell.occupied { background-color: rgba(239,68,68,0.1); color: var(--red); cursor: not-allowed; }
  .cal-cell.blocked { background-color: rgba(107,114,128,0.1); color: #6b7280; cursor: pointer; }
  .cal-cell.maintenance { background-color: rgba(245,158,11,0.1); color: var(--gold); cursor: pointer; }
  .cal-cell:hover:not(.header):not(.room-name) { filter: brightness(0.95); }
  
  [data-bs-theme="dark"] .cal-cell.header, [data-bs-theme="dark"] .cal-cell.room-name { background: var(--bg-card); }
  [data-bs-theme="dark"] .cal-cell.available { background-color: rgba(16,185,129,0.2); }
  [data-bs-theme="dark"] .cal-cell.occupied { background-color: rgba(239,68,68,0.2); }
  [data-bs-theme="dark"] .cal-cell.blocked { background-color: rgba(107,114,128,0.3); }
  [data-bs-theme="dark"] .cal-cell.maintenance { background-color: rgba(245,158,11,0.2); }
</style>
</head><body><div class="ds-ov" id="dsOv"></div><aside class="ds-sb" id="dsSb"><a href="admin-dashboard.php" class="ds-logo"><div class="ds-logo-icon"><i class="bi bi-building-fill"></i></div><div><div class="ds-logo-name">bookHotel</div><div class="ds-logo-role">Manager Portal</div></div></a><nav class="ds-nav"><div class="ds-sec">Main</div><a href="admin-dashboard.php" class="ds-link"><i class="bi bi-grid-fill"></i> Dashboard</a><a href="admin-hotel-profile.php" class="ds-link "><i class="bi bi-building"></i> Hotel Profile</a><div class="ds-sec">Operations</div><a href="admin-rooms.php" class="ds-link "><i class="bi bi-door-open-fill"></i> Rooms</a><a href="admin-bookings.php" class="ds-link "><i class="bi bi-calendar2-check-fill"></i> Bookings <span class="badge bg-danger">3</span></a><a href="admin-guests.php" class="ds-link "><i class="bi bi-people-fill"></i> Guests</a><div class="ds-sec">Inventory & Pricing</div><a href="admin-availability.php" class="ds-link active"><i class="bi bi-calendar-range-fill"></i> Availability</a><a href="admin-pricing.php" class="ds-link "><i class="bi bi-tags-fill"></i> Pricing</a><a href="admin-discounts.php" class="ds-link "><i class="bi bi-percent"></i> Discounts</a><div class="ds-sec">Insights</div><a href="admin-reviews.php" class="ds-link "><i class="bi bi-star-fill"></i> Reviews <span class="badge bg-warning text-dark">5</span></a><a href="admin-revenue.php" class="ds-link "><i class="bi bi-bar-chart-fill"></i> Revenue</a><a href="admin-notifications.php" class="ds-link "><i class="bi bi-bell-fill"></i> Notifications <span class="badge bg-primary">8</span></a><div class="ds-sec">Account</div><a href="admin-settings.php" class="ds-link "><i class="bi bi-gear-fill"></i> Settings</a><a href="index.php" class="ds-link"><i class="bi bi-box-arrow-left"></i> Back to Website</a></nav><div class="ds-foot"><a href="admin-hotel-profile.php" class="ds-hpill"><img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=80&q=80" alt=""/><div><div class="ds-hpill-name">The Grand Palace</div><div class="ds-hpill-status">Active</div></div></a></div></aside><header class="ds-top"><div class="ds-top-l"><button class="ds-ibtn d-lg-none" id="dsTog"><i class="bi bi-list fs-5"></i></button><div><div class="ds-page-title">Availability Management</div><div class="ds-breadcrumb">Dashboard / Inventory & Pricing / Availability</div></div></div><div class="ds-top-r"><a href="admin-notifications.php" class="ds-ibtn"><i class="bi bi-bell-fill"></i><span class="ds-dot"></span></a><div class="ds-avbtn" id="dsAvBtn"><div class="ds-av">AD</div><span class="ds-avname d-none d-sm-block">Aditi</span><div class="ds-dropdown" id="dsAvMenu"><a href="admin-settings.php" class="ds-drop-item"><i class="bi bi-person-fill text-primary"></i> My Profile</a><hr class="my-1 mx-2"/><a href="login.php" class="ds-drop-item danger"><i class="bi bi-box-arrow-right"></i> Sign Out</a></div></div></div></header><main class="ds-main">
  <!-- Stat Cards -->
  <div class="row g-3 mb-4">
    <div class="col-6 col-md-3"><div class="ds-stat blue"><div class="ds-si"><i class="bi bi-door-open-fill"></i></div><div class="ds-sn">30</div><div class="ds-sl">Total Rooms</div></div></div>
    <div class="col-6 col-md-3"><div class="ds-stat green"><div class="ds-si"><i class="bi bi-check-circle-fill"></i></div><div class="ds-sn">9</div><div class="ds-sl">Available</div></div></div>
    <div class="col-6 col-md-3"><div class="ds-stat red"><div class="ds-si"><i class="bi bi-person-fill"></i></div><div class="ds-sn">18</div><div class="ds-sl">Occupied</div></div></div>
    <div class="col-6 col-md-3"><div class="ds-stat gold"><div class="ds-si"><i class="bi bi-tools"></i></div><div class="ds-sn">3</div><div class="ds-sl">Maintenance</div></div></div>
  </div>

  <div class="ds-card">
    <div class="ds-ch">
      <div class="ds-ct"><i class="bi bi-calendar-range"></i> Room Availability Matrix</div>
      <div class="d-flex gap-2 flex-wrap">
        <input type="month" class="ds-inp" style="width:200px" value="2026-07"/>
        <button class="ds-btn outl" data-bs-toggle="modal" data-bs-target="#bulkUpdateModal"><i class="bi bi-ui-checks-grid"></i> Bulk Update</button>
      </div>
    </div>
    
    <div class="p-3 pb-0 d-flex gap-3 text-muted" style="font-size: 0.85rem;">
      <span class="d-flex align-items-center gap-1"><i class="bi bi-square-fill text-success"></i> Available</span>
      <span class="d-flex align-items-center gap-1"><i class="bi bi-square-fill text-danger"></i> Occupied</span>
      <span class="d-flex align-items-center gap-1"><i class="bi bi-square-fill text-warning"></i> Maintenance</span>
      <span class="d-flex align-items-center gap-1"><i class="bi bi-square-fill text-secondary"></i> Blocked</span>
    </div>

    <div class="p-3">
      <div class="calendar-grid">
        <!-- Header Row -->
        <div class="cal-row">
          <div class="cal-cell room-name header">Room</div>
          <div class="cal-cell header">01 Jul</div><div class="cal-cell header">02 Jul</div><div class="cal-cell header">03 Jul</div>
          <div class="cal-cell header">04 Jul</div><div class="cal-cell header">05 Jul</div><div class="cal-cell header">06 Jul</div>
          <div class="cal-cell header">07 Jul</div><div class="cal-cell header">08 Jul</div><div class="cal-cell header">09 Jul</div>
          <div class="cal-cell header">10 Jul</div><div class="cal-cell header">11 Jul</div><div class="cal-cell header">12 Jul</div>
          <div class="cal-cell header">13 Jul</div><div class="cal-cell header">14 Jul</div>
        </div>
        
        <!-- Room 101 -->
        <div class="cal-row">
          <div class="cal-cell room-name">101 - Std</div>
          <div class="cal-cell available" onclick="openUpdateModal('101', '2026-07-01')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('101', '2026-07-02')">Avail</div>
          <div class="cal-cell occupied" title="Booking #B2901">Occ</div>
          <div class="cal-cell occupied" title="Booking #B2901">Occ</div>
          <div class="cal-cell occupied" title="Booking #B2901">Occ</div>
          <div class="cal-cell available" onclick="openUpdateModal('101', '2026-07-06')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('101', '2026-07-07')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('101', '2026-07-08')">Avail</div>
          <div class="cal-cell blocked" onclick="openUpdateModal('101', '2026-07-09')">Blk</div>
          <div class="cal-cell maintenance" onclick="openUpdateModal('101', '2026-07-10')">Maint</div>
          <div class="cal-cell maintenance" onclick="openUpdateModal('101', '2026-07-11')">Maint</div>
          <div class="cal-cell available" onclick="openUpdateModal('101', '2026-07-12')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('101', '2026-07-13')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('101', '2026-07-14')">Avail</div>
        </div>

        <!-- Room 201 -->
        <div class="cal-row">
          <div class="cal-cell room-name">201 - Dlx</div>
          <div class="cal-cell occupied" title="Booking #B1021">Occ</div>
          <div class="cal-cell occupied" title="Booking #B1021">Occ</div>
          <div class="cal-cell available" onclick="openUpdateModal('201', '2026-07-03')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('201', '2026-07-04')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('201', '2026-07-05')">Avail</div>
          <div class="cal-cell occupied" title="Booking #B3002">Occ</div>
          <div class="cal-cell occupied" title="Booking #B3002">Occ</div>
          <div class="cal-cell occupied" title="Booking #B3002">Occ</div>
          <div class="cal-cell occupied" title="Booking #B3002">Occ</div>
          <div class="cal-cell available" onclick="openUpdateModal('201', '2026-07-10')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('201', '2026-07-11')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('201', '2026-07-12')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('201', '2026-07-13')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('201', '2026-07-14')">Avail</div>
        </div>
        
        <!-- Room 301 -->
        <div class="cal-row">
          <div class="cal-cell room-name">301 - Suite</div>
          <div class="cal-cell available" onclick="openUpdateModal('301', '2026-07-01')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('301', '2026-07-02')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('301', '2026-07-03')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('301', '2026-07-04')">Avail</div>
          <div class="cal-cell blocked" onclick="openUpdateModal('301', '2026-07-05')">Blk</div>
          <div class="cal-cell blocked" onclick="openUpdateModal('301', '2026-07-06')">Blk</div>
          <div class="cal-cell blocked" onclick="openUpdateModal('301', '2026-07-07')">Blk</div>
          <div class="cal-cell available" onclick="openUpdateModal('301', '2026-07-08')">Avail</div>
          <div class="cal-cell occupied" title="Booking #B4412">Occ</div>
          <div class="cal-cell occupied" title="Booking #B4412">Occ</div>
          <div class="cal-cell available" onclick="openUpdateModal('301', '2026-07-11')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('301', '2026-07-12')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('301', '2026-07-13')">Avail</div>
          <div class="cal-cell available" onclick="openUpdateModal('301', '2026-07-14')">Avail</div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Single Update Modal -->
<div class="modal fade ds-modal" id="updateModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Update Availability</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
      <div class="modal-body p-4">
        <div class="mb-3">
          <label class="ds-lbl">Room Number</label>
          <input class="ds-inp" id="singleRoomNum" readonly />
        </div>
        <div class="mb-3">
          <label class="ds-lbl">Date</label>
          <input type="date" class="ds-inp" id="singleDate" />
        </div>
        <div class="mb-3">
          <label class="ds-lbl">New Status</label>
          <select class="ds-inp ds-sel">
            <option>Available</option>
            <option>Blocked</option>
            <option>Maintenance</option>
          </select>
          <small class="text-muted d-block mt-1">Note: You cannot manually set a room to 'Occupied' here. It must be done via a Booking.</small>
        </div>
      </div>
      <div class="modal-footer">
        <button class="ds-btn gho" data-bs-dismiss="modal">Cancel</button>
        <button class="ds-btn prim" onclick="dsToast('Availability updated!','success')" data-bs-dismiss="modal">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Bulk Update Modal -->
<div class="modal fade ds-modal" id="bulkUpdateModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title"><i class="bi bi-ui-checks-grid me-2"></i>Bulk Update Availability</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
      <div class="modal-body p-4">
        <div class="mb-3">
          <label class="ds-lbl">Select Rooms (Hold Ctrl/Cmd)</label>
          <select class="ds-inp ds-sel" multiple style="height:100px;">
            <option value="all">All Rooms</option>
            <option>101 - Standard</option>
            <option>102 - Standard</option>
            <option>201 - Deluxe</option>
            <option>301 - Suite</option>
          </select>
        </div>
        <div class="row g-3 mb-3">
          <div class="col-6">
            <label class="ds-lbl">From Date</label>
            <input type="date" class="ds-inp" />
          </div>
          <div class="col-6">
            <label class="ds-lbl">To Date</label>
            <input type="date" class="ds-inp" />
          </div>
        </div>
        <div class="mb-3">
          <label class="ds-lbl">Set Status To</label>
          <select class="ds-inp ds-sel">
            <option>Available</option>
            <option>Blocked</option>
            <option>Maintenance</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button class="ds-btn gho" data-bs-dismiss="modal">Cancel</button>
        <button class="ds-btn prim" onclick="dsToast('Bulk update successful!','success')" data-bs-dismiss="modal">Apply Bulk Update</button>
      </div>
    </div>
  </div>
</div>

<script>
  let modalInstance = null;
  function openUpdateModal(room, date) {
    document.getElementById('singleRoomNum').value = room;
    document.getElementById('singleDate').value = date;
    if(!modalInstance) modalInstance = new bootstrap.Modal(document.getElementById('updateModal'));
    modalInstance.show();
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js" crossorigin="anonymous"></script><script src="dashboard.js"></script></body></html>
