@extends('layouts.admin')

@section('title', 'Chat Pengajuan')
@section('page-heading', 'Chat Pengajuan')

@section('content')
    <div class="admin-card" style="margin-bottom:24px;">
        <strong>Kode Pengajuan</strong>
        <span>{{ $pengajuan->kode_pengajuan }}</span>
        <div style="margin-top:12px; color:#475569;">
            <strong>Nama:</strong> {{ $pengajuan->nama_lengkap }} &bull;
            <strong>Jenis:</strong> {{ $pengajuan->jenis_surat }} &bull;
            <strong>Status:</strong> {{ $pengajuan->status }}
        </div>
    </div>

    <div class="admin-card" style="padding:0; overflow:hidden; margin-bottom:24px;">
        <div style="padding:22px; border-bottom:1px solid #e2e8f0; background:#f8fafc;"><strong>Riwayat Chat WhatsApp</strong></div>
        <div style="padding:22px; background:#f8fafc; min-height:360px; display:flex; flex-direction:column; gap:16px;">
            @if($pengajuan->chats->isEmpty())
                <div style="color:#64748b;">Belum ada percakapan. Kirim pesan kepada warga untuk memulai chat.</div>
            @endif

            @foreach($pengajuan->chats as $chat)
                <div style="max-width:72%; padding:14px 16px; border-radius:20px; background: {{ $chat->sender === 'admin' ? '#d1fae5' : '#eff6ff' }}; align-self: {{ $chat->sender === 'admin' ? 'flex-end' : 'flex-start' }};">
                    <div style="font-size:.9rem; color:#334155; margin-bottom:4px; font-weight:700;">{{ $chat->sender === 'admin' ? 'Admin' : 'Warga' }}</div>
                    <div style="white-space:pre-line;">{{ $chat->message }}</div>
                    <div style="font-size:.78rem; color:#64748b; margin-top:8px;">{{ $chat->created_at->format('d M Y H:i') }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="admin-card">
        <form method="POST" action="{{ route('admin.chat.store', $pengajuan->id) }}">
            @csrf
            <div style="display:flex; flex-direction:column; gap:14px;">
                <textarea name="message" rows="4" placeholder="Tulis pesan untuk warga..." style="width:100%; padding:14px 16px; border-radius:18px; border:1px solid #cbd5e1; resize:vertical; min-height:130px;">{{ old('message') }}</textarea>
                @error('message')
                    <div style="color:#dc2626;">{{ $message }}</div>
                @enderror
                <div style="display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap;">
                    <a href="{{ route('admin.submissions') }}" class="admin-button" style="background:#e2e8f0; color:#0f172a;">Kembali ke Pengajuan</a>
                    <button type="submit" class="admin-button">Kirim Pesan</button>
                </div>
            </div>
        </form>
    </div>
@endsection