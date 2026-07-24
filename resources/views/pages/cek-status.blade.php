@extends("layouts.app")
@section("content")

<section class="page-hero">
  <div class="container page-hero-inner">
    <div>
      <div class="page-breadcrumb"><a href="{{ route("home") }}">Beranda</a> <i class="fas fa-chevron-right"></i> Cek Status</div>
      <h2 class="page-title">Cek Status Pengajuan Surat</h2>
      <p class="page-subtitle">Pantau perkembangan surat Anda dengan memasukkan NIK atau kode pengajuan</p>
    </div>
  </div>
</section>

<section class="section bg-light">
  <div class="container" style="max-width:700px;">

    <!-- Search Form -->
    <div class="form-card" style="margin-bottom:32px;">
      <div class="form-card-header">
        <i class="fas fa-search"></i>
        <div>
          <h3>Cari Pengajuan Surat</h3>
          <p>Masukkan NIK (16 digit) atau Kode Pengajuan (contoh: DKG-2025-0001)</p>
        </div>
      </div>
      <form method="GET" action="{{ route("cek-status.search") }}" class="search-form-status">
        <div style="display:flex; gap:12px; flex-wrap:wrap;">
          <input type="text" name="query" value="{{ $query ?? "" }}" placeholder="Masukkan NIK atau Kode Pengajuan..." class="search-input-status" required>
          <button type="submit" class="btn btn-primary" style="white-space:nowrap;">
            <i class="fas fa-search"></i> Cari
          </button>
        </div>
      </form>
    </div>

    <!-- Results -->
    @if(isset($results))
      @if($results && $results->count() > 0)
        <div class="status-results">
          <h4 class="results-title">
            <i class="fas fa-list-check"></i>
            Ditemukan {{ $results->count() }} pengajuan untuk "{{ $query }}"
          </h4>
          @foreach($results as $item)
          <div class="status-card">
            <div class="status-card-header">
              <div>
                <div class="status-kode">{{ $item->kode_pengajuan }}</div>
                <div class="status-nama">{{ $item->nama_lengkap }}</div>
              </div>
              <span class="status-badge status-{{ strtolower(str_replace(" ", "-", $item->status)) }}">
                @if($item->status === "Pending") <i class="fas fa-clock"></i>
                @elseif($item->status === "Proses") <i class="fas fa-spinner"></i>
                @elseif($item->status === "Selesai") <i class="fas fa-check-circle"></i>
                @else <i class="fas fa-times-circle"></i> @endif
                {{ $item->status }}
              </span>
            </div>
            <div class="status-card-body">
              <div class="status-detail-row">
                <span><i class="fas fa-file-alt"></i> <strong>Jenis Surat:</strong> {{ $item->jenis_surat }}</span>
                <span><i class="fas fa-info-circle"></i> <strong>Keperluan:</strong> {{ $item->keperluan }}</span>
              </div>
              <div class="status-detail-row">
                <span><i class="fas fa-calendar-alt"></i> <strong>Tanggal Pengajuan:</strong> {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat("d F Y") }}</span>
                <span><i class="fas fa-phone"></i> <strong>No. HP:</strong> {{ $item->no_hp }}</span>
              </div>
              @if($item->status === "Selesai")
              <div class="status-note success-note">
                <i class="fas fa-check-circle"></i> Surat Anda sudah selesai diproses. Silakan datang ke Balai Desa untuk mengambil surat dengan membawa KTP asli.
              </div>
              @elseif($item->status === "Proses")
              <div class="status-note process-note">
                <i class="fas fa-spinner fa-spin"></i> Pengajuan Anda sedang diproses oleh petugas. Estimasi selesai 1-3 hari kerja.
              </div>
              @elseif($item->status === "Ditolak")
              <div class="status-note reject-note">
                <i class="fas fa-times-circle"></i> Pengajuan ditolak. Hubungi petugas via WhatsApp untuk informasi lebih lanjut.
              </div>
              @else
              <div class="status-note pending-note">
                <i class="fas fa-hourglass-start"></i> Pengajuan Anda sudah diterima dan sedang menunggu giliran diproses petugas.
              </div>
              @endif
            </div>
          </div>
          @endforeach
        </div>
      @else
        <div class="status-empty">
          <i class="fas fa-search"></i>
          <h4>Pengajuan Tidak Ditemukan</h4>
          <p>Tidak ada pengajuan yang cocok dengan "<strong>{{ $query }}</strong>".<br>Pastikan NIK atau kode pengajuan yang Anda masukkan sudah benar.</p>
          <a href="{{ route("pengajuan") }}" class="btn btn-primary" style="margin-top:20px;">
            <i class="fas fa-plus"></i> Buat Pengajuan Baru
          </a>
        </div>
      @endif
    @else
      <!-- Info boxes jika belum search -->
      <div class="info-boxes-grid">
        <div class="info-box">
          <div class="info-box-icon" style="background:#e8f5ee; color:var(--green);">
            <i class="fas fa-id-card"></i>
          </div>
          <h4>Cari via NIK</h4>
          <p>Masukkan 16 digit NIK KTP Anda untuk melihat semua pengajuan surat terkait.</p>
        </div>
        <div class="info-box">
          <div class="info-box-icon" style="background:#fef9ee; color:var(--gold);">
            <i class="fas fa-ticket-alt"></i>
          </div>
          <h4>Cari via Kode</h4>
          <p>Gunakan kode pengajuan yang dikirimkan saat Anda mengisi formulir online (contoh: DKG-2025-0001).</p>
        </div>
        <div class="info-box">
          <div class="info-box-icon" style="background:#eff6ff; color:#2563eb;">
            <i class="fab fa-whatsapp"></i>
          </div>
          <h4>Hubungi Petugas</h4>
          <p>Butuh bantuan? Hubungi kami via WhatsApp di <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteInfo->contact_whatsapp) }}" style="color:var(--green); font-weight:600;">{{ $siteInfo->contact_whatsapp }}</a>.</p>
        </div>
      </div>
    @endif

  </div>
</section>
@endsection
