<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"/><meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>Revenue &amp; Reports — Hotel Manager</title>
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
    <a href="admin-revenue.php" class="ds-link active"><i class="bi bi-bar-chart-fill"></i> Revenue</a>
    <a href="admin-notifications.php" class="ds-link"><i class="bi bi-bell-fill"></i> Notifications <span class="badge bg-primary">8</span></a>
    <div class="ds-sec">Account</div>
    <a href="admin-settings.php" class="ds-link"><i class="bi bi-gear-fill"></i> Settings</a>
    <a href="index.php" class="ds-link"><i class="bi bi-box-arrow-left"></i> Back to Website</a>
  </nav>
  <div class="ds-foot"><a href="admin-hotel-profile.php" class="ds-hpill"><img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=80&q=80" alt=""/><div><div class="ds-hpill-name">The Grand Palace</div><div class="ds-hpill-status">● Active · Mumbai</div></div></a></div>
</aside>
<header class="ds-top">
  <div class="ds-top-l">
    <button class="ds-ibtn d-lg-none" id="dsTog"><i class="bi bi-list fs-5"></i></button>
    <div><div class="ds-page-title">Revenue &amp; Reports</div><div class="ds-breadcrumb">Insights &rsaquo; Revenue</div></div>
  </div>
  <div class="ds-top-r">
    <button class="ds-btn prim sm" onclick="dsToast('Report downloaded!','success')"><i class="bi bi-download me-1"></i>Download Report</button>
    <a href="admin-notifications.php" class="ds-ibtn ms-2"><i class="bi bi-bell-fill"></i><span class="ds-dot"></span></a>
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
  <!-- Stat Cards -->
  <div class="row g-3 mb-4">
    <div class="col-6 col-xl-3"><div class="ds-stat blue"><div class="ds-si"><i class="bi bi-currency-rupee"></i></div><div class="ds-sn">₹42L</div><div class="ds-sl">This Month</div><div class="ds-tr up"><i class="bi bi-arrow-up-short"></i>18% vs last month</div></div></div>
    <div class="col-6 col-xl-3"><div class="ds-stat green"><div class="ds-si"><i class="bi bi-graph-up-arrow"></i></div><div class="ds-sn">₹3.6Cr</div><div class="ds-sl">This Year</div><div class="ds-tr up"><i class="bi bi-arrow-up-short"></i>24% vs 2025</div></div></div>
    <div class="col-6 col-xl-3"><div class="ds-stat gold"><div class="ds-si"><i class="bi bi-door-open-fill"></i></div><div class="ds-sn">₹7,250</div><div class="ds-sl">RevPAR</div><div class="ds-tr up"><i class="bi bi-arrow-up-short"></i>+₹320 this month</div></div></div>
    <div class="col-6 col-xl-3"><div class="ds-stat orange"><div class="ds-si"><i class="bi bi-percent"></i></div><div class="ds-sn">60%</div><div class="ds-sl">Occupancy</div><div class="ds-prog mt-2"><div class="ds-progf" style="width:60%;background:linear-gradient(90deg,var(--org),#fb923c)"></div></div></div></div>
  </div>
  <!-- Charts Row -->
  <div class="row g-3 mb-4">
    <div class="col-12 col-xl-8">
      <div class="ds-card">
        <div class="ds-ch"><div class="ds-ct"><i class="bi bi-bar-chart-fill"></i> Monthly Earnings 2026</div><select class="ds-inp ds-sel" style="width:auto;font-size:.8rem;padding:.35rem .75rem"><option>2026</option><option>2025</option></select></div>
        <div class="ds-cb"><div class="ds-chart"><canvas id="monthlyChart" height="260"></canvas></div></div>
      </div>
    </div>
    <div class="col-12 col-xl-4">
      <div class="ds-card h-100">
        <div class="ds-ch"><div class="ds-ct"><i class="bi bi-pie-chart-fill"></i> Revenue by Room Type</div></div>
        <div class="ds-cb"><div class="ds-chart" style="min-height:220px"><canvas id="roomRevChart" height="220"></canvas></div></div>
      </div>
    </div>
  </div>
  <!-- Monthly Breakdown Table -->
  <div class="ds-card">
    <div class="ds-ch">
      <div class="ds-ct"><i class="bi bi-table"></i> Monthly Breakdown 2026</div>
      <button class="ds-btn outl sm" onclick="dsToast('Table exported as CSV!','success')"><i class="bi bi-download me-1"></i>Export</button>
    </div>
    <div style="overflow-x:auto">
      <table class="ds-tbl">
        <thead><tr><th>Month</th><th>Bookings</th><th>Room Revenue</th><th>F&amp;B</th><th>Other</th><th>Total</th><th>Occupancy %</th><th>vs Last Year</th></tr></thead>
        <tbody>
          <tr><td>January</td><td>182</td><td>₹28,40,000</td><td>₹6,20,000</td><td>₹1,80,000</td><td class="fw-700 text-primary">₹36,40,000</td><td><span class="fw-600">52%</span></td><td><span style="color:var(--grn)"><i class="bi bi-arrow-up-short"></i>+14%</span></td></tr>
          <tr><td>February</td><td>196</td><td>₹30,50,000</td><td>₹6,80,000</td><td>₹2,10,000</td><td class="fw-700 text-primary">₹39,40,000</td><td><span class="fw-600">56%</span></td><td><span style="color:var(--grn)"><i class="bi bi-arrow-up-short"></i>+19%</span></td></tr>
          <tr><td>March</td><td>218</td><td>₹33,20,000</td><td>₹7,40,000</td><td>₹2,40,000</td><td class="fw-700 text-primary">₹43,00,000</td><td><span class="fw-600">62%</span></td><td><span style="color:var(--grn)"><i class="bi bi-arrow-up-short"></i>+21%</span></td></tr>
          <tr><td>April</td><td>205</td><td>₹31,80,000</td><td>₹7,00,000</td><td>₹2,20,000</td><td class="fw-700 text-primary">₹41,00,000</td><td><span class="fw-600">59%</span></td><td><span style="color:var(--grn)"><i class="bi bi-arrow-up-short"></i>+17%</span></td></tr>
          <tr><td>May</td><td>224</td><td>₹34,60,000</td><td>₹7,80,000</td><td>₹2,60,000</td><td class="fw-700 text-primary">₹45,00,000</td><td><span class="fw-600">65%</span></td><td><span style="color:var(--grn)"><i class="bi bi-arrow-up-short"></i>+26%</span></td></tr>
          <tr><td>June</td><td>210</td><td>₹32,40,000</td><td>₹7,20,000</td><td>₹2,30,000</td><td class="fw-700 text-primary">₹41,90,000</td><td><span class="fw-600">60%</span></td><td><span style="color:var(--grn)"><i class="bi bi-arrow-up-short"></i>+20%</span></td></tr>
          <tr style="background:rgba(245,158,11,.08)"><td><strong>July</strong> <span class="ds-badge gold ms-1">Current</span></td><td><strong>248</strong></td><td><strong>₹32,80,000</strong></td><td><strong>₹7,10,000</strong></td><td><strong>₹2,10,000</strong></td><td class="fw-700 text-primary"><strong>₹42,00,000</strong></td><td><span class="fw-600">60%</span></td><td><span style="color:var(--grn)"><i class="bi bi-arrow-up-short"></i>+18%</span></td></tr>
        </tbody>
      </table>
    </div>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js" crossorigin="anonymous"></script>
<script src="dashboard.js"></script>
<script>
renderMonthly('monthlyChart');
(function(){
  const ctx=document.getElementById('roomRevChart').getContext('2d');
  new Chart(ctx,{type:'doughnut',data:{labels:['Deluxe King','Ocean Suite','Standard Twin','Presidential','Executive'],datasets:[{data:[35,25,20,12,8],backgroundColor:['#6366f1','#10b981','#f59e0b','#3b82f6','#ef4444'],borderWidth:0,hoverOffset:8}]},options:{plugins:{legend:{position:'bottom',labels:{font:{size:11},padding:12}}},cutout:'65%'}});
})();
</script>
</body></html>

