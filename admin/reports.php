<?php
$pageTitle = 'Reports & Analytics';
$pageSubtitle = 'Revenue, occupancy, growth, and platform health';
include 'partials/header.php';
?>
<section class="row g-3 mb-3">
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat blue"><div class="ds-si"><i class="bi bi-currency-rupee"></i></div><div class="ds-sn">₹42.6L</div><div class="ds-sl">Monthly Revenue</div><div class="ds-tr up"><i class="bi bi-arrow-up-short"></i>+18% vs last month</div></div></div>
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat green"><div class="ds-si"><i class="bi bi-graph-up-arrow"></i></div><div class="ds-sn">1,208</div><div class="ds-sl">Bookings</div><div class="ds-tr up"><i class="bi bi-arrow-up-short"></i>+6.8% weekly</div></div></div>
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat gold"><div class="ds-si"><i class="bi bi-house-door-fill"></i></div><div class="ds-sn">76%</div><div class="ds-sl">Occupancy</div><div class="ds-tr up"><i class="bi bi-arrow-up-short"></i>healthy demand</div></div></div>
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat purple"><div class="ds-si"><i class="bi bi-bar-chart-fill"></i></div><div class="ds-sn">18%</div><div class="ds-sl">User Growth</div><div class="ds-tr up"><i class="bi bi-arrow-up-short"></i>steady momentum</div></div></div>
</section>
<div class="row g-3">
  <div class="col-12 col-xl-8">
    <div class="ds-card">
      <div class="ds-ch"><div class="ds-ct"><i class="bi bi-graph-up-arrow"></i> Business Snapshot</div><button class="ds-btn prim sm"><i class="bi bi-download"></i> Export Report</button></div>
      <div class="ds-cb">
        <div class="row g-3">
          <div class="col-md-6"><div class="border rounded-4 p-3"><div class="small text-muted mb-2">Top Performing Region</div><div class="fw-700">Goa</div><div class="small text-muted">24% of bookings</div></div></div>
          <div class="col-md-6"><div class="border rounded-4 p-3"><div class="small text-muted mb-2">Highest Revenue Hotel</div><div class="fw-700">Grand Horizon</div><div class="small text-muted">₹9.4L this month</div></div></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-xl-4">
    <div class="ds-card">
      <div class="ds-ch"><div class="ds-ct"><i class="bi bi-speedometer2"></i> Operational Health</div></div>
      <div class="ds-cb">
        <div class="health-row"><span>Platform uptime</span><strong>99.9%</strong></div>
        <div class="health-row"><span>Response time</span><strong>320ms</strong></div>
        <div class="health-row"><span>Pending issues</span><strong>4</strong></div>
      </div>
    </div>
  </div>
</div>
<?php include 'partials/footer.php'; ?>
