@extends('layouts.admin')

@section('title', 'Testimoni Warga')
@section('page-heading', 'Testimoni Warga')
@section('page-subtitle', 'Moderasi dan kelola ulasan dari warga desa.')

@section('content')

@if(session('success'))
  <div class="adm-alert adm-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

<!-- Stats -->
<div class="adm-stats" style="grid-template-columns:repeat(auto-fill,minmax(160px,1fr));margin-bottom:24px;">
  <div class="adm-stat green">
    <div class="adm-stat-icon"><i class="fas fa-check-circle"></i></div>
    <div>
      <div class="adm-stat-num">{{ $testimonis->where('disetujui',true)->count() }}</div>
      <div class="adm-stat-label">Ditampilkan</div>
    </div>
  </div>
  <div class="adm-stat yellow">
    <div class="adm-stat-icon"><i class="fas fa-clock"></i></div>
    <div>
      <div class="adm-stat-num">{{ $testimonis->where('disetujui',false)->count() }}</div>
      <div class="adm-stat-label">Menunggu</div>
    </div>
  </div>
  <div class="adm-stat blue">
    <div class="adm-stat-icon"><i class="fas fa-comments"></i></div>
    <div>
      <div class="adm-stat-num">{{ $testimonis->count() }}</div>
      <div class="adm-stat-label">Total</div>
    </div>
  </div>
  <div class="adm-stat purple">
    <div class="adm-stat-icon"><i class="fas fa-star"></i></div>
    <div>
      <div class="adm-stat-num">{{ $testimonis->count() > 0 ? number_format($testimonis->avg('bintang'),1) : '—' }}</div>
      <div class="adm-stat-label">Rata-rata Bintang</div>
    </div>
  </div>
</div>

<div class="adm-card">
  <div class="adm-card-header">
    <div class="adm-card-title"><i class="fas fa-star" style="color:#f59e0b;margin-right:6px;"></i> Daftar Testimoni</div>
  </div>

  @if($testimonis->isEmpty())
    <div class="adm-empty">
      <div class="adm-empty-icon"><i class="fas fa-comments"></i></div>
      <h3>Belum ada testimoni</h3>
      <p>Testimoni dari warga akan muncul di sini.</p>
    </div>
  @else
  <div style="display:grid; gap:0;">
    @foreach($testimonis as $item)
    <div style="padding:20px 24px; border-bottom:1px solid #f1f5f9; display:flex; align-items:flex-start; gap:16px; transition:background .15s;" onmouseover="this.style.background='#fafbfc'" onmouseout="this.style.background=''">
      <!-- Avatar -->
      <div style="width:44px;height:44px;border-radius:13px;background:linear-gradient(135deg,{{ $item->disetujui ? '#22c55e,#16a34a' : '#94a3b8,#64748b' }});display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:800;color:#fff;flex-shrink:0;">
        {{ strtoupper(substr($item->nama ?? '?',0,1)) }}
      </div>

      <!-- Content -->
      <div style="flex:1;min-width:0;">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;flex-wrap:wrap;">
          <span style="font-weight:700;font-size:14px;color:#1e293b;">{{ $item->nama }}</span>
          <span style="font-size:12px;color:#94a3b8;"><i class="fas fa-map-marker-alt" style="font-size:10px;"></i> {{ $item->wilayah }}</span>
          <!-- Stars -->
          <span style="color:#f59e0b;font-size:11px;">
            @for($i=1; $i<=5; $i++)
              <i class="fas {{ $i <= $item->bintang ? 'fa-star' : 'fa-star' }}" style="opacity:{{ $i <= $item->bintang ? 1 : .25 }};"></i>
            @endfor
          </span>
        </div>
        <p style="font-size:13px;color:#475569;line-height:1.6;margin:0;">{{ $item->isi }}</p>
        <div style="margin-top:8px;font-size:11px;color:#cbd5e1;">{{ $item->created_at->format('d M Y, H:i') }}</div>
      </div>

      <!-- Actions -->
      <div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;flex-shrink:0;">
        <span class="badge {{ $item->disetujui ? 'badge-green' : 'badge-yellow' }}">
          {{ $item->disetujui ? 'Ditampilkan' : 'Menunggu' }}
        </span>
        <form method="POST" action="{{ route('admin.testimoni.toggle', $item->id) }}">
          @csrf
          <button type="submit" class="btn btn-sm {{ $item->disetujui ? 'btn-warning' : 'btn-primary' }}">
            <i class="fas {{ $item->disetujui ? 'fa-eye-slash' : 'fa-check' }}"></i>
            {{ $item->disetujui ? 'Sembunyikan' : 'Setujui' }}
          </button>
        </form>
      </div>
    </div>
    @endforeach
  </div>
  @endif
</div>
@endsection
