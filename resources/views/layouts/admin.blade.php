<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Panel Admin') - Desa Kragilan</title>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  <style>
    body { margin: 0; font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; color: #0f172a; }
    .admin-shell { display: flex; min-height: 100vh; }
    .admin-sidebar { width: 280px; background: #0f5132; color: #f8fafc; display: flex; flex-direction: column; padding: 32px 20px; gap: 24px; }
    .admin-brand { display: flex; align-items: center; gap: 14px; margin-bottom: 6px; }
    .admin-brand-icon { width: 46px; height: 46px; background: #d1fae5; border-radius: 14px; display: grid; place-items: center; color: #0f5132; }
    .admin-brand-title { font-size: 1.05rem; font-weight: 700; line-height: 1.2; }
    .admin-sidebar nav { display: flex; flex-direction: column; gap: 10px; }
    .admin-nav-link { display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 14px; text-decoration: none; color: #e2e8f0; background: rgba(255,255,255,.04); transition: background .2s ease; }
    .admin-nav-link:hover, .admin-nav-link.active { background: rgba(255,255,255,.18); }
    .admin-nav-link .icon { width: 20px; text-align: center; }
    .admin-sidebar .admin-section-label { text-transform: uppercase; font-size: .75rem; letter-spacing: .14em; color: #94a3b8; margin-top: 16px; }
    .admin-sidebar .whatsapp-card { margin-top: auto; padding: 16px; border-radius: 18px; background: #10b981; color: #fff; }
    .admin-sidebar .whatsapp-card a { color: #fff; display: inline-block; text-decoration: none; margin-top: 12px; }
    .admin-main { flex: 1; padding: 28px 32px; }
    .admin-topbar { display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap; margin-bottom: 26px; }
    .admin-title { margin: 0; font-size: 1.8rem; font-weight: 700; }
    .admin-user { color: #475569; }
    .admin-content { background: #fff; border-radius: 26px; padding: 28px; box-shadow: 0 20px 50px rgba(15,23,42,.08); }
    .admin-card-grid { display: grid; gap: 18px; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); margin-bottom: 32px; }
    .admin-card { background: #f8fafc; border-radius: 20px; padding: 22px; border: 1px solid #e2e8f0; }
    .admin-card strong { display: block; margin-bottom: 8px; font-size: .95rem; color: #334155; }
    .admin-card span { color: #64748b; font-size: .95rem; }
    .admin-button { display: inline-flex; align-items: center; gap: 10px; padding: 11px 16px; border-radius: 14px; border: 0; background: #0f5132; color: #fff; text-decoration: none; cursor: pointer; }
    .admin-card table { width: 100%; border-collapse: collapse; }
    .admin-card th, .admin-card td { padding: 12px 10px; border-bottom: 1px solid #e2e8f0; text-align: left; }
    .admin-card th { color: #0f172a; font-weight: 700; }
    .admin-alert { background: #ecfdf5; color: #166534; padding: 14px 16px; border-radius: 14px; margin-bottom: 20px; }
    @media (max-width: 900px) {
      .admin-shell { flex-direction: column; }
      .admin-sidebar { width: 100%; flex-direction: row; flex-wrap: wrap; align-items: stretch; padding: 18px; }
      .admin-sidebar nav { width: 100%; }
      .admin-main { padding: 20px; }
      .admin-content { padding: 20px; }
    }
  </style>
</head>
<body>
<div class="admin-shell">
  <aside class="admin-sidebar">
    <div class="admin-brand">
      <div class="admin-brand-icon"><i class="fas fa-home"></i></div>
      <div>
        <div class="admin-brand-title">Desa Kragilan</div>
        <div style="font-size:.85rem; color:#d1fae5;">Panel Admin</div>
      </div>
    </div>

    <nav>
      <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <span class="icon"><i class="fas fa-border-all"></i></span>
        Dashboard
      </a>
      <a href="{{ route('admin.submissions') }}" class="admin-nav-link {{ request()->routeIs('admin.submissions') ? 'active' : '' }}">
        <span class="icon"><i class="fas fa-file-alt"></i></span>
        Pengajuan
      </a>
      <a href="{{ route('admin.testimonials') }}" class="admin-nav-link {{ request()->routeIs('admin.testimonials') ? 'active' : '' }}">
        <span class="icon"><i class="fas fa-comments"></i></span>
        Testimoni
      </a>
      <a href="{{ route('admin.site.settings') }}" class="admin-nav-link {{ request()->routeIs('admin.site.settings') ? 'active' : '' }}">
        <span class="icon"><i class="fas fa-cog"></i></span>
        Pengaturan Situs
      </a>
    </nav>

    <div class="admin-section-label">Hubungi</div>
    <div class="whatsapp-card">
      <strong>Chat Admin via WhatsApp</strong>
      <p style="margin:0; color:rgba(255,255,255,.9); font-size:.95rem;">Tanya status, update layanan, atau minta bantuan cepat.</p>
      <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteInfo->contact_whatsapp ?: '082112345678') }}?text=Halo%20Admin%20Desa%20Kragilan%2C%20saya%20butuh%20bantuan%20untuk%20pengajuan%20surat." target="_blank">Buka WhatsApp</a>
    </div>

    <div class="admin-section-label">Aksi</div>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="admin-button" style="width:100%; justify-content:center;">Logout</button>
    </form>
  </aside>

  <main class="admin-main">
    <div class="admin-topbar">
      <div>
        <h1 class="admin-title">@yield('page-heading', 'Panel Admin')</h1>
        <div class="admin-user">Halo, {{ session('admin_name', 'Admin') }}</div>
      </div>
    </div>

    <div class="admin-content">
      @yield('content')
    </div>
  </main>
</div>
</body>
</html>
