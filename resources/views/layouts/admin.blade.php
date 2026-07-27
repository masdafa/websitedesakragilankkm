<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Panel Admin') — Desa Kragilan</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
  /* ═══════════════════════════════════════
     ADMIN PANEL — DESIGN SYSTEM
  ═══════════════════════════════════════ */
  :root {
    --sidebar-w: 260px;
    --primary:   #16a34a;
    --primary-d: #166534;
    --primary-l: #dcfce7;
    --accent:    #f59e0b;
    --danger:    #ef4444;
    --danger-l:  #fee2e2;
    --info:      #3b82f6;
    --info-l:    #eff6ff;
    --surface:   #ffffff;
    --bg:        #f1f5f9;
    --border:    #e2e8f0;
    --text:      #0f172a;
    --muted:     #64748b;
    --sidebar-bg:#0f2e1a;
    --sidebar-text:#e2e8f0;
    --sidebar-muted:#94a3b8;
    --radius-lg: 16px;
    --radius-md: 12px;
    --radius-sm: 8px;
    --shadow-sm: 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.04);
    --shadow-md: 0 4px 16px rgba(0,0,0,.08);
    --shadow-lg: 0 8px 32px rgba(0,0,0,.1);
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-behavior: smooth; }
  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--bg);
    color: var(--text);
    font-size: 14px;
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
  }

  /* ── SHELL ── */
  .adm-shell { display: flex; min-height: 100vh; }

  /* ── SIDEBAR ── */
  .adm-sidebar {
    width: var(--sidebar-w);
    background: var(--sidebar-bg);
    color: var(--sidebar-text);
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0; left: 0; bottom: 0;
    z-index: 200;
    overflow-y: auto;
    transition: transform .3s ease;
  }
  .adm-sidebar::-webkit-scrollbar { width: 4px; }
  .adm-sidebar::-webkit-scrollbar-track { background: transparent; }
  .adm-sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 4px; }

  /* Brand */
  .adm-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 24px 20px 20px;
    border-bottom: 1px solid rgba(255,255,255,.07);
  }
  .adm-brand-logo {
    width: 42px; height: 42px;
    background: linear-gradient(135deg, var(--primary), #22c55e);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; color: #fff;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(22,163,74,.4);
  }
  .adm-brand-text .adm-brand-name {
    font-weight: 800; font-size: 15px; color: #fff; line-height: 1.2;
  }
  .adm-brand-text .adm-brand-sub {
    font-size: 11px; color: var(--sidebar-muted); margin-top: 2px; font-weight: 500;
  }

  /* Nav */
  .adm-nav { padding: 16px 12px; flex: 1; }
  .adm-nav-section { margin-bottom: 6px; }
  .adm-nav-label {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--sidebar-muted);
    padding: 12px 8px 6px;
    display: block;
  }
  .adm-nav-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-radius: 10px;
    text-decoration: none;
    color: rgba(226,232,240,.75);
    font-weight: 500;
    font-size: 13.5px;
    transition: all .2s;
    position: relative;
    margin-bottom: 2px;
  }
  .adm-nav-link:hover {
    background: rgba(255,255,255,.07);
    color: #fff;
  }
  .adm-nav-link.active {
    background: rgba(22,163,74,.2);
    color: #4ade80;
    font-weight: 600;
  }
  .adm-nav-link.active::before {
    content: '';
    position: absolute;
    left: 0; top: 20%; bottom: 20%;
    width: 3px;
    background: #4ade80;
    border-radius: 0 3px 3px 0;
  }
  .adm-nav-link .nav-icon {
    width: 32px; height: 32px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    background: rgba(255,255,255,.06);
    flex-shrink: 0;
    transition: all .2s;
  }
  .adm-nav-link.active .nav-icon {
    background: rgba(22,163,74,.25);
  }
  .adm-nav-link:hover .nav-icon {
    background: rgba(255,255,255,.1);
  }
  .adm-nav-badge {
    margin-left: auto;
    background: #ef4444;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 7px;
    border-radius: 100px;
    line-height: 1.4;
  }
  .adm-nav-badge.yellow { background: var(--accent); }

  /* Sidebar Bottom */
  .adm-sidebar-bottom {
    padding: 12px;
    border-top: 1px solid rgba(255,255,255,.07);
  }
  .adm-user-card {
    display: flex; align-items: center; gap: 10px;
    padding: 12px;
    border-radius: 10px;
    background: rgba(255,255,255,.05);
    margin-bottom: 10px;
  }
  .adm-user-avatar {
    width: 36px; height: 36px;
    background: linear-gradient(135deg, #22c55e, #15803d);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; color: #fff; font-weight: 700;
    flex-shrink: 0;
  }
  .adm-user-name { font-size: 13px; font-weight: 600; color: #fff; }
  .adm-user-role { font-size: 11px; color: var(--sidebar-muted); }
  .adm-logout-btn {
    width: 100%;
    display: flex; align-items: center; justify-content: center; gap: 8px;
    padding: 10px;
    border-radius: 10px;
    background: rgba(239,68,68,.15);
    color: #fca5a5;
    border: 1px solid rgba(239,68,68,.2);
    font-size: 13px; font-weight: 600;
    cursor: pointer;
    transition: all .2s;
    font-family: inherit;
  }
  .adm-logout-btn:hover {
    background: rgba(239,68,68,.25);
    color: #fecaca;
  }

  /* ── TOPBAR ── */
  .adm-topbar {
    position: sticky; top: 0; z-index: 100;
    background: rgba(241,245,249,.92);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--border);
    padding: 0 28px;
    height: 64px;
    display: flex; align-items: center; justify-content: space-between;
    gap: 16px;
  }
  .adm-topbar-left { display: flex; align-items: center; gap: 12px; }
  .adm-topbar-right { display: flex; align-items: center; gap: 10px; }
  .adm-breadcrumb {
    display: flex; align-items: center; gap: 6px;
    font-size: 13px; color: var(--muted);
  }
  .adm-breadcrumb-sep { color: #cbd5e1; }
  .adm-breadcrumb-curr { font-weight: 600; color: var(--text); }
  .adm-topbar-btn {
    width: 38px; height: 38px;
    border-radius: 10px;
    border: 1px solid var(--border);
    background: var(--surface);
    color: var(--muted);
    display: flex; align-items: center; justify-content: center;
    font-size: 15px;
    cursor: pointer;
    text-decoration: none;
    transition: all .2s;
    position: relative;
  }
  .adm-topbar-btn:hover { background: var(--bg); color: var(--text); }
  .adm-topbar-dot {
    position: absolute;
    top: 6px; right: 6px;
    width: 8px; height: 8px;
    background: #ef4444;
    border-radius: 50%;
    border: 2px solid var(--bg);
  }
  .adm-menu-toggle {
    display: none;
  }

  /* ── MAIN ── */
  .adm-main {
    flex: 1;
    margin-left: var(--sidebar-w);
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
  .adm-page {
    flex: 1;
    padding: 28px;
  }

  /* ── PAGE HEADER ── */
  .adm-page-header {
    margin-bottom: 24px;
  }
  .adm-page-title {
    font-size: 1.6rem;
    font-weight: 800;
    color: var(--text);
    line-height: 1.2;
  }
  .adm-page-subtitle {
    font-size: 13px;
    color: var(--muted);
    margin-top: 4px;
  }

  /* ── CARDS ── */
  .adm-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
  }
  .adm-card-body { padding: 24px; }
  .adm-card-header {
    padding: 18px 24px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between; gap: 12px;
    flex-wrap: wrap;
  }
  .adm-card-title {
    font-size: 1rem; font-weight: 700; color: var(--text);
  }

  /* STAT CARDS */
  .adm-stats { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px,1fr)); gap: 16px; margin-bottom: 24px; }
  .adm-stat {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 20px;
    display: flex; align-items: center; gap: 16px;
    transition: transform .2s, box-shadow .2s;
    box-shadow: var(--shadow-sm);
  }
  .adm-stat:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }
  .adm-stat-icon {
    width: 48px; height: 48px;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }
  .adm-stat-num { font-size: 1.8rem; font-weight: 800; line-height: 1; }
  .adm-stat-label { font-size: 12px; color: var(--muted); margin-top: 4px; font-weight: 500; }
  .adm-stat.green .adm-stat-icon { background: #dcfce7; color: #16a34a; }
  .adm-stat.yellow .adm-stat-icon { background: #fef9c3; color: #ca8a04; }
  .adm-stat.blue .adm-stat-icon { background: #dbeafe; color: #2563eb; }
  .adm-stat.red .adm-stat-icon { background: #fee2e2; color: #dc2626; }
  .adm-stat.purple .adm-stat-icon { background: #f3e8ff; color: #9333ea; }
  .adm-stat.orange .adm-stat-icon { background: #ffedd5; color: #ea580c; }

  /* ── BUTTONS ── */
  .btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 18px;
    border-radius: 10px;
    font-size: 13.5px; font-weight: 600;
    cursor: pointer; border: none;
    text-decoration: none; font-family: inherit;
    transition: all .2s;
    line-height: 1;
  }
  .btn:active { transform: scale(.97); }
  .btn-primary { background: var(--primary); color: #fff; }
  .btn-primary:hover { background: var(--primary-d); box-shadow: 0 4px 12px rgba(22,163,74,.3); }
  .btn-secondary { background: #f1f5f9; color: #374151; border: 1px solid var(--border); }
  .btn-secondary:hover { background: var(--border); }
  .btn-danger { background: var(--danger-l); color: var(--danger); border: 1px solid #fca5a5; }
  .btn-danger:hover { background: var(--danger); color: #fff; }
  .btn-info { background: var(--info-l); color: var(--info); border: 1px solid #bfdbfe; }
  .btn-info:hover { background: var(--info); color: #fff; }
  .btn-warning { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
  .btn-warning:hover { background: var(--accent); color: #fff; }
  .btn-sm { padding: 6px 12px; font-size: 12px; border-radius: 8px; }
  .btn-icon { width: 34px; height: 34px; padding: 0; justify-content: center; border-radius: 8px; }

  /* ── TABLE ── */
  .adm-table-wrap { overflow-x: auto; }
  .adm-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
  }
  .adm-table thead tr { background: #f8fafc; }
  .adm-table th {
    padding: 13px 16px;
    text-align: left;
    font-weight: 700;
    color: var(--muted);
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: .06em;
    white-space: nowrap;
    border-bottom: 2px solid var(--border);
  }
  .adm-table td {
    padding: 13px 16px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
  }
  .adm-table tbody tr { transition: background .15s; }
  .adm-table tbody tr:hover { background: #fafbfc; }
  .adm-table tbody tr:last-child td { border-bottom: none; }

  /* ── BADGES ── */
  .badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 3px 10px;
    border-radius: 100px;
    font-size: 11.5px; font-weight: 700;
  }
  .badge-green  { background: #dcfce7; color: #15803d; }
  .badge-yellow { background: #fef9c3; color: #92400e; }
  .badge-blue   { background: #dbeafe; color: #1d4ed8; }
  .badge-red    { background: #fee2e2; color: #b91c1c; }
  .badge-gray   { background: #f1f5f9; color: #475569; }
  .badge-purple { background: #f3e8ff; color: #7e22ce; }

  /* ── FORM ELEMENTS ── */
  .frm-group { display: flex; flex-direction: column; gap: 6px; }
  .frm-label { font-size: 13px; font-weight: 600; color: #374151; }
  .frm-required { color: var(--danger); margin-left: 3px; }
  .frm-hint { font-size: 11.5px; color: var(--muted); }
  .frm-input, .frm-select, .frm-textarea {
    width: 100%;
    padding: 10px 14px;
    border: 2px solid var(--border);
    border-radius: var(--radius-sm);
    font-size: 14px;
    font-family: inherit;
    background: #fff;
    color: var(--text);
    transition: border-color .2s, box-shadow .2s;
    outline: none;
  }
  .frm-input:focus, .frm-select:focus, .frm-textarea:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(22,163,74,.1);
  }
  .frm-input::placeholder, .frm-textarea::placeholder { color: #cbd5e1; }
  .frm-textarea { resize: vertical; min-height: 90px; }
  .frm-select { cursor: pointer; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; background-size: 18px; padding-right: 36px; }
  .frm-grid { display: grid; gap: 18px; }
  .frm-grid-2 { grid-template-columns: repeat(auto-fit, minmax(260px,1fr)); }
  .frm-grid-3 { grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); }

  /* Toggle */
  .frm-toggle-wrap { display: flex; align-items: center; gap: 12px; }
  .frm-toggle {
    position: relative; width: 44px; height: 24px; cursor: pointer;
    flex-shrink: 0;
  }
  .frm-toggle input { opacity: 0; width: 0; height: 0; }
  .frm-toggle-slider {
    position: absolute; top: 0; left: 0; right: 0; bottom: 0;
    background: #cbd5e1; border-radius: 24px; transition: .3s;
  }
  .frm-toggle-slider::before {
    content: '';
    position: absolute;
    height: 18px; width: 18px;
    left: 3px; bottom: 3px;
    background: #fff;
    border-radius: 50%;
    transition: .3s;
    box-shadow: 0 1px 3px rgba(0,0,0,.2);
  }
  .frm-toggle input:checked + .frm-toggle-slider { background: var(--primary); }
  .frm-toggle input:checked + .frm-toggle-slider::before { transform: translateX(20px); }

  /* ── ALERTS ── */
  .adm-alert {
    display: flex; align-items: flex-start; gap: 10px;
    padding: 14px 16px;
    border-radius: var(--radius-md);
    margin-bottom: 20px;
    font-size: 13.5px;
  }
  .adm-alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
  .adm-alert-error   { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
  .adm-alert i { margin-top: 1px; flex-shrink: 0; }

  /* ── EMPTY STATE ── */
  .adm-empty {
    text-align: center; padding: 60px 20px; color: var(--muted);
  }
  .adm-empty-icon {
    width: 64px; height: 64px;
    background: #f1f5f9;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 24px; color: #94a3b8;
    margin: 0 auto 16px;
  }
  .adm-empty h3 { font-size: 1.1rem; color: var(--text); margin-bottom: 8px; }
  .adm-empty p { font-size: 13px; margin-bottom: 20px; }

  /* ── RESPONSIVE ── */
  @media (max-width: 1024px) {
    :root { --sidebar-w: 220px; }
    .adm-page { padding: 20px; }
  }
  @media (max-width: 768px) {
    .adm-sidebar {
      transform: translateX(-100%);
      width: 260px;
    }
    .adm-sidebar.open { transform: translateX(0); }
    .adm-main { margin-left: 0; }
    .adm-menu-toggle { display: flex; }
    .adm-topbar { padding: 0 16px; }
    .adm-page { padding: 16px; }
    .adm-stats { grid-template-columns: repeat(2, 1fr); }
    .adm-overlay { position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 199; display: none; }
    .adm-overlay.open { display: block; }
  }
  @media (max-width: 480px) {
    .adm-stats { grid-template-columns: 1fr; }
  }

  /* Backward compat */
  .admin-alert { display: flex; align-items: center; gap: 10px; padding: 14px 16px; border-radius: 12px; margin-bottom: 20px; font-size: 13.5px; background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
  .admin-button { display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; border-radius: 10px; border: none; background: var(--primary); color: #fff; text-decoration: none; cursor: pointer; font-size: 13.5px; font-weight: 600; font-family: inherit; transition: all .2s; }
  .admin-button:hover { background: var(--primary-d); }
  .admin-card { background: var(--surface); border-radius: var(--radius-lg); border: 1px solid var(--border); padding: 24px; box-shadow: var(--shadow-sm); }
  table { width: 100%; border-collapse: collapse; }
  th, td { padding: 12px 14px; border-bottom: 1px solid #f1f5f9; text-align: left; font-size: 13.5px; }
  th { font-weight: 700; color: var(--muted); font-size: 11px; text-transform: uppercase; letter-spacing: .05em; background: #f8fafc; border-bottom: 2px solid var(--border); }
  </style>
</head>
<body>
<div class="adm-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<div class="adm-shell">
  <!-- ════ SIDEBAR ════ -->
  <aside class="adm-sidebar" id="adminSidebar">
    <div class="adm-brand">
      <div class="adm-brand-logo"><i class="fas fa-seedling"></i></div>
      <div class="adm-brand-text">
        <div class="adm-brand-name">Desa Kragilan</div>
        <div class="adm-brand-sub">Panel Administrasi</div>
      </div>
    </div>

    <nav class="adm-nav">
      <div class="adm-nav-section">
        <span class="adm-nav-label">Utama</span>
        <a href="{{ route('admin.dashboard') }}" class="adm-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <span class="nav-icon"><i class="fas fa-th-large"></i></span>
          Dashboard
        </a>
      </div>

      <div class="adm-nav-section">
        <span class="adm-nav-label">Layanan</span>
        <a href="{{ route('admin.submissions') }}" class="adm-nav-link {{ request()->routeIs('admin.submissions') || request()->routeIs('admin.chat.*') ? 'active' : '' }}">
          <span class="nav-icon"><i class="fas fa-file-alt"></i></span>
          Pengajuan Surat
          @php $pendingCount = \App\Models\PengajuanSurat::where('status','Pending')->count(); @endphp
          @if($pendingCount > 0)
            <span class="adm-nav-badge">{{ $pendingCount }}</span>
          @endif
        </a>
        <a href="{{ route('admin.umkm.index') }}" class="adm-nav-link {{ request()->routeIs('admin.umkm.*') ? 'active' : '' }}">
          <span class="nav-icon"><i class="fas fa-store"></i></span>
          UMKM Desa
          @php $umkmCount = \App\Models\Umkm::where('aktif',true)->count(); @endphp
          @if($umkmCount > 0)
            <span class="adm-nav-badge yellow">{{ $umkmCount }}</span>
          @endif
        </a>
        <a href="{{ route('admin.testimonials') }}" class="adm-nav-link {{ request()->routeIs('admin.testimonials') ? 'active' : '' }}">
          <span class="nav-icon"><i class="fas fa-comments"></i></span>
          Testimoni
          @php $pendingTestimoni = \App\Models\Testimoni::where('disetujui',false)->count(); @endphp
          @if($pendingTestimoni > 0)
            <span class="adm-nav-badge">{{ $pendingTestimoni }}</span>
          @endif
        </a>
      </div>

      <div class="adm-nav-section">
        <span class="adm-nav-label">Pengaturan</span>
        <a href="{{ route('admin.site.settings') }}" class="adm-nav-link {{ request()->routeIs('admin.site.*') ? 'active' : '' }}">
          <span class="nav-icon"><i class="fas fa-sliders-h"></i></span>
          Pengaturan Situs
        </a>
        <a href="{{ route('home') }}" target="_blank" class="adm-nav-link">
          <span class="nav-icon"><i class="fas fa-external-link-alt"></i></span>
          Lihat Website
        </a>
      </div>
    </nav>

    <div class="adm-sidebar-bottom">
      <div class="adm-user-card">
        <div class="adm-user-avatar">A</div>
        <div>
          <div class="adm-user-name">{{ session('admin_name', 'Admin') }}</div>
          <div class="adm-user-role">Administrator</div>
        </div>
      </div>
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="adm-logout-btn">
          <i class="fas fa-sign-out-alt"></i> Logout
        </button>
      </form>
    </div>
  </aside>

  <!-- ════ MAIN ════ -->
  <main class="adm-main">
    <!-- Topbar -->
    <div class="adm-topbar">
      <div class="adm-topbar-left">
        <button class="adm-topbar-btn adm-menu-toggle" id="menuToggle" onclick="toggleSidebar()">
          <i class="fas fa-bars"></i>
        </button>
        <div class="adm-breadcrumb">
          <a href="{{ route('admin.dashboard') }}" style="color:inherit; text-decoration:none;">
            <i class="fas fa-home"></i>
          </a>
          <span class="adm-breadcrumb-sep">/</span>
          <span class="adm-breadcrumb-curr">@yield('page-heading', 'Dashboard')</span>
        </div>
      </div>
      <div class="adm-topbar-right">
        <a href="{{ route('home') }}" target="_blank" class="adm-topbar-btn" title="Lihat website publik">
          <i class="fas fa-external-link-alt"></i>
        </a>
        <a href="{{ route('admin.submissions') }}" class="adm-topbar-btn" title="Pengajuan">
          <i class="fas fa-bell"></i>
          @if(\App\Models\PengajuanSurat::where('status','Pending')->count() > 0)
            <span class="adm-topbar-dot"></span>
          @endif
        </a>
        <div style="width:36px;height:36px;background:linear-gradient(135deg,#22c55e,#15803d);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#fff;">A</div>
      </div>
    </div>

    <!-- Page Content -->
    <div class="adm-page">
      <div class="adm-page-header">
        <h1 class="adm-page-title">@yield('page-heading', 'Dashboard')</h1>
        @hasSection('page-subtitle')
          <p class="adm-page-subtitle">@yield('page-subtitle')</p>
        @endif
      </div>
      @yield('content')
    </div>
  </main>
</div>

<script>
function toggleSidebar() {
  document.getElementById('adminSidebar').classList.toggle('open');
  document.getElementById('sidebarOverlay').classList.toggle('open');
}
function closeSidebar() {
  document.getElementById('adminSidebar').classList.remove('open');
  document.getElementById('sidebarOverlay').classList.remove('open');
}
</script>
@stack('scripts')
</body>
</html>
