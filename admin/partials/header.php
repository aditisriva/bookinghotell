<?php
$pageTitle = isset($pageTitle) ? $pageTitle : 'Admin Portal';
$pageSubtitle = isset($pageSubtitle) ? $pageSubtitle : 'Platform oversight';
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($pageTitle) ?> · BookHotel Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="dashboard.css" />
</head>
<body>
  <div class="ds-ov" id="dsOv"></div>
  <aside class="ds-sb" id="dsSb">
    <a href="admin-dashboard.php" class="ds-logo">
      <div class="ds-logo-icon"><i class="bi bi-buildings"></i></div>
      <div>
        <div class="ds-logo-name">BookHotel</div>
        <div class="ds-logo-role">Admin Portal</div>
      </div>
    </a>
    <nav class="ds-nav">
      <div class="ds-sec">Main</div>
      <a href="admin-dashboard.php" class="ds-link <?= $currentPage === 'admin-dashboard.php' ? 'active' : '' ?>"><i class="bi bi-grid-fill"></i> Dashboard</a>
      <a href="users.php" class="ds-link <?= $currentPage === 'users.php' ? 'active' : '' ?>"><i class="bi bi-people-fill"></i> Users</a>
      <a href="managers.php" class="ds-link <?= $currentPage === 'managers.php' ? 'active' : '' ?>"><i class="bi bi-person-badge-fill"></i> Managers</a>
      <a href="hotels.php" class="ds-link <?= $currentPage === 'hotels.php' ? 'active' : '' ?>"><i class="bi bi-building"></i> Hotels</a>
      <a href="bookings.php" class="ds-link <?= $currentPage === 'bookings.php' ? 'active' : '' ?>"><i class="bi bi-calendar2-check-fill"></i> Bookings</a>
      <div class="ds-sec">Operations</div>
      <a href="reviews.php" class="ds-link <?= $currentPage === 'reviews.php' ? 'active' : '' ?>"><i class="bi bi-star-fill"></i> Reviews</a>
      <a href="reports.php" class="ds-link <?= $currentPage === 'reports.php' ? 'active' : '' ?>"><i class="bi bi-bar-chart-fill"></i> Reports</a>
      <a href="settings.php" class="ds-link <?= $currentPage === 'settings.php' ? 'active' : '' ?>"><i class="bi bi-sliders"></i> Settings</a>
      <a href="profile.php" class="ds-link <?= $currentPage === 'profile.php' ? 'active' : '' ?>"><i class="bi bi-person-circle"></i> Profile</a>
      <div class="ds-sec">Support</div>
      <a href="../index.php" class="ds-link"><i class="bi bi-box-arrow-left"></i> Back to Website</a>
    </nav>
    <div class="ds-foot">
      <a href="profile.php" class="ds-hpill">
        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=120&q=80" alt="Admin" />
        <div>
          <div class="ds-hpill-name">Aditi Sharma</div>
          <div class="ds-hpill-status">● Super Admin · Delhi</div>
        </div>
      </a>
    </div>
  </aside>
  <header class="ds-top">
    <div class="ds-top-l">
      <button class="ds-ibtn d-lg-none" id="dsTog"><i class="bi bi-list fs-5"></i></button>
      <div>
        <div class="ds-page-title"><?= htmlspecialchars($pageTitle) ?></div>
        <div class="ds-breadcrumb"><?= htmlspecialchars($pageSubtitle) ?></div>
      </div>
    </div>
    <div class="ds-top-r">
      <div class="ds-sw d-none d-md-block">
        <i class="bi bi-search ds-si-ic"></i>
        <input class="ds-inp search" type="text" placeholder="Search platform data" />
      </div>
      <a href="../hotel/admin-notifications.php" class="ds-ibtn"><i class="bi bi-bell-fill"></i><span class="ds-dot"></span></a>
      <div class="ds-avbtn" id="dsAvBtn">
        <div class="ds-av">AS</div>
        <span class="ds-avname d-none d-sm-block">Aditi</span>
        <i class="bi bi-chevron-down ms-1" style="font-size:.7rem;color:var(--mut)"></i>
        <div class="ds-dropdown" id="dsAvMenu">
          <a href="profile.php" class="ds-drop-item"><i class="bi bi-person-fill text-primary"></i> My Profile</a>
          <a href="settings.php" class="ds-drop-item"><i class="bi bi-gear-fill text-primary"></i> Settings</a>
          <hr class="my-1 mx-2" />
          <a href="../login.php" class="ds-drop-item danger"><i class="bi bi-box-arrow-right"></i> Sign Out</a>
        </div>
      </div>
    </div>
  </header>
  <main class="ds-main">
    <div class="admin-shell">
