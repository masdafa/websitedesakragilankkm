<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="Website resmi pelayanan administrasi surat Desa Kragilan, Kecamatan Kragilan, Kabupaten Serang, Provinsi Banten.">
  <title>Pelayanan Surat - Desa Kragilan</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/favicon.svg') }}"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body>

<!-- TOP BAR -->
<div class="top-bar">
  <div class="container top-bar-inner">
    <div class="top-bar-left">
      <span><i class="fas fa-map-marker-alt"></i> Kec. Kragilan, Kab. Serang, Banten</span>
      <span><i class="fas fa-clock"></i> Senin &ndash; Jumat: 08.00 &ndash; 14.00 WIB</span>
    </div>
    <div class="top-bar-right">
      <a href="https://wa.me/6282112345678" target="_blank"><i class="fab fa-whatsapp"></i> 0821-1234-5678</a>
      <a href="mailto:desa@kragilan.go.id"><i class="fas fa-envelope"></i> desa@kragilan.go.id</a>
    </div>
  </div>
</div>

<!-- HEADER -->
<header class="site-header" id="siteHeader">
  <div class="header-inner container">
    <div class="logo-wrap">
      <img src="{{ asset('assets/images/favicon.svg') }}" alt="Logo Desa Kragilan" class="logo"/>
      <div class="header-text">
        <span class="header-label">PEMERINTAH DESA</span>
        <h1 class="header-title">DESA KRAGILAN</h1>
        <span class="header-sub">Kecamatan Kragilan &bull; Kabupaten Serang &bull; Provinsi Banten</span>
      </div>
    </div>
    <nav class="main-nav">
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
      <a href="{{ route('home') }}#profil" class="{{ request()->routeIs('home') ? '' : '' }}">Profil Desa</a>
      <a href="{{ route('pelayanan') }}" class="{{ request()->routeIs('pelayanan') ? 'active' : '' }}">Pelayanan</a>
      <a href="{{ route('persyaratan') }}" class="{{ request()->routeIs('persyaratan') ? 'active' : '' }}">Persyaratan</a>
      <a href="{{ route('pengajuan') }}" class="{{ request()->routeIs('pengajuan') ? 'active' : '' }}">Pengajuan</a>
      <a href="{{ route('cek-status') }}" class="{{ request()->routeIs('cek-status*') ? 'active' : '' }}">Cek Status</a>
      <a href="{{ route('home') }}#panduan">Panduan</a>
      <a href="{{ route('home') }}#kontak">Kontak</a>
    </nav>
    <div class="logo-kkm-wrap">
      <img src="{{ asset('assets/images/logo-kkm.jpg') }}" alt="KKM Kelompok 35 Universitas Bina Bangsa" class="logo-kkm"/>
      <div class="logo-kkm-text">
        <span>KKM Kelompok 35</span>
        <span>Universitas Bina Bangsa</span>
      </div>
    </div>
    <button class="hamburger" id="hamburger" aria-label="Menu">
      <i class="fas fa-bars"></i>
    </button>
  </div>
  <nav class="mobile-nav" id="mobileNav">
    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
    <a href="{{ route('home') }}#profil" class="{{ request()->routeIs('home') ? '' : '' }}">Profil Desa</a>
    <a href="{{ route('pelayanan') }}" class="{{ request()->routeIs('pelayanan') ? 'active' : '' }}">Pelayanan</a>
    <a href="{{ route('persyaratan') }}" class="{{ request()->routeIs('persyaratan') ? 'active' : '' }}">Persyaratan</a>
    <a href="{{ route('pengajuan') }}" class="{{ request()->routeIs('pengajuan') ? 'active' : '' }}">Pengajuan</a>
    <a href="{{ route('cek-status') }}" class="{{ request()->routeIs('cek-status*') ? 'active' : '' }}">Cek Status</a>
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
          <img src="{{ asset('assets/images/favicon.svg') }}" alt="Logo Desa Kragilan" class="footer-logo"/>
          <div>
            <div class="footer-brand-name">Desa Kragilan</div>
            <div class="footer-brand-sub">Kec. Kragilan, Kab. Serang, Banten</div>
          </div>
        </div>
        <p class="footer-desc">Website resmi pelayanan administrasi surat Desa Kragilan. Melayani warga dengan cepat, mudah, dan transparan.</p>
        <div class="footer-socials">
          <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="https://wa.me/6282112345678" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
          <a href="mailto:desa@kragilan.go.id" title="Email"><i class="fas fa-envelope"></i></a>
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
          <li><i class="fas fa-map-marker-alt"></i><span>Jl. Raya Kragilan No. 1, Desa Kragilan, Kec. Kragilan, Kab. Serang, Banten 42183</span></li>
          <li><i class="fas fa-phone-alt"></i><span>(0254) 123-4567</span></li>
          <li><i class="fab fa-whatsapp"></i><span>0821-1234-5678</span></li>
          <li><i class="fas fa-envelope"></i><span>desa@kragilan.go.id</span></li>
          <li><i class="fas fa-clock"></i><span>Senin &ndash; Jumat: 08.00 &ndash; 14.00 WIB</span></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container footer-bottom-inner">
      <span>&copy; 2025 Pemerintah Desa Kragilan. Semua hak dilindungi.</span>
      <span>Dikembangkan oleh <strong>KKM Kelompok 35 &ndash; Universitas Bina Bangsa</strong></span>
    </div>
  </div>
</footer>

<!-- JAM PELAYANAN FIX BOTTOM -->
<div class="announcement-bar-fixed" id="annBar">
  <div class="ann-inner container">
    <span class="ann-icon"><i class="fas fa-bullhorn"></i></span>
    <marquee behavior="scroll" direction="left">
      <strong>Jam Pelayanan:</strong> Senin &ndash; Jumat, Pukul 08.00 &ndash; 14.00 WIB &nbsp;|&nbsp;
      Harap membawa dokumen asli dan fotokopi &nbsp;|&nbsp;
      Informasi: 0821-1234-5678 (WhatsApp) &nbsp;|&nbsp;
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

<script src="{{ asset('assets/js/script.js') }}"></script>
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

