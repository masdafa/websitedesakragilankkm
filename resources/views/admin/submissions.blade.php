@extends('layouts.admin')

@section('title', 'Pengajuan Surat')
@section('page-heading', 'Pengajuan Surat')
@section('page-subtitle', 'Kelola semua pengajuan surat dari warga Desa Kragilan.')

@section('content')

@if(session('success'))
  <div class="adm-alert adm-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

<!-- Stats Row -->
<div class="adm-stats" style="grid-template-columns:repeat(auto-fill, minmax(160px,1fr)); margin-bottom:24px;">
  @foreach([
    ['label'=>'Total', 'val'=>$pengajuans->count(), 'color'=>'blue', 'icon'=>'fa-list'],
    ['label'=>'Pending', 'val'=>$pengajuans->where('status','Pending')->count(), 'color'=>'yellow', 'icon'=>'fa-clock'],
    ['label'=>'Diproses', 'val'=>$pengajuans->where('status','Proses')->count(), 'color'=>'blue', 'icon'=>'fa-spinner'],
    ['label'=>'Selesai', 'val'=>$pengajuans->where('status','Selesai')->count(), 'color'=>'green', 'icon'=>'fa-check-double'],
    ['label'=>'Ditolak', 'val'=>$pengajuans->where('status','Ditolak')->count(), 'color'=>'red', 'icon'=>'fa-times-circle'],
  ] as $s)
  <div class="adm-stat {{ $s['color'] }}">
    <div class="adm-stat-icon"><i class="fas {{ $s['icon'] }}"></i></div>
    <div>
      <div class="adm-stat-num">{{ $s['val'] }}</div>
      <div class="adm-stat-label">{{ $s['label'] }}</div>
    </div>
  </div>
  @endforeach
</div>

<div class="adm-card">
  <div class="adm-card-header">
    <div class="adm-card-title"><i class="fas fa-file-alt" style="color:#16a34a;margin-right:6px;"></i> Daftar Pengajuan Warga</div>
  </div>

  @if($pengajuans->isEmpty())
    <div class="adm-empty">
      <div class="adm-empty-icon"><i class="fas fa-file-alt"></i></div>
      <h3>Belum ada pengajuan</h3>
      <p>Pengajuan dari warga akan muncul di sini.</p>
    </div>
  @else
  <div class="adm-table-wrap">
    <table class="adm-table">
      <thead>
        <tr>
          <th>Kode / Pemohon</th>
          <th>Jenis Surat</th>
          <th>No. HP</th>
          <th>Waktu</th>
          <th>Chat</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pengajuans as $item)
        <tr>
          <td>
            <div style="font-weight:700;color:#1e293b;font-size:13px;">{{ $item->nama_lengkap }}</div>
            <div style="font-size:11px;color:#94a3b8;margin-top:2px;font-family:monospace;">{{ $item->kode_pengajuan }}</div>
          </td>
          <td>
            <span style="font-size:12.5px;color:#374151;">{{ Str::limit($item->jenis_surat, 35) }}</span>
          </td>
          <td>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/','', $item->no_hp) }}" target="_blank"
               style="color:#16a34a;text-decoration:none;font-size:12.5px;display:flex;align-items:center;gap:4px;">
              <i class="fab fa-whatsapp" style="font-size:13px;"></i> {{ $item->no_hp }}
            </a>
          </td>
          <td style="font-size:12px;color:#94a3b8;white-space:nowrap;">
            {{ $item->created_at->format('d M Y') }}<br>
            <span style="font-size:11px;">{{ $item->created_at->format('H:i') }}</span>
          </td>
          <td>
            @if($item->latestChat)
              <div style="max-width:160px;">
                <div style="font-size:12px;color:#374151;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ Str::limit($item->latestChat->message, 35) }}</div>
                @if($item->unreadChats->count() > 0)
                  <span class="badge badge-red" style="margin-top:4px;font-size:10px;">{{ $item->unreadChats->count() }} baru</span>
                @endif
              </div>
            @else
              <span style="color:#cbd5e1;font-size:12px;">—</span>
            @endif
          </td>
          <td>
            @php $sc = ['Pending'=>'badge-yellow','Proses'=>'badge-blue','Selesai'=>'badge-green','Ditolak'=>'badge-red']; @endphp
            <span class="badge {{ $sc[$item->status] ?? 'badge-gray' }}">{{ $item->status }}</span>
          </td>
          <td>
            <div style="display:flex;gap:6px;align-items:center;flex-wrap:wrap;">
              <!-- Update status form -->
              <form method="POST" action="{{ route('admin.pengajuan.status', $item->id) }}" style="display:flex;gap:5px;align-items:center;">
                @csrf
                <select name="status" class="frm-select" style="padding:6px 10px;font-size:12px;border-radius:8px;width:auto;border:1.5px solid #e2e8f0;">
                  <option value="Pending"  {{ $item->status==='Pending'  ? 'selected':'' }}>Pending</option>
                  <option value="Proses"   {{ $item->status==='Proses'   ? 'selected':'' }}>Proses</option>
                  <option value="Selesai"  {{ $item->status==='Selesai'  ? 'selected':'' }}>Selesai</option>
                  <option value="Ditolak"  {{ $item->status==='Ditolak'  ? 'selected':'' }}>Ditolak</option>
                </select>
                <button type="submit" class="btn btn-sm btn-primary" style="padding:6px 10px;">
                  <i class="fas fa-save"></i>
                </button>
              </form>
              <a href="{{ route('admin.chat.show', $item->id) }}" class="btn btn-sm btn-info" style="padding:6px 10px;">
                <i class="fas fa-comments"></i>
              </a>
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
