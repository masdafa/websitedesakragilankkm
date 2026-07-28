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
          <th>NIK</th>
          <th>Alamat</th>
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
            <span style="font-size:12px;color:#374151;font-family:monospace;letter-spacing:.5px;">{{ $item->nik ?? '-' }}</span>
          </td>
          <td>
            <span style="font-size:12px;color:#374151;max-width:160px;display:inline-block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $item->alamat }}">{{ Str::limit($item->alamat ?? '-', 30) }}</span>
          </td>
          <td>
            <a href="whatsapp://send?phone={{ preg_replace('/[^0-9]/','', $item->no_hp) }}"
               onclick="bukaWA(event, '{{ preg_replace('/[^0-9]/','', $item->no_hp) }}', '')"
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
          <td style="white-space:nowrap;">
            <form method="POST" action="{{ route('admin.pengajuan.status', $item->id) }}">
              @csrf
              <div style="display:flex;flex-direction:column;gap:6px;min-width:140px;">
                {{-- Dropdown Status --}}
                <select name="status" style="
                  width:100%; padding:6px 10px; font-size:12px;
                  border-radius:8px; border:1.5px solid #e2e8f0;
                  background:#f8fafc; color:#374151; cursor:pointer;
                  font-family:inherit; outline:none;
                ">
                  <option value="Pending"  {{ $item->status==='Pending'  ? 'selected':'' }}>⏳ Pending</option>
                  <option value="Proses"   {{ $item->status==='Proses'   ? 'selected':'' }}>🔄 Proses</option>
                  <option value="Selesai"  {{ $item->status==='Selesai'  ? 'selected':'' }}>✅ Selesai</option>
                  <option value="Ditolak"  {{ $item->status==='Ditolak'  ? 'selected':'' }}>❌ Ditolak</option>
                </select>
                {{-- Tombol aksi --}}
                <div style="display:flex;gap:6px;">
                  <button type="submit" title="Simpan Status" style="
                    flex:1; padding:6px 0; border-radius:8px;
                    border:none; background:#16a34a; color:#fff;
                    font-size:12px; font-weight:600; cursor:pointer;
                    display:flex; align-items:center; justify-content:center; gap:4px;
                  ">
                    <i class="fas fa-save"></i> Simpan
                  </button>
                  <a href="{{ route('admin.chat.show', $item->id) }}" title="Chat" style="
                    flex:1; padding:6px 0; border-radius:8px;
                    background:#3b82f6; color:#fff;
                    font-size:12px; font-weight:600; cursor:pointer;
                    display:flex; align-items:center; justify-content:center; gap:4px;
                    text-decoration:none;
                  ">
                    <i class="fas fa-comments"></i> Chat
                    @if($item->unreadChats->count() > 0)
                      <span style="background:#ef4444;border-radius:99px;padding:1px 5px;font-size:10px;">{{ $item->unreadChats->count() }}</span>
                    @endif
                  </a>
                </div>
              </div>
            </form>
          </td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif
</div>

{{-- Toast notifikasi data baru --}}
<div id="newDataToast" style="
  display:none; position:fixed; bottom:24px; right:24px; z-index:9999;
  background:#1e293b; color:#fff; border-radius:14px;
  padding:14px 20px; font-size:13px; font-weight:600;
  box-shadow:0 8px 32px rgba(0,0,0,0.25);
  align-items:center; gap:12px;
  animation:slideIn .3s ease;
">
  <span style="font-size:20px;">🔔</span>
  <span id="toastMsg">Ada pengajuan baru masuk!</span>
  <button onclick="location.reload()" style="
    margin-left:8px; padding:6px 14px; border-radius:8px;
    border:none; background:#16a34a; color:#fff;
    font-size:12px; font-weight:700; cursor:pointer;
  ">Lihat</button>
  <button onclick="document.getElementById('newDataToast').style.display='none'" style="
    padding:4px 8px; border-radius:6px; border:none;
    background:rgba(255,255,255,.15); color:#fff; cursor:pointer; font-size:12px;
  ">✕</button>
</div>

<style>
  .slide-in { animation: slideIn .3s ease; }
  @-webkit-keyframes slideIn { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
  @keyframes slideIn { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
</style>

<script>
// ─── Auto-refresh: polling setiap 15 detik ───────────────────────────────────
var _lastCount = {{ $pengajuans->count() }};
var _polling   = true;

function pollNewData() {
  if (!_polling) return;
  fetch('{{ route('admin.submissions') }}?count_only=1', {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(function(r) { return r.json(); })
  .catch(function() { return null; })
  .then(function(data) {
    if (!data) return;
    var newCount = data.count || 0;
    if (newCount > _lastCount) {
      var diff = newCount - _lastCount;
      document.getElementById('toastMsg').textContent =
        diff + ' pengajuan baru masuk!';
      var toast = document.getElementById('newDataToast');
      toast.style.display = 'flex';
      _lastCount = newCount;
      // Juga update badge sidebar
      document.querySelectorAll('.adm-nav-badge').forEach(function(b) {
        if (b.closest('a') && b.closest('a').href.includes('pengajuan')) {
          b.textContent = data.pending || '';
        }
      });
    }
  });
}

// Polling setiap 15 detik
setInterval(pollNewData, 15000);

// \u2500\u2500\u2500 Buka WhatsApp app langsung (bukan WhatsApp Web) \u2500\u2500\u2500
function bukaWA(e, phone, text) {
  e.preventDefault();
  var appUrl = 'whatsapp://send?phone=' + phone + (text ? '&text=' + encodeURIComponent(text) : '');
  var webUrl = 'https://api.whatsapp.com/send?phone=' + phone + (text ? '&text=' + encodeURIComponent(text) : '');

  // Coba buka aplikasi WhatsApp desktop
  var iframe = document.createElement('iframe');
  iframe.style.display = 'none';
  document.body.appendChild(iframe);

  var timer = setTimeout(function() {
    // Aplikasi tidak terbuka \u2014 buka WhatsApp Web sebagai fallback
    window.open(webUrl, '_blank');
  }, 800);

  // Kalau browser sudah handle deep link, batalkan fallback
  window.addEventListener('blur', function onBlur() {
    clearTimeout(timer);
    document.body.removeChild(iframe);
    window.removeEventListener('blur', onBlur);
  }, { once: true });

  iframe.src = appUrl;
}
</script>
@endsection
