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
  <style>
    /* ── No-sidebar overrides ── */
    .adm-topnav {
      position: fixed; top: 0; left: 0; right: 0; z-index: 1040;
      background: #0f172a;
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 1.5rem; height: 60px;
      box-shadow: 0 2px 12px rgba(0,0,0,.25);
    }
    .adm-brand { display: flex; align-items: center; gap: .65rem; text-decoration: none; flex-shrink: 0; }
    .adm-brand-icon { width: 34px; height: 34px; border-radius: 9px; background: linear-gradient(135deg,#1a56db,#1d4ed8); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1rem; box-shadow: 0 4px 12px rgba(26,86,219,.4); }
    .adm-brand-name { font-size: .9rem; font-weight: 800; color: #fff; }
    .adm-brand-role { font-size: .62rem; color: rgba(255,255,255,.4); text-transform: uppercase; letter-spacing: .08em; }
    .adm-links { display: flex; align-items: center; gap: .15rem; overflow-x: auto; }
    .adm-link { display: flex; align-items: center; gap: .4rem; padding: .4rem .75rem; border-radius: 8px; color: rgba(255,255,255,.6); font-size: .82rem; font-weight: 500; text-decoration: none; white-space: nowrap; transition: all .18s; border-bottom: 2px solid transparent; }
    .adm-link i { font-size: .95rem; }
    .adm-link:hover { color: #fff; background: rgba(255,255,255,.07); }
    .adm-link.active { color: #fff; background: rgba(26,86,219,.25); border-bottom-color: #3b82f6; }
    .adm-right { display: flex; align-items: center; gap: .55rem; flex-shrink: 0; }
    .adm-search { position: relative; }
    .adm-search input { background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); border-radius: 8px; padding: .38rem .8rem .38rem 2.1rem; color: #fff; font-size: .8rem; width: 200px; outline: none; transition: all .2s; font-family: 'Inter', sans-serif; }
    .adm-search input::placeholder { color: rgba(255,255,255,.35); }
    .adm-search input:focus { background: rgba(255,255,255,.13); border-color: rgba(255,255,255,.3); width: 240px; }
    .adm-search i { position: absolute; left: .65rem; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,.4); font-size: .85rem; }
    .adm-ibtn { width: 34px; height: 34px; border-radius: 8px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.1); display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,.65); cursor: pointer; position: relative; text-decoration: none; transition: all .18s; }
    .adm-ibtn:hover { background: rgba(255,255,255,.14); color: #fff; }
    .adm-dot { position: absolute; top: 5px; right: 5px; width: 7px; height: 7px; border-radius: 50%; background: #ef4444; border: 2px solid #0f172a; }
    .adm-avbtn { display: flex; align-items: center; gap: .45rem; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.1); border-radius: 50px; padding: .25rem .7rem .25rem .25rem; cursor: pointer; position: relative; transition: all .18s; }
    .adm-avbtn:hover { background: rgba(255,255,255,.14); }
    .adm-av { width: 27px; height: 27px; border-radius: 50%; background: linear-gradient(135deg,#f59e0b,#d97706); color: #0f172a; font-size: .68rem; font-weight: 800; display: flex; align-items: center; justify-content: center; }
    .adm-avname { font-size: .78rem; font-weight: 600; color: rgba(255,255,255,.85); }
    .adm-dropdown { position: absolute; top: calc(100% + 8px); right: 0; background: #fff; border: 1.5px solid #e2e8f0; border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,.14); min-width: 185px; padding: .4rem; z-index: 1060; display: none; }
    .adm-dropdown.show { display: block; }
    .adm-drop-item { display: flex; align-items: center; gap: .55rem; padding: .55rem .7rem; font-size: .83rem; color: #334155; text-decoration: none; border-radius: 8px; transition: background .15s; }
    .adm-drop-item:hover { background: #f0f5ff; color: #1a56db; }
    .adm-drop-item.danger { color: #dc2626; }
    .adm-drop-item.danger:hover { background: #fff5f5; }

    /* Page layout — full width, padded below top bar */
    .ds-main { margin-left: 0 !important; margin-top: 60px !important; padding: 2rem 1.75rem; min-height: calc(100vh - 60px); }
    .ds-top { display: none !important; }
    .ds-sb  { display: none !important; }
    .ds-ov  { display: none !important; }

    /* Page header below topnav */
    .adm-page-header { margin-bottom: 1.5rem; }
    .adm-page-title  { font-size: 1.15rem; font-weight: 800; color: #0f172a; }
    .adm-page-sub    { font-size: .8rem; color: #64748b; margin-top: .1rem; }

    @media(max-width: 768px) {
      .adm-links { display: none; }
      .adm-search input { width: 130px; }
      .ds-main { padding: 1.25rem 1rem; }
    }
  </style>
</head>
<body>

  <!-- ─── Top Navigation Bar (replaces sidebar) ─── -->
  <nav class="adm-topnav">
    <!-- Brand -->
    <a href="admin-dashboard.php" class="adm-brand">
      <div class="adm-brand-icon"><i class="bi bi-buildings"></i></div>
      <div>
        <div class="adm-brand-name">BookHotel</div>
        <div class="adm-brand-role">Admin Portal</div>
      </div>
    </a>

    <!-- Nav Links -->
    <div class="adm-links">
      <a href="admin-dashboard.php" class="adm-link <?= $currentPage === 'admin-dashboard.php' ? 'active' : '' ?>"><i class="bi bi-grid-fill"></i> Dashboard</a>
      <a href="users.php"           class="adm-link <?= $currentPage === 'users.php'           ? 'active' : '' ?>"><i class="bi bi-people-fill"></i> Users</a>
      <a href="managers.php"        class="adm-link <?= $currentPage === 'managers.php'        ? 'active' : '' ?>"><i class="bi bi-person-badge-fill"></i> Managers</a>
      <a href="hotels.php"          class="adm-link <?= $currentPage === 'hotels.php'          ? 'active' : '' ?>"><i class="bi bi-building"></i> Hotels</a>
      <a href="bookings.php"        class="adm-link <?= $currentPage === 'bookings.php'        ? 'active' : '' ?>"><i class="bi bi-calendar2-check-fill"></i> Bookings</a>
      <a href="settings.php"        class="adm-link <?= $currentPage === 'settings.php'        ? 'active' : '' ?>"><i class="bi bi-sliders"></i> Settings</a>
      <a href="../index.php"        class="adm-link"><i class="bi bi-box-arrow-left"></i> Website</a>
    </div>

    <!-- Right actions -->
    <div class="adm-right">
      <div class="adm-search d-none d-md-block">
        <i class="bi bi-search"></i>
        <input type="text" placeholder="Search…" />
      </div>
      <a href="../hotel/admin-notifications.php" class="adm-ibtn">
        <i class="bi bi-bell-fill" style="color:rgba(255,255,255,.7)"></i>
        <span class="adm-dot"></span>
      </a>
      <div class="adm-avbtn" id="admAvBtn">
        <div class="adm-av">AS</div>
        <span class="adm-avname d-none d-sm-block">Aditi</span>
        <i class="bi bi-chevron-down ms-1" style="font-size:.65rem;color:rgba(255,255,255,.5)"></i>
        <div class="adm-dropdown" id="admAvMenu">
          <a href="profile.php"     class="adm-drop-item"><i class="bi bi-person-fill text-primary"></i> My Profile</a>
          <a href="settings.php"    class="adm-drop-item"><i class="bi bi-gear-fill text-primary"></i> Settings</a>
          <hr class="my-1 mx-2" />
          <a href="../login.php"    class="adm-drop-item danger"><i class="bi bi-box-arrow-right"></i> Sign Out</a>
        </div>
      </div>
    </div>
  </nav>

  <main class="ds-main">
    <!-- Page heading -->
    <div class="adm-page-header">
      <div class="adm-page-title"><?= htmlspecialchars($pageTitle) ?></div>
      <div class="adm-page-sub"><?= htmlspecialchars($pageSubtitle) ?></div>
    </div>
    <div class="admin-shell">
