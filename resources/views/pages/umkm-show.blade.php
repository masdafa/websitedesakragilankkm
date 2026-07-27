@extends('layouts.app')

@section('title', $umkm->nama_usaha . ' - UMKM Desa Kragilan')

@section('content')
@php
  $kat = $kategoriList[$umkm->kategori] ?? ['label' => $umkm->kategori, 'icon' => 'fa-store', 'color' => '#6b7280'];
@endphp

<!-- HERO SECTION -->
<section class="umkm-detail-hero" style="background: linear-gradient(135deg, {{ $kat['color'] }} 0%, #1e293b 100%); padding: 80px 0 60px; position: relative; overflow: hidden; color: #fff;">
  <div class="container" style="position: relative; z-index: 2;">
    <div style="display: flex; flex-wrap: wrap; gap: 30px; align-items: center;">
      <!-- Avatar/Image placeholder -->
      @if($umkm->gambar_utama)
      <div style="width: 150px; height: 150px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); background: url('{{ $umkm->gambar_utama_url }}') center/cover; border: 4px solid rgba(255,255,255,0.2);"></div>
      @else
      <div style="width: 150px; height: 150px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); background: rgba(255,255,255,0.1); border: 4px solid rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; font-size: 60px;">
        <i class="fas {{ $kat['icon'] }}"></i>
      </div>
      @endif

      <div style="flex: 1; min-width: 300px;">
        <span style="display: inline-block; padding: 6px 16px; background: rgba(255,255,255,0.2); backdrop-filter: blur(5px); border-radius: 100px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;">
          <i class="fas {{ $kat['icon'] }}"></i> {{ $kat['label'] }}
        </span>
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 10px; line-height: 1.2;">{{ $umkm->nama_usaha }}</h1>
        <p style="font-size: 1.1rem; opacity: 0.9; margin-bottom: 0;">
          <i class="fas fa-user-circle" style="margin-right: 8px;"></i> Dimiliki oleh <strong>{{ $umkm->pemilik }}</strong>
        </p>
      </div>
    </div>
  </div>
  <!-- Decor -->
  <div style="position: absolute; bottom: -50px; right: -50px; width: 300px; height: 300px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
</section>

