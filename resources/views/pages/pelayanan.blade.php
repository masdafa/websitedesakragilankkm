@extends("layouts.app")
@section("content")

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container page-hero-inner">
    <div>
      <div class="page-breadcrumb"><a href="{{ route("home") }}">Beranda</a> <i class="fas fa-chevron-right"></i> Pelayanan</div>
      <h2 class="page-title">Pelayanan Administrasi Surat</h2>
      <p class="page-subtitle">Temukan jenis surat yang Anda butuhkan dan ajukan secara online</p>
    </div>
    <a href="{{ route("pengajuan") }}" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Ajukan Sekarang</a>
  </div>
</section>

<section class="section bg-light">
  <div class="container">

    <!-- Filter Bar -->
    <div class="filter-bar">
      <button class="filter-btn active" onclick="filterSurat(this, 'semua')">Semua</button>
      <button class="filter-btn" onclick="filterSurat(this, 'kependudukan')">Kependudukan</button>
      <button class="filter-btn" onclick="filterSurat(this, 'usaha')">Usaha &amp; Ekonomi</button>
      <button class="filter-btn" onclick="filterSurat(this, 'sosial')">Sosial &amp; Kesehatan</button>
      <button class="filter-btn" onclick="filterSurat(this, 'tanah')">Tanah &amp; Bangunan</button>
    </div>

    <!-- Surat Grid -->
    <div class="surat-grid">
      @php
      $suratList = [
        ['icon'=>'fa-id-card','kat'=>'kependudukan','nama'=>'Surat Keterangan Domisili','desc'=>'Untuk keperluan pendaftaran sekolah, NPWP, rekening bank, dan lainnya.','waktu'=>'1 Hari','syarat'=>'KTP + KK'],
        ['icon'=>'fa-users','kat'=>'kependudukan','nama'=>'Surat Keterangan Keluarga','desc'=>'Menjelaskan susunan anggota keluarga dalam satu rumah tangga.','waktu'=>'1 Hari','syarat'=>'KTP + KK'],
        ['icon'=>'fa-heart','kat'=>'kependudukan','nama'=>'Surat Keterangan Belum Menikah','desc'=>'Dibutuhkan untuk proses pernikahan di KUA.','waktu'=>'1 Hari','syarat'=>'KTP + KK + Akta Lahir'],
        ['icon'=>'fa-briefcase','kat'=>'usaha','nama'=>'Surat Keterangan Usaha','desc'=>'Untuk mengurus perizinan usaha, BPJS, atau keperluan perbankan.','waktu'=>'1 Hari','syarat'=>'KTP + KK + Foto Usaha'],
        ['icon'=>'fa-hand-holding-heart','kat'=>'sosial','nama'=>'Surat Keterangan Tidak Mampu','desc'=>'Untuk mendapat keringanan biaya pendidikan, kesehatan, dll.','waktu'=>'2 Hari','syarat'=>'KTP + KK + Surat RT/RW'],
        ['icon'=>'fa-file-medical','kat'=>'sosial','nama'=>'Surat Pengantar BPJS','desc'=>'Pengantar pembuatan atau perubahan data BPJS Kesehatan.','waktu'=>'1 Hari','syarat'=>'KTP + KK'],
        ['icon'=>'fa-file-signature','kat'=>'tanah','nama'=>'Surat Keterangan Tanah','desc'=>'Keterangan kepemilikan tanah untuk keperluan jual beli atau warisan.','waktu'=>'3 Hari','syarat'=>'KTP + Bukti Kepemilikan Tanah'],
        ['icon'=>'fa-home','kat'=>'tanah','nama'=>'Surat IMB Desa','desc'=>'Izin mendirikan bangunan di wilayah Desa Kragilan.','waktu'=>'5 Hari','syarat'=>'KTP + KK + Gambar Bangunan'],
        ['icon'=>'fa-graduation-cap','kat'=>'sosial','nama'=>'Surat Keterangan untuk Beasiswa','desc'=>'Pengantar pengajuan beasiswa pendidikan berbagai lembaga.','waktu'=>'1 Hari','syarat'=>'KTP + KK + Surat Keterangan Sekolah'],
      ];
      @endphp

      @foreach($suratList as $surat)
      <div class="surat-card" data-kategori="{{ $surat['kat'] }}">
        <div class="card-icon {{ $surat['kat'] }}">
          <i class="fas {{ $surat['icon'] }}"></i>
        </div>
        <div class="card-body">
          <span class="card-tag {{ $surat['kat'] }}">{{ ucfirst($surat['kat']) }}</span>
          <h3>{{ $surat['nama'] }}</h3>
          <p>{{ $surat['desc'] }}</p>
          <div class="card-info">
            <span><i class="fas fa-clock"></i> {{ $surat['waktu'] }}</span>
            <span><i class="fas fa-file-alt"></i> {{ $surat['syarat'] }}</span>
          </div>
          <a href="{{ route('pengajuan') }}?jenis={{ urlencode($surat['nama']) }}" class="btn-detail">
            <i class="fas fa-paper-plane"></i> Ajukan Online
          </a>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</section>

<script>
function filterSurat(btn, kat) {
  document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.surat-card').forEach(card => {
    card.classList.toggle('hidden', kat !== 'semua' && card.dataset.kategori !== kat);
  });
}
</script>
@endsection
