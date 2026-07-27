@extends('layouts.app')

@section('content')
<!-- PAGE HERO -->
<section class="umkm-hero">
  <div class="container">
    <div class="umkm-hero-badge">
      <i class="fas fa-store-alt"></i> Direktori UMKM
    </div>
    <h1 class="umkm-hero-title">UMKM Desa Kragilan</h1>
    <p class="umkm-hero-desc">
      Temukan dan dukung usaha mikro, kecil, dan menengah milik warga Desa Kragilan.<br>
      Bersama kita tumbuhkan ekonomi lokal yang mandiri dan berdaya.
    </p>
    <div class="umkm-hero-stat">
      <div class="umkm-stat-item">
        <span class="umkm-stat-num">{{ $totalUmkm }}</span>
        <span class="umkm-stat-label">UMKM Terdaftar</span>
      </div>
      <div class="umkm-stat-divider"></div>
      <div class="umkm-stat-item">
        <span class="umkm-stat-num">{{ count($kategoriList) }}</span>
        <span class="umkm-stat-label">Kategori Usaha</span>
      </div>
      <div class="umkm-stat-divider"></div>
      <div class="umkm-stat-item">
        <span class="umkm-stat-num">100%</span>
        <span class="umkm-stat-label">Produk Lokal</span>
      </div>
    </div>
  </div>
  <div class="umkm-hero-wave">
    <svg viewBox="0 0 1440 80" preserveAspectRatio="none"><path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#f8fafc"/></svg>
  </div>
</section>

<!-- FILTER & SEARCH -->
<section class="umkm-filter-section">
  <div class="container">
    <form method="GET" action="{{ route('umkm') }}" class="umkm-filter-form" id="umkmFilterForm">
      <!-- Search -->
      <div class="umkm-search-wrap">
        <i class="fas fa-search umkm-search-icon"></i>
        <input
          type="text"
          name="search"
          id="umkmSearch"
          placeholder="Cari nama usaha, pemilik, atau produk..."
          value="{{ $search }}"
          class="umkm-search-input"
        />
        @if($search)
          <a href="{{ route('umkm', ['kategori' => $kategori !== 'semua' ? $kategori : '']) }}" class="umkm-search-clear" title="Hapus pencarian">
            <i class="fas fa-times"></i>
          </a>
        @endif
      </div>

      <!-- Kategori Pills -->
      <div class="umkm-kategori-pills">
        <button type="submit" name="kategori" value="semua"
          class="umkm-pill {{ $kategori === 'semua' || !$kategori ? 'active' : '' }}">
          <i class="fas fa-th-large"></i> Semua
        </button>
        @foreach($kategoriList as $key => $kat)
        <button type="submit" name="kategori" value="{{ $key }}"
          class="umkm-pill {{ $kategori === $key ? 'active' : '' }}"
          style="{{ $kategori === $key ? '--pill-color:'.$kat['color'].';' : '' }}">
          <i class="fas {{ $kat['icon'] }}"></i> {{ $kat['label'] }}
        </button>
        @endforeach
      </div>
    </form>
  </div>
</section>

