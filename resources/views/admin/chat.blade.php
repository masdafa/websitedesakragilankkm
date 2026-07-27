@extends('layouts.admin')

@section('title', 'Chat Pengajuan')
@section('page-heading', 'Chat Pengajuan')
@section('page-subtitle', 'Percakapan dengan warga terkait pengajuan surat.')

@section('content')

<!-- Info Pengajuan -->
<div class="adm-card" style="margin-bottom:20px;">
  <div class="adm-card-body" style="padding:18px 24px;">
    <div style="display:flex;align-items:center;gap:20px;flex-wrap:wrap;">
      <div style="width:48px;height:48px;background:linear-gradient(135deg,#22c55e,#16a34a);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:18px;color:#fff;flex-shrink:0;">
        <i class="fas fa-file-alt"></i>
      </div>
      <div style="flex:1;min-width:0;">
        <div style="font-size:11.5px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Kode Pengajuan</div>
        <div style="font-weight:800;font-size:15px;color:#1e293b;font-family:monospace;">{{ $pengajuan->kode_pengajuan }}</div>
        <div style="font-size:13px;color:#475569;margin-top:4px;">
          <strong>{{ $pengajuan->nama_lengkap }}</strong>
          &nbsp;·&nbsp; {{ $pengajuan->jenis_surat }}
          &nbsp;·&nbsp;
          @php $sc = ['Pending'=>'badge-yellow','Proses'=>'badge-blue','Selesai'=>'badge-green','Ditolak'=>'badge-red']; @endphp
          <span class="badge {{ $sc[$pengajuan->status] ?? 'badge-gray' }}">{{ $pengajuan->status }}</span>
        </div>
      </div>
      <a href="{{ route('admin.submissions') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>
    </div>
  </div>
</div>

<!-- Chat Window -->
<div class="adm-card" style="margin-bottom:20px;">
  <div class="adm-card-header">
    <div class="adm-card-title"><i class="fas fa-comments" style="color:#16a34a;margin-right:6px;"></i> Riwayat Percakapan</div>
    <span style="font-size:12px;color:#94a3b8;">{{ $pengajuan->chats->count() }} pesan</span>
  </div>
  <div style="padding:20px;background:#f8fafc;min-height:320px;max-height:520px;overflow-y:auto;display:flex;flex-direction:column;gap:14px;" id="chatWindow">
    @if($pengajuan->chats->isEmpty())
    <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:200px;color:#94a3b8;gap:12px;">
      <div style="width:56px;height:56px;background:#e2e8f0;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:22px;">
        <i class="fas fa-comments"></i>
      </div>
      <p style="font-size:13px;">Belum ada percakapan. Kirim pesan pertama kepada warga.</p>
    </div>
    @endif

    @foreach($pengajuan->chats as $chat)
    @php $isAdmin = $chat->sender === 'admin'; @endphp
    <div style="display:flex;flex-direction:column;align-items:{{ $isAdmin ? 'flex-end' : 'flex-start' }};">
      <!-- Sender name -->
      <div style="font-size:11px;font-weight:700;color:#94a3b8;margin-bottom:4px;padding:0 4px;display:flex;align-items:center;gap:5px;">
        @if($isAdmin)
          Admin Desa <i class="fas fa-shield-alt" style="font-size:9px;color:#16a34a;"></i>
        @else
          <i class="fas fa-user" style="font-size:9px;"></i> Warga
        @endif
      </div>
      <!-- Bubble -->
      <div style="max-width:72%;padding:12px 16px;border-radius:{{ $isAdmin ? '18px 18px 4px 18px' : '18px 18px 18px 4px' }};
        background:{{ $isAdmin ? 'linear-gradient(135deg,#dcfce7,#bbf7d0)' : '#fff' }};
        border:1px solid {{ $isAdmin ? '#86efac' : '#e2e8f0' }};
        box-shadow:0 2px 8px rgba(0,0,0,.06);">
        <div style="font-size:13.5px;color:#1e293b;white-space:pre-line;line-height:1.6;">{{ $chat->message }}</div>
        <div style="font-size:11px;color:#94a3b8;margin-top:8px;text-align:{{ $isAdmin ? 'right' : 'left' }};">
          <i class="fas fa-clock" style="font-size:9px;"></i> {{ $chat->created_at->format('d M Y, H:i') }}
          @if($isAdmin && $chat->read_by_admin)
          &nbsp;<i class="fas fa-check-double" style="color:#16a34a;font-size:9px;" title="Terkirim"></i>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<!-- Reply Form -->
<div class="adm-card">
  <div class="adm-card-header">
    <div class="adm-card-title"><i class="fas fa-reply" style="color:#16a34a;margin-right:6px;"></i> Kirim Pesan ke Warga</div>
  </div>
  <div class="adm-card-body">
    <form method="POST" action="{{ route('admin.chat.store', $pengajuan->id) }}">
      @csrf
      <div class="frm-group" style="margin-bottom:16px;">
        <textarea name="message" class="frm-textarea" rows="4"
          placeholder="Tulis pesan untuk warga...&#10;Contoh: Dokumen Anda sudah kami terima dan sedang diproses. Mohon tunggu 1-2 hari kerja.">{{ old('message') }}</textarea>
        @error('message')
          <span style="font-size:12px;color:#dc2626;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Quick Reply Templates -->
      <div style="margin-bottom:16px;">
        <div style="font-size:12px;font-weight:600;color:#64748b;margin-bottom:8px;text-transform:uppercase;letter-spacing:.05em;">
          <i class="fas fa-bolt" style="color:#f59e0b;"></i> Balasan Cepat:
        </div>
        <div style="display:flex;flex-wrap:wrap;gap:6px;">
          @foreach([
            'Dokumen Anda sedang kami proses. Mohon tunggu 1-2 hari kerja.',
            'Pengajuan Anda telah selesai. Silakan datang ke kantor desa untuk mengambil surat.',
            'Mohon lengkapi dokumen persyaratan terlebih dahulu.',
            'Terima kasih sudah menghubungi kami. Ada yang bisa kami bantu?',
          ] as $tmpl)
          <button type="button" onclick="setTemplate(this)"
            data-msg="{{ $tmpl }}"
            style="padding:6px 12px;border-radius:8px;border:1.5px solid #e2e8f0;background:#f8fafc;color:#374151;font-size:12px;font-weight:500;cursor:pointer;font-family:inherit;transition:all .2s;text-align:left;"
            onmouseover="this.style.borderColor='#16a34a';this.style.color='#16a34a';this.style.background='#f0fdf4';"
            onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#374151';this.style.background='#f8fafc';">
            {{ Str::limit($tmpl, 40) }}
          </button>
          @endforeach
        </div>
      </div>

      <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <button type="submit" class="btn btn-primary" style="padding:11px 24px;">
          <i class="fas fa-paper-plane"></i> Kirim Pesan
        </button>
        <a href="{{ route('admin.submissions') }}" class="btn btn-secondary">
          <i class="fas fa-arrow-left"></i> Kembali
        </a>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
// Scroll to bottom of chat
const chatWin = document.getElementById('chatWindow');
chatWin.scrollTop = chatWin.scrollHeight;

function setTemplate(btn) {
  document.querySelector('textarea[name="message"]').value = btn.dataset.msg;
}
</script>
@endpush
@endsection