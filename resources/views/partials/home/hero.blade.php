<!-- HERO -->
<section class="hero" id="beranda">
  <div class="hero-overlay"></div>
  <div class="hero-content container">
    <span class="badge-hero"><i class="fas fa-check-circle"></i> Layanan Aktif</span>
    <h2>{{ $siteInfo->profile_title }}</h2>
    <p>{{ $siteInfo->profile_subtitle }}</p>
    <div class="hero-actions">
      <a href="{{ route('pelayanan') }}" class="btn btn-primary"><i class="fas fa-file-alt"></i> Lihat Jenis Surat</a>
      <a href="{{ route('persyaratan') }}" class="btn btn-outline"><i class="fas fa-list-check"></i> Cek Persyaratan</a>
    </div>
  </div>
</section>
