<?php
$pageTitle = 'Hotel Management';
$pageSubtitle = 'Property listings, approvals, and platform quality';
include 'partials/header.php';
?>
<section class="row g-3 mb-3">
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat blue"><div class="ds-si"><i class="bi bi-buildings"></i></div><div class="ds-sn">186</div><div class="ds-sl">Listed Hotels</div><div class="ds-tr up"><i class="bi bi-arrow-up-short"></i>+8 this month</div></div></div>
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat green"><div class="ds-si"><i class="bi bi-check-circle-fill"></i></div><div class="ds-sn">162</div><div class="ds-sl">Verified</div><div class="ds-tr up"><i class="bi bi-arrow-up-short"></i>87% approved</div></div></div>
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat gold"><div class="ds-si"><i class="bi bi-hourglass-split"></i></div><div class="ds-sn">7</div><div class="ds-sl">Pending Review</div><div class="ds-tr down"><i class="bi bi-arrow-down-short"></i>2 urgent</div></div></div>
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat red"><div class="ds-si"><i class="bi bi-exclamation-triangle-fill"></i></div><div class="ds-sn">5</div><div class="ds-sl">Flagged Listings</div><div class="ds-tr down"><i class="bi bi-arrow-down-short"></i>Needs action</div></div></div>
</section>
<div class="ds-card">
  <div class="ds-ch"><div class="ds-ct"><i class="bi bi-building"></i> Platform Hotels</div><button class="ds-btn prim sm"><i class="bi bi-check2-circle"></i> Approve New Hotels</button></div>
  <div class="ds-cb">
    <div style="overflow-x:auto"><table class="ds-tbl"><thead><tr><th>Hotel</th><th>Location</th><th>Manager</th><th>Status</th><th>Actions</th></tr></thead><tbody><tr><td><div class="fw-700">Blue Peak Retreat</div><div class="small text-muted">Beachfront · Goa</div></td><td>Goa</td><td>Arjun Bhatia</td><td><span class="ds-badge confirmed">Approved</span></td><td><button class="ds-btn gho sm">Manage</button></td></tr><tr><td><div class="fw-700">Lakeside Haven</div><div class="small text-muted">Hill resort · Manali</div></td><td>Manali</td><td>Neelima Roy</td><td><span class="ds-badge pending">Pending</span></td><td><button class="ds-btn gho sm">Review</button></td></tr></tbody></table></div>
  </div>
</div>
<?php include 'partials/footer.php'; ?>