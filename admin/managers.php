<?php
$pageTitle = 'Manager Management';
$pageSubtitle = 'Hotel-partner onboarding and account administration';
include 'partials/header.php';
?>
<section class="row g-3 mb-3">
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat purple"><div class="ds-si"><i class="bi bi-person-badge-fill"></i></div><div class="ds-sn">64</div><div class="ds-sl">Registered Managers</div><div class="ds-tr up"><i class="bi bi-arrow-up-short"></i>+4 this month</div></div></div>
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat green"><div class="ds-si"><i class="bi bi-check-circle-fill"></i></div><div class="ds-sn">57</div><div class="ds-sl">Approved</div><div class="ds-tr up"><i class="bi bi-arrow-up-short"></i>89% active</div></div></div>
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat gold"><div class="ds-si"><i class="bi bi-hourglass-split"></i></div><div class="ds-sn">4</div><div class="ds-sl">Pending Approval</div><div class="ds-tr down"><i class="bi bi-arrow-down-short"></i>1 urgent</div></div></div>
  <div class="col-12 col-md-6 col-xl-3"><div class="ds-stat red"><div class="ds-si"><i class="bi bi-slash-circle"></i></div><div class="ds-sn">3</div><div class="ds-sl">Suspended</div><div class="ds-tr down"><i class="bi bi-arrow-down-short"></i>Needs review</div></div></div>
</section>
<div class="row g-3">
  <div class="col-12 col-xl-8">
    <div class="ds-card">
      <div class="ds-ch"><div class="ds-ct"><i class="bi bi-person-badge-fill"></i> Hotel Partner Accounts</div><button class="ds-btn prim sm"><i class="bi bi-check2-circle"></i> Review Queue</button></div>
      <div class="ds-cb">
        <div style="overflow-x:auto"><table class="ds-tbl"><thead><tr><th>Manager</th><th>Hotel</th><th>Status</th><th>Joined</th><th>Actions</th></tr></thead><tbody><tr><td><div class="fw-700">Arjun Bhatia</div><div class="small text-muted">arjun@grandhorizon.com</div></td><td>Grand Horizon</td><td><span class="ds-badge confirmed">Approved</span></td><td>5 May 2026</td><td><button class="ds-btn gho sm">Details</button></td></tr><tr><td><div class="fw-700">Neelima Roy</div><div class="small text-muted">neelima@bluepeak.com</div></td><td>Blue Peak Retreat</td><td><span class="ds-badge pending">Pending</span></td><td>13 Jun 2026</td><td><button class="ds-btn gho sm">Approve</button></td></tr></tbody></table></div>
      </div>
    </div>
  </div>
  <div class="col-12 col-xl-4">
    <div class="ds-card">
      <div class="ds-ch"><div class="ds-ct"><i class="bi bi-clipboard-check"></i> Approval Summary</div></div>
      <div class="ds-cb">
        <div class="health-row"><span>New partner requests</span><strong>4</strong></div>
        <div class="health-row"><span>Identity verification</span><strong>2 pending</strong></div>
        <div class="health-row"><span>Property documents</span><strong>1 missing</strong></div>
        <button class="ds-btn prim mt-3"><i class="bi bi-check2-circle"></i> Start Review</button>
      </div>
    </div>
  </div>
</div>
<?php include 'partials/footer.php'; ?>