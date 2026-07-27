@extends('layouts.admin')

@section('title', 'Manajemen UMKM')
@section('page-heading', 'UMKM Desa')
@section('page-subtitle', 'Kelola data usaha mikro, kecil, dan menengah warga Desa Kragilan.')

@section('content')

@if(session('success'))
  <div class="adm-alert adm-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="adm-alert adm-alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
@endif

<!-- STATS -->
<div class="adm-stats" style="grid-template-columns:repeat(auto-fill, minmax(150px,1fr)); margin-bottom:24px;">
  <div class="adm-stat green">
    <div class="adm-stat-icon"><i class="fas fa-store"></i></div>
    <div>
      <div class="adm-stat-num">{{ $umkms->count() }}</div>
      <div class="adm-stat-label">Total UMKM</div>
    </div>
  </div>
  <div class="adm-stat blue">
    <div class="adm-stat-icon"><i class="fas fa-check-circle"></i></div>
    <div>
      <div class="adm-stat-num">{{ $umkms->where('aktif',true)->count() }}</div>
      <div class="adm-stat-label">Aktif Tampil</div>
    </div>
  </div>
  <div class="adm-stat yellow">
    <div class="adm-stat-icon"><i class="fas fa-pause-circle"></i></div>
    <div>
      <div class="adm-stat-num">{{ $umkms->where('aktif',false)->count() }}</div>
      <div class="adm-stat-label">Nonaktif</div>
    </div>
  </div>
  @foreach($kategoriList as $key => $kat)
  @php $cnt = $umkms->where('kategori',$key)->count(); @endphp
  @if($cnt > 0)
  <div class="adm-stat" style="border-left:4px solid {{ $kat['color'] }};">
    <div class="adm-stat-icon" style="background:{{ $kat['color'] }}20;color:{{ $kat['color'] }};"><i class="fas {{ $kat['icon'] }}"></i></div>
    <div>
      <div class="adm-stat-num">{{ $cnt }}</div>
      <div class="adm-stat-label">{{ $kat['label'] }}</div>
    </div>
  </div>
  @endif
  @endforeach
</div>

<!-- HEADER ACTIONS -->
<div class="adm-card">
  <div class="adm-card-header">
    <div class="adm-card-title"><i class="fas fa-store" style="color:#ea580c;margin-right:6px;"></i> Daftar UMKM</div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
      <a href="{{ route('umkm') }}" target="_blank" class="btn btn-info">
        <i class="fas fa-eye"></i> Lihat Publik
      </a>
      <a href="{{ route('admin.umkm.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah UMKM
      </a>
    </div>
  </div>

  @if($umkms->isEmpty())
    <div class="adm-empty">
      <div class="adm-empty-icon" style="background:#fff7ed;color:#ea580c;"><i class="fas fa-store-slash"></i></div>
      <h3>Belum ada data UMKM</h3>
      <p>Mulai tambahkan usaha warga untuk ditampilkan di halaman publik.</p>
      <a href="{{ route('admin.umkm.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah UMKM Pertama</a>
    </div>
  @else
  <div class="adm-table-wrap">
    <table class="adm-table">
      <thead>
        <tr>
          <th style="width:36px;">#</th>
          <th>Nama Usaha</th>
          <th>Pemilik</th>
          <th>Kategori</th>
          <th>Kontak</th>
          <th>Produk Unggulan</th>
          <th style="text-align:center;">Status</th>
          <th style="text-align:center; white-space:nowrap;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($umkms as $umkm)
        @php $kat = $kategoriList[$umkm->kategori] ?? ['label'=>$umkm->kategori,'icon'=>'fa-store','color'=>'#6b7280']; @endphp
        <tr>
          <td style="color:#94a3b8;font-size:12px;">{{ $loop->iteration }}</td>
          <td>
            <div style="font-weight:700;color:#1e293b;font-size:13.5px;">{{ $umkm->nama_usaha }}</div>
            @if($umkm->alamat)
            <div style="font-size:11.5px;color:#94a3b8;margin-top:2px;display:flex;align-items:center;gap:3px;">
              <i class="fas fa-map-marker-alt" style="font-size:9px;"></i> {{ Str::limit($umkm->alamat, 40) }}
            </div>
            @endif
          </td>
          <td>
            <div style="font-size:13px;color:#374151;font-weight:500;">{{ $umkm->pemilik }}</div>
          </td>
          <td>
            <span style="display:inline-flex;align-items:center;gap:5px;padding:4px 11px;border-radius:100px;font-size:11.5px;font-weight:700;background:{{ $kat['color'] }}1a;color:{{ $kat['color'] }};border:1px solid {{ $kat['color'] }}33;">
              <i class="fas {{ $kat['icon'] }}" style="font-size:10px;"></i> {{ $kat['label'] }}
            </span>
          </td>
          <td>
            @if($umkm->no_hp)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/','', $umkm->no_hp) }}" target="_blank"
               style="display:inline-flex;align-items:center;gap:5px;color:#16a34a;text-decoration:none;font-size:12.5px;font-weight:500;">
              <i class="fab fa-whatsapp"></i> {{ $umkm->no_hp }}
            </a>
            @else
            <span style="color:#cbd5e1;font-size:12px;">—</span>
            @endif
            @if($umkm->instagram)
            <div style="font-size:11.5px;color:#a21caf;margin-top:3px;"><i class="fab fa-instagram"></i> {{ $umkm->instagram }}</div>
            @endif
          </td>
          <td>
            @if($umkm->produk_unggulan)
            <div style="font-size:12.5px;color:#374151;display:flex;align-items:center;gap:4px;">
              <i class="fas fa-star" style="color:#f59e0b;font-size:10px;"></i>
              {{ Str::limit($umkm->produk_unggulan, 35) }}
            </div>
            @else
            <span style="color:#cbd5e1;font-size:12px;">—</span>
            @endif
          </td>
          <td style="text-align:center;">
            <form method="POST" action="{{ route('admin.umkm.toggle', $umkm->id) }}" style="display:inline;">
              @csrf
              <button type="submit" title="{{ $umkm->aktif ? 'Klik untuk nonaktifkan' : 'Klik untuk aktifkan' }}"
                style="border:none;cursor:pointer;display:inline-flex;align-items:center;gap:5px;padding:5px 12px;border-radius:100px;font-size:11.5px;font-weight:700;transition:all .2s;font-family:inherit;
                {{ $umkm->aktif ? 'background:#dcfce7;color:#15803d;' : 'background:#f1f5f9;color:#64748b;' }}">
                <i class="fas {{ $umkm->aktif ? 'fa-eye' : 'fa-eye-slash' }}" style="font-size:10px;"></i>
                {{ $umkm->aktif ? 'Aktif' : 'Nonaktif' }}
              </button>
            </form>
          </td>
          <td style="text-align:center;">
            <div style="display:flex;gap:5px;justify-content:center;">
              <a href="{{ route('admin.umkm.edit', $umkm->id) }}" class="btn btn-sm btn-info" title="Edit">
                <i class="fas fa-edit"></i>
              </a>
              <form method="POST" action="{{ route('admin.umkm.destroy', $umkm->id) }}"
                    onsubmit="return confirm('Hapus UMKM {{ addslashes($umkm->nama_usaha) }}? Tindakan ini tidak dapat dibatalkan.')">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger btn-icon" title="Hapus">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif
</div>

@endsection