<section class="umkm-detail-content" style="padding: 60px 0; background: #f8fafc;">
  <div class="container">
    
    <div style="margin-bottom: 24px;">
      <a href="{{ route('umkm') }}" style="display: inline-flex; align-items: center; gap: 8px; color: #64748b; text-decoration: none; font-weight: 600; font-size: 15px; transition: color 0.2s;" onmouseover="this.style.color='#0f172a'" onmouseout="this.style.color='#64748b'">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar UMKM
      </a>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; align-items: start;">
      <!-- LEFT COL -->
      <div style="display: flex; flex-direction: column; gap: 30px;">
        
        <!-- About -->
        <div style="background: #fff; border-radius: 20px; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);">
          <h2 style="font-size: 1.5rem; font-weight: 700; color: #1e293b; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-info-circle" style="color: {{ $kat['color'] }};"></i> Tentang Usaha
          </h2>
          @if($umkm->deskripsi)
            <p style="font-size: 15px; color: #475569; line-height: 1.8; margin-bottom: 0;">
              {!! nl2br(e($umkm->deskripsi)) !!}
            </p>
          @else
            <p style="font-size: 15px; color: #94a3b8; font-style: italic; margin-bottom: 0;">Belum ada deskripsi usaha yang ditambahkan.</p>
          @endif
        </div>

        <!-- Gallery -->
        @if(!empty($umkm->gambar_produk))
        <div style="background: #fff; border-radius: 20px; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);">
          <h2 style="font-size: 1.5rem; font-weight: 700; color: #1e293b; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-images" style="color: {{ $kat['color'] }};"></i> Galeri Produk
          </h2>
          <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 15px;">
            @foreach($umkm->gambar_produk_urls as $url)
            <div style="aspect-ratio: 1; border-radius: 12px; background: url('{{ $url }}') center/cover; cursor: pointer; border: 1px solid #e2e8f0; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'" onclick="window.open('{{ $url }}','_blank')" title="Lihat ukuran penuh"></div>
            @endforeach
          </div>
        </div>
        @endif

      </div>

      <!-- RIGHT COL -->
      <div style="display: flex; flex-direction: column; gap: 30px;">
        
        <!-- Info Card -->
        <div style="background: #fff; border-radius: 20px; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);">
          <h2 style="font-size: 1.25rem; font-weight: 700; color: #1e293b; margin-bottom: 20px;">Informasi Detail</h2>
          
          <div style="display: flex; flex-direction: column; gap: 15px;">
            @if($umkm->produk_unggulan)
            <div style="display: flex; gap: 12px; align-items: flex-start;">
              <div style="width: 32px; height: 32px; border-radius: 8px; background: #fffbeb; color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 14px; flex-shrink: 0;">
                <i class="fas fa-star"></i>
              </div>
              <div>
                <div style="font-size: 12px; font-weight: 600; color: #94a3b8; margin-bottom: 2px;">PRODUK UNGGULAN</div>
                <div style="font-size: 14px; color: #334155; font-weight: 500;">{{ $umkm->produk_unggulan }}</div>
              </div>
            </div>
            @endif

            @if($umkm->jam_buka)
            <div style="display: flex; gap: 12px; align-items: flex-start;">
              <div style="width: 32px; height: 32px; border-radius: 8px; background: #f1f5f9; color: #64748b; display: flex; align-items: center; justify-content: center; font-size: 14px; flex-shrink: 0;">
                <i class="fas fa-clock"></i>
              </div>
              <div>
                <div style="font-size: 12px; font-weight: 600; color: #94a3b8; margin-bottom: 2px;">JAM BUKA</div>
                <div style="font-size: 14px; color: #334155;">{{ $umkm->jam_buka }}</div>
              </div>
            </div>
            @endif

            @if($umkm->alamat)
            <div style="display: flex; gap: 12px; align-items: flex-start;">
              <div style="width: 32px; height: 32px; border-radius: 8px; background: #fef2f2; color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 14px; flex-shrink: 0;">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <div>
                <div style="font-size: 12px; font-weight: 600; color: #94a3b8; margin-bottom: 2px;">LOKASI</div>
                <div style="font-size: 14px; color: #334155;">{{ $umkm->alamat }}</div>
              </div>
            </div>
            @endif
          </div>
        </div>

        <!-- Contact Card -->
        <div style="background: #fff; border-radius: 20px; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);">
          <h2 style="font-size: 1.25rem; font-weight: 700; color: #1e293b; margin-bottom: 20px;">Hubungi Usaha Ini</h2>
          
          <div style="display: flex; flex-direction: column; gap: 12px;">
            @if($umkm->no_hp)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm->no_hp) }}" target="_blank" style="display: flex; align-items: center; gap: 10px; background: #16a34a; color: #fff; padding: 12px 20px; border-radius: 12px; text-decoration: none; font-weight: 600; justify-content: center; transition: background 0.2s;" onmouseover="this.style.background='#15803d'" onmouseout="this.style.background='#16a34a'">
              <i class="fab fa-whatsapp" style="font-size: 18px;"></i> Chat via WhatsApp
            </a>
            @endif

            @if($umkm->instagram)
            <a href="https://instagram.com/{{ ltrim($umkm->instagram, '@') }}" target="_blank" style="display: flex; align-items: center; gap: 10px; background: #fdf4ff; color: #c026d3; border: 1px solid #f5d0fe; padding: 12px 20px; border-radius: 12px; text-decoration: none; font-weight: 600; justify-content: center; transition: background 0.2s;" onmouseover="this.style.background='#fae8ff'" onmouseout="this.style.background='#fdf4ff'">
              <i class="fab fa-instagram" style="font-size: 18px;"></i> @{{ ltrim($umkm->instagram, '@') }}
            </a>
            @endif

            @if($umkm->facebook)
            <a href="https://facebook.com/{{ $umkm->facebook }}" target="_blank" style="display: flex; align-items: center; gap: 10px; background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; padding: 12px 20px; border-radius: 12px; text-decoration: none; font-weight: 600; justify-content: center; transition: background 0.2s;" onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
              <i class="fab fa-facebook" style="font-size: 18px;"></i> Facebook
            </a>
            @endif

            @if(!$umkm->no_hp && !$umkm->instagram && !$umkm->facebook)
            <p style="font-size: 14px; color: #94a3b8; text-align: center; margin-bottom: 0; font-style: italic;">Tidak ada informasi kontak daring.</p>
            @endif
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- RWD Styles -->
<style>
@media (max-width: 992px) {
  .umkm-detail-content .container > div:nth-child(2) {
    grid-template-columns: 1fr !important;
  }
}
@media (max-width: 768px) {
  .umkm-detail-hero .container > div {
    flex-direction: column;
    text-align: center;
  }
  .umkm-detail-hero h1 {
    font-size: 2rem !important;
  }
}
</style>
@endsection
