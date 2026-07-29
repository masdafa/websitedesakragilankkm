<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="Website resmi pelayanan administrasi surat Desa Kragilan, Kecamatan Kragilan, Kabupaten Serang, Provinsi Banten.">
  <title>{{ $siteInfo->profile_title ?? 'Pelayanan Surat' }} - Desa Kragilan</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/favicon.svg') }}"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ time() }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body>

<!-- TOP BAR -->
<div class="top-bar">
  <div class="container top-bar-inner">
    <div class="top-bar-left">
      <a href="https://maps.app.goo.gl/2aokwZJpc8S8nWw0Y" target="_blank" rel="noopener" style="color: inherit; text-decoration: none; transition: opacity 0.3s;" onmouseover="this.style.opacity=0.8" onmouseout="this.style.opacity=1"><i class="fas fa-map-marker-alt"></i> {{ $siteInfo->contact_address }}</a>
      <span><i class="fas fa-clock"></i> {{ explode("\n", $siteInfo->service_hours)[0] ?? $siteInfo->service_hours }}</span>
    </div>
    <div class="top-bar-right">
      <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteInfo->contact_whatsapp) }}" target="_blank"><i class="fab fa-whatsapp"></i> {{ $siteInfo->contact_whatsapp }}</a>
      <a href="mailto:{{ $siteInfo->contact_email }}"><i class="fas fa-envelope"></i> {{ $siteInfo->contact_email }}</a>
    </div>
  </div>
</div>

<!-- HEADER -->
<header class="site-header" id="siteHeader">
  <div class="header-inner container">
    <div class="logo-wrap">
      <a href="{{ route('home') }}" style="display:flex;align-items:center;">
        <img src="{{ asset('assets/images/logo-desa.png') }}" alt="Logo Desa Kragilan" style="height:64px;width:auto;object-fit:contain;"/>
      </a>
    </div>
    <nav class="main-nav">
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
      <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">Profil Desa</a>
      <a href="{{ route('pelayanan') }}" class="{{ request()->routeIs('pelayanan') ? 'active' : '' }}">Pelayanan</a>
      <a href="{{ route('persyaratan') }}" class="{{ request()->routeIs('persyaratan') ? 'active' : '' }}">Persyaratan</a>
      <a href="{{ route('pengajuan') }}" class="{{ request()->routeIs('pengajuan') ? 'active' : '' }}">Pengajuan</a>
      <a href="{{ route('cek-status') }}" class="{{ request()->routeIs('cek-status*') ? 'active' : '' }}">Cek Status</a>
      <a href="{{ route('umkm') }}" class="{{ request()->routeIs('umkm') ? 'active' : '' }}">UMKM</a>
      <a href="{{ route('home') }}#panduan">Panduan</a>
      <a href="{{ route('home') }}#kontak">Kontak</a>
    </nav>

    <button class="hamburger" id="hamburger" aria-label="Menu">
      <i class="fas fa-bars"></i>
    </button>
  </div>
  <nav class="mobile-nav" id="mobileNav">
    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
    <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}"><i class="fas fa-info-circle"></i> Profil Desa</a>
    <a href="{{ route('pelayanan') }}" class="{{ request()->routeIs('pelayanan') ? 'active' : '' }}">Pelayanan</a>
    <a href="{{ route('persyaratan') }}" class="{{ request()->routeIs('persyaratan') ? 'active' : '' }}">Persyaratan</a>
    <a href="{{ route('pengajuan') }}" class="{{ request()->routeIs('pengajuan') ? 'active' : '' }}">Pengajuan</a>
    <a href="{{ route('cek-status') }}" class="{{ request()->routeIs('cek-status*') ? 'active' : '' }}">Cek Status</a>
    <a href="{{ route('umkm') }}" class="{{ request()->routeIs('umkm') ? 'active' : '' }}">UMKM</a>
    <a href="{{ route('home') }}#panduan">Panduan</a>
    <a href="{{ route('home') }}#kontak">Kontak</a>
  </nav>
</header>

@yield('content')