<!-- UMKM GRID -->
<section class="umkm-grid-section">
  <div class="container">

    @if($search || ($kategori && $kategori !== 'semua'))
    <div class="umkm-filter-info">
      <i class="fas fa-filter"></i>
      Menampilkan <strong>{{ $umkms->count() }}</strong> hasil
      @if($search) untuk "<strong>{{ $search }}</strong>" @endif
      @if($kategori && $kategori !== 'semua')
        dalam kategori <strong>{{ $kategoriList[$kategori]['label'] ?? $kategori }}</strong>
      @endif
      &mdash; <a href="{{ route('umkm') }}">Tampilkan semua</a>
    </div>
    @endif

    @if($umkms->isEmpty())
    <div class="umkm-empty">
      <i class="fas fa-store-slash"></i>
      <h3>Belum ada UMKM ditemukan</h3>
      <p>Coba ubah kata kunci pencarian atau pilih kategori yang berbeda.</p>
      <a href="{{ route('umkm') }}" class="btn-umkm-primary">Lihat Semua UMKM</a>
    </div>
    @else
    <div class="umkm-grid">
      @foreach($umkms as $umkm)
      @php
        $kat = $kategoriList[$umkm->kategori] ?? ['label' => $umkm->kategori, 'icon' => 'fa-store', 'color' => '#6b7280'];
      @endphp
      <div class="umkm-card" data-aos="fade-up" onclick="window.location.href='{{ route('umkm.show', $umkm->id) }}'" style="cursor: pointer;" title="Lihat detail UMKM">
        @if($umkm->gambar_utama)
        <div class="umkm-card-banner" style="background-image: url('{{ $umkm->gambar_utama_url }}');">
          <div class="umkm-card-header-overlay">
            <span class="umkm-kategori-badge" style="background: {{ $kat['color'] }}; color: #fff; border:none; box-shadow:0 2px 8px rgba(0,0,0,.2);">
              <i class="fas {{ $kat['icon'] }}"></i> {{ $kat['label'] }}
            </span>
            @if($umkm->no_hp)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm->no_hp) }}" target="_blank" class="umkm-wa-btn" title="Hubungi via WhatsApp" style="box-shadow:0 2px 8px rgba(0,0,0,.15);" onclick="event.stopPropagation()">
              <i class="fab fa-whatsapp"></i>
            </a>
            @endif
          </div>
        </div>
        @else
        <!-- Card Top Color Bar -->
        <div class="umkm-card-topbar" style="background: {{ $kat['color'] }};"></div>

        <!-- Kategori Badge -->
        <div class="umkm-card-header">
          <span class="umkm-kategori-badge" style="background: {{ $kat['color'] }}1a; color: {{ $kat['color'] }}; border-color: {{ $kat['color'] }}33;">
            <i class="fas {{ $kat['icon'] }}"></i> {{ $kat['label'] }}
          </span>
          @if($umkm->no_hp)
          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm->no_hp) }}" target="_blank" class="umkm-wa-btn" title="Hubungi via WhatsApp" onclick="event.stopPropagation()">
            <i class="fab fa-whatsapp"></i>
          </a>
          @endif
        </div>

        <!-- Avatar & Nama -->
        <div class="umkm-card-avatar" style="background: {{ $kat['color'] }}20;">
          <i class="fas {{ $kat['icon'] }}" style="color: {{ $kat['color'] }};"></i>
        </div>
        @endif
        <h3 class="umkm-card-title" @if($umkm->gambar_utama) style="margin-top:20px;" @endif>{{ $umkm->nama_usaha }}</h3>
        <p class="umkm-card-owner"><i class="fas fa-user-circle"></i> {{ $umkm->pemilik }}</p>

        <!-- Produk Unggulan -->
        @if($umkm->produk_unggulan)
        <div class="umkm-card-produk">
          <i class="fas fa-star"></i>
          <span>{{ $umkm->produk_unggulan }}</span>
        </div>
        @endif

        <!-- Deskripsi -->
        @if($umkm->deskripsi)
        <p class="umkm-card-desc">{{ Str::limit($umkm->deskripsi, 100) }}</p>
        @endif

        <!-- Info Row -->
        <div class="umkm-card-info">
          @if($umkm->alamat)
          <div class="umkm-info-row">
            <i class="fas fa-map-marker-alt"></i>
            <span>{{ Str::limit($umkm->alamat, 50) }}</span>
          </div>
          @endif
          @if($umkm->jam_buka)
          <div class="umkm-info-row">
            <i class="fas fa-clock"></i>
            <span>{{ $umkm->jam_buka }}</span>
          </div>
          @endif
        </div>

        <!-- Gallery Produk -->
        @if(!empty($umkm->gambar_produk))
        <div class="umkm-card-gallery">
          @foreach(array_slice($umkm->gambar_produk_urls, 0, 4) as $url)
          <div class="umkm-gallery-item" style="background-image: url('{{ $url }}');" onclick="event.stopPropagation(); window.open('{{ $url }}', '_blank')" title="Lihat Foto Produk"></div>
          @endforeach
        </div>
        @endif

        <!-- Sosmed Links -->
        @if($umkm->instagram || $umkm->facebook || $umkm->no_hp)
        <div class="umkm-card-socials">
          @if($umkm->no_hp)
          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm->no_hp) }}" target="_blank" class="umkm-social-link wa" title="WhatsApp" onclick="event.stopPropagation()">
            <i class="fab fa-whatsapp"></i> WhatsApp
          </a>
          @endif
          @if($umkm->instagram)
          <a href="https://instagram.com/{{ ltrim($umkm->instagram, '@') }}" target="_blank" class="umkm-social-link ig" title="Instagram" onclick="event.stopPropagation()">
            <i class="fab fa-instagram"></i> Instagram
          </a>
          @endif
          @if($umkm->facebook)
          <a href="https://facebook.com/{{ $umkm->facebook }}" target="_blank" class="umkm-social-link fb" title="Facebook" onclick="event.stopPropagation()">
            <i class="fab fa-facebook-f"></i> Facebook
          </a>
          @endif
        </div>
        @endif
      </div>
      @endforeach
    </div>
    @endif

  </div>
