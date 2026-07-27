@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-heading', 'Dashboard')
@section('page-subtitle', 'Selamat datang kembali! Berikut ringkasan data terkini.')

@section('content')

@if(session('success'))
  <div class="adm-alert adm-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

<!-- ── STAT CARDS ── -->
<div class="adm-stats">
  <div class="adm-stat green">
    <div class="adm-stat-icon"><i class="fas fa-file-alt"></i></div>
    <div>
      <div class="adm-stat-num">{{ $stats['total_pengajuan'] }}</div>
      <div class="adm-stat-label">Total Pengajuan</div>
    </div>
  </div>
  <div class="adm-stat yellow">
    <div class="adm-stat-icon"><i class="fas fa-clock"></i></div>
    <div>
      <div class="adm-stat-num">{{ $stats['pending'] }}</div>
      <div class="adm-stat-label">Menunggu Proses</div>
    </div>
  </div>
  <div class="adm-stat blue">
    <div class="adm-stat-icon"><i class="fas fa-spinner"></i></div>
    <div>
      <div class="adm-stat-num">{{ $stats['proses'] }}</div>
      <div class="adm-stat-label">Sedang Diproses</div>
    </div>
  </div>
  <div class="adm-stat green">
    <div class="adm-stat-icon"><i class="fas fa-check-double"></i></div>
    <div>
      <div class="adm-stat-num">{{ $stats['selesai'] }}</div>
      <div class="adm-stat-label">Selesai</div>
    </div>
  </div>
  <div class="adm-stat orange">
    <div class="adm-stat-icon"><i class="fas fa-store"></i></div>
    <div>
      <div class="adm-stat-num">{{ \App\Models\Umkm::where('aktif',true)->count() }}</div>
      <div class="adm-stat-label">UMKM Aktif</div>
    </div>
  </div>
  <div class="adm-stat purple">
    <div class="adm-stat-icon"><i class="fas fa-comments"></i></div>
    <div>
      <div class="adm-stat-num">{{ $stats['unread_chat'] }}</div>
      <div class="adm-stat-label">Chat Belum Dibaca</div>
    </div>
  </div>
</div>

<!-- ── QUICK ACTIONS ── -->
<div class="adm-card" style="margin-bottom:24px;">
  <div class="adm-card-header">
    <div class="adm-card-title"><i class="fas fa-bolt" style="color:#f59e0b;margin-right:6px;"></i> Menu Cepat</div>
  </div>
  <div class="adm-card-body">
    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(180px,1fr)); gap:14px;">
      <a href="{{ route('admin.submissions') }}" style="display:flex;flex-direction:column;align-items:center;gap:10px;padding:20px 16px;border-radius:14px;border:1.5px solid #dcfce7;background:#f0fdf4;text-decoration:none;transition:all .2s;text-align:center;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 20px rgba(22,163,74,.15)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
        <div style="width:48px;height:48px;background:#dcfce7;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:20px;color:#16a34a;"><i class="fas fa-file-alt"></i></div>
        <div style="font-weight:700;color:#166534;font-size:13px;">Pengajuan Surat</div>
        @if($stats['pending'] > 0)
        <span style="background:#ef4444;color:#fff;font-size:11px;font-weight:700;padding:2px 10px;border-radius:100px;">{{ $stats['pending'] }} Pending</span>
        @endif
      </a>
      <a href="{{ route('admin.umkm.index') }}" style="display:flex;flex-direction:column;align-items:center;gap:10px;padding:20px 16px;border-radius:14px;border:1.5px solid #fed7aa;background:#fff7ed;text-decoration:none;transition:all .2s;text-align:center;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 20px rgba(234,88,12,.15)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
        <div style="width:48px;height:48px;background:#ffedd5;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:20px;color:#ea580c;"><i class="fas fa-store"></i></div>
        <div style="font-weight:700;color:#7c2d12;font-size:13px;">Manajemen UMKM</div>
        <span style="background:#fed7aa;color:#9a3412;font-size:11px;font-weight:700;padding:2px 10px;border-radius:100px;">{{ \App\Models\Umkm::count() }} Usaha</span>
      </a>
      <a href="{{ route('admin.testimonials') }}" style="display:flex;flex-direction:column;align-items:center;gap:10px;padding:20px 16px;border-radius:14px;border:1.5px solid #ddd6fe;background:#f5f3ff;text-decoration:none;transition:all .2s;text-align:center;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 20px rgba(147,51,234,.15)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
        <div style="width:48px;height:48px;background:#ede9fe;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:20px;color:#7c3aed;"><i class="fas fa-star"></i></div>
        <div style="font-weight:700;color:#4c1d95;font-size:13px;">Testimoni Warga</div>
        @if($stats['testimoni_pending'] > 0)
        <span style="background:#ef4444;color:#fff;font-size:11px;font-weight:700;padding:2px 10px;border-radius:100px;">{{ $stats['testimoni_pending'] }} Pending</span>
        @endif
      </a>
      <a href="{{ route('admin.site.settings') }}" style="display:flex;flex-direction:column;align-items:center;gap:10px;padding:20px 16px;border-radius:14px;border:1.5px solid #bfdbfe;background:#eff6ff;text-decoration:none;transition:all .2s;text-align:center;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 20px rgba(59,130,246,.15)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
        <div style="width:48px;height:48px;background:#dbeafe;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:20px;color:#2563eb;"><i class="fas fa-cog"></i></div>
        <div style="font-weight:700;color:#1e3a8a;font-size:13px;">Pengaturan Situs</div>
      </a>
    </div>
  </div>
