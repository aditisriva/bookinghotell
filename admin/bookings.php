<?php
$pageTitle = 'Booking Oversight';
$pageSubtitle = 'Reservations, cancellations, and booking workflow';
include 'partials/header.php';
?>
<section class="row g-3 mb-3">
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat blue"><div class="ds-si"><i class="bi bi-calendar2-check-fill"></i></div><div class="ds-sn">1,208</div><div class="ds-sl">Total Bookings</div><div class="ds-tr up"><i class="bi bi-arrow-up-short"></i>+6.8% weekly</div></div></div>
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat green"><div class="ds-si"><i class="bi bi-check-circle-fill"></i></div><div class="ds-sn">1,042</div><div class="ds-sl">Confirmed</div><div class="ds-tr up"><i class="bi bi-arrow-up-short"></i>86% on track</div></div></div>
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat gold"><div class="ds-si"><i class="bi bi-hourglass-split"></i></div><div class="ds-sn">84</div><div class="ds-sl">Pending</div><div class="ds-tr down"><i class="bi bi-arrow-down-short"></i>3 need action</div></div></div>
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat red"><div class="ds-si"><i class="bi bi-x-circle-fill"></i></div><div class="ds-sn">32</div><div class="ds-sl">Cancelled</div><div class="ds-tr down"><i class="bi bi-arrow-down-short"></i>2.6% rate</div></div></div>
</section>
<div class="ds-card">
  <div class="ds-ch"><div class="ds-ct"><i class="bi bi-calendar2-check-fill"></i> Reservation Queue</div><div class="d-flex flex-wrap gap-2"><div class="ds-sw"><i class="bi bi-search ds-si-ic"></i><input class="ds-inp search" placeholder="Search bookings" style="width:240px" /></div><button class="ds-btn outl sm"><i class="bi bi-download"></i> Export</button></div></div>
  <div class="ds-cb">
    <div style="overflow-x:auto"><table class="ds-tbl"><thead><tr><th>Booking ID</th><th>Guest</th><th>Hotel</th><th>Status</th><th>Amount</th><th>Actions</th></tr></thead><tbody><tr><td>#B101</td><td>Ravi Mehta</td><td>Blue Peak Retreat</td><td><span class="ds-badge confirmed">Confirmed</span></td><td>₹8,500</td><td><button class="ds-btn gho sm">Details</button></td></tr><tr><td>#B102</td><td>Neha Rao</td><td>Grand Horizon</td><td><span class="ds-badge pending">Pending</span></td><td>₹12,900</td><td><button class="ds-btn gho sm">Review</button></td></tr><tr><td>#B103</td><td>Arun Sinha</td><td>Lakeside Haven</td><td><span class="ds-badge cancelled">Cancelled</span></td><td>₹6,200</td><td><button class="ds-btn gho sm">Resolve</button></td></tr></tbody></table></div>
  </div>
</div>
<?php include 'partials/footer.php'; ?>