<!-- FOOTER -->
<footer class="site-footer" style="padding-bottom: 56px;">
  <div class="footer-top">
    <div class="container footer-grid">
      <div class="footer-col footer-brand-col">
        <div class="footer-logo-wrap">
          <img src="{{ asset('assets/images/logo-desa.png') }}" alt="Logo Desa Kragilan" style="height:52px;width:auto;object-fit:contain;"/>
        </div>
        <p class="footer-desc">Website resmi pelayanan administrasi surat Desa Kragilan. Melayani warga dengan cepat, mudah, dan transparan.</p>
        <div class="footer-socials">
          <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteInfo->contact_whatsapp) }}" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
          <a href="mailto:{{ $siteInfo->contact_email }}" title="Email"><i class="fas fa-envelope"></i></a>
          <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
      <div class="footer-col">
        <h4 class="footer-heading">Navigasi</h4>
        <ul class="footer-list">
          <li><a href="#beranda"><i class="fas fa-chevron-right"></i> Beranda</a></li>
          <li><a href="#profil"><i class="fas fa-chevron-right"></i> Profil Desa</a></li>
          <li><a href="{{ route('pelayanan') }}"><i class="fas fa-chevron-right"></i> Pelayanan</a></li>
          <li><a href="{{ route('persyaratan') }}"><i class="fas fa-chevron-right"></i> Persyaratan</a></li>
          <li><a href="{{ route('umkm') }}"><i class="fas fa-chevron-right"></i> UMKM Desa</a></li>
          <li><a href="#panduan"><i class="fas fa-chevron-right"></i> Panduan Pengajuan</a></li>
          <li><a href="#kontak"><i class="fas fa-chevron-right"></i> Kontak</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4 class="footer-heading">Layanan Surat</h4>
        <ul class="footer-list">
          <li><a href="{{ route('pelayanan') }}"><i class="fas fa-chevron-right"></i> Surat Keterangan Domisili</a></li>
          <li><a href="{{ route('pelayanan') }}"><i class="fas fa-chevron-right"></i> Surat Keterangan Usaha</a></li>
          <li><a href="{{ route('pelayanan') }}"><i class="fas fa-chevron-right"></i> Surat Keterangan Tidak Mampu</a></li>
          <li><a href="{{ route('pelayanan') }}"><i class="fas fa-chevron-right"></i> Surat Pengantar KK/KTP</a></li>
          <li><a href="{{ route('pengajuan') }}"><i class="fas fa-chevron-right"></i> Pengajuan Online</a></li>
          <li><a href="{{ route('cek-status') }}"><i class="fas fa-chevron-right"></i> Cek Status Surat</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4 class="footer-heading">Kontak Kami</h4>
        <ul class="footer-contact-list">
          <li><i class="fas fa-map-marker-alt"></i><a href="https://maps.app.goo.gl/2aokwZJpc8S8nWw0Y" target="_blank" rel="noopener" style="color: inherit; text-decoration: none;">{{ $siteInfo->contact_address }}</a></li>
          <li><i class="fas fa-phone-alt"></i><span>{{ $siteInfo->contact_phone }}</span></li>
          <li><i class="fab fa-whatsapp"></i><span>{{ $siteInfo->contact_whatsapp }}</span></li>
          <li><i class="fas fa-envelope"></i><span>{{ $siteInfo->contact_email }}</span></li>
          <li><i class="fas fa-clock"></i><span>{{ explode("\n", $siteInfo->service_hours)[0] ?? $siteInfo->service_hours }}</span></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container footer-bottom-inner">
      <span>&copy; 2025 Pemerintah Desa Kragilan. Semua hak dilindungi.</span>
      <span>
        Dikembangkan oleh <strong>KKM Kelompok 35 &ndash; Universitas Bina Bangsa</strong>
      </span>
    </div>
  </div>
</footer>

<!-- JAM PELAYANAN FIX BOTTOM -->
<div class="announcement-bar-fixed" id="annBar">
  <div class="ann-inner container">
    <span class="ann-icon"><i class="fas fa-bullhorn"></i></span>
    <marquee behavior="scroll" direction="left">
      <strong>Jam Pelayanan:</strong> {{ $siteInfo->service_hours }} &nbsp;|&nbsp;
      Harap membawa dokumen asli dan fotokopi &nbsp;|&nbsp;
      Informasi: {{ $siteInfo->contact_whatsapp }} (WhatsApp) &nbsp;|&nbsp;
      Pelayanan tutup pada hari libur nasional &nbsp;|&nbsp;
      Pengajuan online tersedia 24 jam melalui website ini
    </marquee>
    <button class="ann-close" id="annClose" title="Tutup"><i class="fas fa-times"></i></button>
  </div>
</div>

<!-- MODAL -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModal()">
  <div class="modal-box" onclick="event.stopPropagation()">
    <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
    <div id="modalContent"></div>
  </div>
</div>

<script src="{{ asset('assets/js/script.js') }}?v={{ time() }}"></script>
<script>
  const siteHeader = document.getElementById('siteHeader');
  const annBar = document.getElementById('annBar');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 60) {
      siteHeader.classList.add('scrolled');
      annBar.classList.add('scrolled');
    } else {
      siteHeader.classList.remove('scrolled');
      annBar.classList.remove('scrolled');
    }
  });
  document.getElementById('annClose').addEventListener('click', () => {
    annBar.style.transform = 'translateY(100%)';
    annBar.style.opacity = '0';
    document.querySelector('.site-footer').style.paddingBottom = '0';
  });
</script>
</body>
</html>