</div>

<!-- ── TWO COLUMNS ── -->
<div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">

  <!-- Pengajuan Terbaru -->
  <div class="adm-card">
    <div class="adm-card-header">
      <div class="adm-card-title"><i class="fas fa-file-alt" style="color:#16a34a;margin-right:6px;"></i> Pengajuan Terbaru</div>
      <a href="{{ route('admin.submissions') }}" class="btn btn-sm btn-secondary">Lihat Semua</a>
    </div>
    <div class="adm-table-wrap">
      <table class="adm-table">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Jenis Surat</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($pengajuans as $item)
          <tr>
            <td>
              <div style="font-weight:600;color:#1e293b;font-size:13px;">{{ $item->nama_lengkap }}</div>
              <div style="font-size:11px;color:#94a3b8;">{{ $item->kode_pengajuan }}</div>
            </td>
            <td style="font-size:12.5px;color:#475569;">{{ Str::limit($item->jenis_surat, 28) }}</td>
            <td>
              @php
                $sc = ['Pending'=>'badge-yellow','Proses'=>'badge-blue','Selesai'=>'badge-green','Ditolak'=>'badge-red'];
              @endphp
              <span class="badge {{ $sc[$item->status] ?? 'badge-gray' }}">{{ $item->status }}</span>
            </td>
          </tr>
          @empty
          <tr><td colspan="3" style="text-align:center;color:#94a3b8;padding:24px;">Belum ada pengajuan.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Testimoni Terbaru -->
  <div class="adm-card">
    <div class="adm-card-header">
      <div class="adm-card-title"><i class="fas fa-star" style="color:#f59e0b;margin-right:6px;"></i> Testimoni Terbaru</div>
      <a href="{{ route('admin.testimonials') }}" class="btn btn-sm btn-secondary">Lihat Semua</a>
    </div>
    <div style="padding:0;">
      @forelse($testimonis as $item)
      <div style="padding:16px 20px; border-bottom:1px solid #f1f5f9; display:flex; align-items:flex-start; gap:12px;">
        <div style="width:36px;height:36px;background:linear-gradient(135deg,#22c55e,#3b82f6);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;color:#fff;flex-shrink:0;">
          {{ strtoupper(substr($item->nama,0,1)) }}
        </div>
        <div style="flex:1;min-width:0;">
          <div style="font-weight:600;font-size:13px;color:#1e293b;">{{ $item->nama }}</div>
          <div style="font-size:12px;color:#94a3b8;margin-bottom:4px;">{{ $item->wilayah }}</div>
          <div style="font-size:12.5px;color:#475569;line-height:1.5;">{{ Str::limit($item->isi, 70) }}</div>
        </div>
        <span class="badge {{ $item->disetujui ? 'badge-green' : 'badge-yellow' }}" style="flex-shrink:0;font-size:10px;">
          {{ $item->disetujui ? 'Aktif' : 'Pending' }}
        </span>
      </div>
      @empty
      <div class="adm-empty" style="padding:40px 20px;">
        <div class="adm-empty-icon"><i class="fas fa-comments"></i></div>
        <p>Belum ada testimoni.</p>
      </div>
      @endforelse
    </div>
  </div>
</div>

@push('scripts')
<script>
// Auto-refresh badge counts every 60s
setInterval(() => {}, 60000);
</script>
@endpush
@endsection