</section>

<!-- CTA DAFTAR UMKM -->
<section class="umkm-cta-section">
  <div class="container">
    <div class="umkm-cta-box">
      <div class="umkm-cta-icon"><i class="fas fa-handshake"></i></div>
      <h2>Punya Usaha di Desa Kragilan?</h2>
      <p>Daftarkan usaha Anda agar lebih dikenal warga dan mudah ditemukan oleh pelanggan.</p>
      <div class="umkm-cta-actions">
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteInfo->contact_whatsapp) }}?text=Halo%2C%20saya%20ingin%20mendaftarkan%20UMKM%20saya%20di%20Desa%20Kragilan." target="_blank" class="btn-umkm-primary">
          <i class="fab fa-whatsapp"></i> Daftar via WhatsApp
        </a>
        <a href="{{ route('home') }}#kontak" class="btn-umkm-outline">
          <i class="fas fa-envelope"></i> Hubungi Kami
        </a>
      </div>
    </div>
  </div>
</section>

<style>
/* ══════════════════════════════════════
   UMKM PAGE STYLES
══════════════════════════════════════ */

/* HERO */
.umkm-hero {
  position: relative;
  background: linear-gradient(135deg, #1a6b3c 0%, #2d9e5f 50%, #1a6b3c 100%);
  padding: 80px 0 0;
  text-align: center;
  overflow: hidden;
}
.umkm-hero::before {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle at 30% 50%, rgba(255,255,255,0.06) 0%, transparent 50%),
              radial-gradient(circle at 70% 30%, rgba(255,255,255,0.04) 0%, transparent 40%);
  pointer-events: none;
}
.umkm-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255,255,255,0.15);
  border: 1px solid rgba(255,255,255,0.25);
  color: #fff;
  border-radius: 100px;
  padding: 6px 18px;
  font-size: 13px;
  font-weight: 600;
  letter-spacing: 0.5px;
  margin-bottom: 20px;
  backdrop-filter: blur(8px);
}
.umkm-hero-title {
  font-size: clamp(2rem, 5vw, 3.2rem);
  font-weight: 800;
  color: #fff;
  margin: 0 0 16px;
  line-height: 1.15;
}
.umkm-hero-desc {
  font-size: clamp(0.95rem, 2vw, 1.1rem);
  color: rgba(255,255,255,0.85);
  max-width: 560px;
  margin: 0 auto 40px;
  line-height: 1.7;
}
.umkm-hero-stat {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0;
  background: rgba(255,255,255,0.1);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255,255,255,0.2);
  border-radius: 20px;
  padding: 20px 32px;
  display: inline-flex;
  margin-bottom: 48px;
}
.umkm-stat-item { text-align: center; padding: 0 28px; }
.umkm-stat-num {
  display: block;
  font-size: 1.9rem;
  font-weight: 800;
  color: #fff;
  line-height: 1;
}
.umkm-stat-label {
  display: block;
  font-size: 0.75rem;
  color: rgba(255,255,255,0.75);
  margin-top: 4px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.umkm-stat-divider {
  width: 1px;
  height: 40px;
  background: rgba(255,255,255,0.2);
}
.umkm-hero-wave {
  line-height: 0;
  margin-top: -2px;
}
.umkm-hero-wave svg {
  width: 100%;
  display: block;
}

/* FILTER SECTION */
.umkm-filter-section {
  background: #f8fafc;
  padding: 28px 0 20px;
  border-bottom: 1px solid #e2e8f0;
  position: sticky;
  top: 72px;
  z-index: 100;
  box-shadow: 0 2px 12px rgba(0,0,0,0.05);
}
.umkm-filter-form { display: flex; flex-direction: column; gap: 16px; }
.umkm-search-wrap {
  position: relative;
  max-width: 480px;
}
.umkm-search-icon {
  position: absolute;
  left: 16px;
  top: 50%;
  transform: translateY(-50%);
  color: #94a3b8;
  font-size: 15px;
}
.umkm-search-input {
  width: 100%;
  padding: 12px 44px 12px 44px;
  border: 2px solid #e2e8f0;
  border-radius: 12px;
  font-size: 14px;
  font-family: inherit;
  background: #fff;
  transition: border-color 0.2s, box-shadow 0.2s;
  outline: none;
  box-sizing: border-box;
}
.umkm-search-input:focus {
  border-color: #2d9e5f;
  box-shadow: 0 0 0 3px rgba(45,158,95,0.1);
}
.umkm-search-clear {
  position: absolute;
  right: 14px;
  top: 50%;
  transform: translateY(-50%);
  color: #94a3b8;
  text-decoration: none;
  transition: color 0.2s;
}
.umkm-search-clear:hover { color: #ef4444; }

.umkm-kategori-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
.umkm-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 8px 18px;
  border-radius: 100px;
  border: 2px solid #e2e8f0;
  background: #fff;
  font-size: 13px;
  font-weight: 600;
  color: #64748b;
  cursor: pointer;
  transition: all 0.2s;
  font-family: inherit;
}
.umkm-pill:hover {
  border-color: #2d9e5f;
  color: #2d9e5f;
  background: #f0fdf4;
  transform: translateY(-1px);
}
.umkm-pill.active {
  background: var(--pill-color, #2d9e5f);
  border-color: var(--pill-color, #2d9e5f);
  color: #fff;
  box-shadow: 0 4px 12px rgba(45,158,95,0.3);
}

/* GRID SECTION */
.umkm-grid-section {
  background: #f8fafc;
  padding: 36px 0 60px;
}
.umkm-filter-info {
  margin-bottom: 24px;
  font-size: 14px;
  color: #64748b;
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 10px;
  padding: 12px 18px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.umkm-filter-info a { color: #2d9e5f; text-decoration: none; font-weight: 600; }
.umkm-filter-info a:hover { text-decoration: underline; }

.umkm-empty {
  text-align: center;
  padding: 80px 20px;
  color: #94a3b8;
}
.umkm-empty i { font-size: 3.5rem; margin-bottom: 20px; display: block; }
.umkm-empty h3 { font-size: 1.3rem; color: #475569; margin-bottom: 10px; }
.umkm-empty p { font-size: 0.95rem; margin-bottom: 24px; }

.umkm-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 24px;
}

/* UMKM CARD */
.umkm-card {
  background: #fff;
  border-radius: 20px;
  overflow: hidden;
  border: 1px solid #e2e8f0;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  position: relative;
  display: flex;
  flex-direction: column;
}
.umkm-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}
.umkm-card-topbar {
  height: 5px;
  width: 100%;
}
.umkm-card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px 20px 0;
}
.umkm-kategori-badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 4px 12px;
  border-radius: 100px;
  font-size: 11.5px;
  font-weight: 700;
  border: 1px solid;
  letter-spacing: 0.3px;
  text-transform: uppercase;
}
.umkm-wa-btn {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: #f0fdf4;
  color: #16a34a;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  text-decoration: none;
  transition: all 0.2s;
  border: 1px solid #bbf7d0;
}
.umkm-wa-btn:hover {
  background: #16a34a;
  color: #fff;
  transform: scale(1.1);
}
.umkm-card-avatar {
  width: 64px;
  height: 64px;
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
  margin: 16px auto 12px;
}
.umkm-card-banner {
  width: 100%;
  height: 180px;
  background-size: cover;
  background-position: center;
  position: relative;
}
.umkm-card-header-overlay {
  position: absolute;
  top: 0; left: 0; right: 0;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding: 16px 20px;
  background: linear-gradient(to bottom, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0) 100%);
}
.umkm-card-gallery {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 8px;
  padding: 0 20px 16px;
}
.umkm-gallery-item {
  width: 100%;
  aspect-ratio: 1;
  border-radius: 8px;
  background-size: cover;
  background-position: center;
  cursor: pointer;
  border: 1px solid #e2e8f0;
  transition: transform 0.2s, box-shadow 0.2s;
}
.umkm-gallery-item:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  z-index: 10;
}
.umkm-card-title {
  font-size: 1.05rem;
  font-weight: 700;
  color: #1e293b;
  text-align: center;
  margin: 0 20px 4px;
  line-height: 1.3;
}
.umkm-card-owner {
  text-align: center;
  font-size: 13px;
  color: #64748b;
  margin: 0 20px 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 5px;
}
.umkm-card-produk {
  margin: 0 20px 12px;
  background: #fffbeb;
  border: 1px solid #fde68a;
  border-radius: 8px;
  padding: 8px 12px;
  font-size: 12.5px;
  color: #92400e;
  display: flex;
  align-items: center;
  gap: 6px;
}
.umkm-card-produk i { color: #f59e0b; }
.umkm-card-desc {
  font-size: 13px;
  color: #64748b;
  line-height: 1.6;
  margin: 0 20px 12px;
  text-align: center;
}
.umkm-card-info {
  padding: 12px 20px;
  border-top: 1px solid #f1f5f9;
  display: flex;
  flex-direction: column;
  gap: 7px;
  margin-top: auto;
}
.umkm-info-row {
  display: flex;
  align-items: flex-start;
  gap: 8px;
  font-size: 12.5px;
  color: #64748b;
}
.umkm-info-row i { color: #94a3b8; margin-top: 2px; min-width: 14px; }
.umkm-card-socials {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  padding: 12px 20px 16px;
  border-top: 1px solid #f1f5f9;
}
.umkm-social-link {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 6px 14px;
  border-radius: 8px;
  font-size: 12px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.2s;
  flex: 1;
  justify-content: center;
  min-width: 0;
}
.umkm-social-link.wa { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
.umkm-social-link.wa:hover { background: #16a34a; color: #fff; }
.umkm-social-link.ig { background: #fdf4ff; color: #a21caf; border: 1px solid #f0abfc; }
.umkm-social-link.ig:hover { background: #a21caf; color: #fff; }
.umkm-social-link.fb { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
.umkm-social-link.fb:hover { background: #1d4ed8; color: #fff; }

/* CTA */
.umkm-cta-section {
  background: #fff;
  padding: 60px 0;
}
.umkm-cta-box {
  background: linear-gradient(135deg, #1a6b3c 0%, #2d9e5f 100%);
  border-radius: 24px;
  padding: 56px 40px;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.umkm-cta-box::before {
  content: '';
  position: absolute;
  top: -40px;
  right: -40px;
  width: 200px;
  height: 200px;
  background: rgba(255,255,255,0.05);
  border-radius: 50%;
}
.umkm-cta-box::after {
  content: '';
  position: absolute;
  bottom: -60px;
  left: -30px;
  width: 250px;
  height: 250px;
  background: rgba(255,255,255,0.04);
  border-radius: 50%;
}
.umkm-cta-icon {
  width: 72px;
  height: 72px;
  background: rgba(255,255,255,0.15);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 30px;
  color: #fff;
  margin: 0 auto 24px;
  position: relative;
  z-index: 1;
}
.umkm-cta-box h2 {
  font-size: 1.8rem;
  font-weight: 800;
  color: #fff;
  margin: 0 0 12px;
  position: relative;
  z-index: 1;
}
.umkm-cta-box p {
  font-size: 1rem;
  color: rgba(255,255,255,0.85);
  margin: 0 0 32px;
  max-width: 480px;
  margin-left: auto;
  margin-right: auto;
  position: relative;
  z-index: 1;
}
.umkm-cta-actions {
  display: flex;
  gap: 16px;
  justify-content: center;
  flex-wrap: wrap;
  position: relative;
  z-index: 1;
}
.btn-umkm-primary {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #fff;
  color: #1a6b3c;
  padding: 14px 28px;
  border-radius: 12px;
  font-weight: 700;
  font-size: 15px;
  text-decoration: none;
  transition: all 0.25s;
  box-shadow: 0 4px 16px rgba(0,0,0,0.15);
}
.btn-umkm-primary:hover {
  background: #f0fdf4;
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(0,0,0,0.2);
}
.btn-umkm-outline {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: transparent;
  color: #fff;
  padding: 14px 28px;
  border-radius: 12px;
  font-weight: 700;
  font-size: 15px;
  text-decoration: none;
  border: 2px solid rgba(255,255,255,0.4);
  transition: all 0.25s;
}
.btn-umkm-outline:hover {
  background: rgba(255,255,255,0.12);
  border-color: rgba(255,255,255,0.7);
  transform: translateY(-2px);
}

/* RESPONSIVE */
@media (max-width: 768px) {
  .umkm-hero { padding: 60px 0 0; }
  .umkm-hero-stat { flex-direction: column; gap: 0; padding: 16px 24px; }
  .umkm-stat-divider { width: 80px; height: 1px; margin: 10px auto; }
  .umkm-grid { grid-template-columns: 1fr; }
  .umkm-cta-box { padding: 40px 24px; }
  .umkm-cta-box h2 { font-size: 1.4rem; }
  .umkm-filter-section { position: relative; top: auto; }
}
</style>
@endsection
