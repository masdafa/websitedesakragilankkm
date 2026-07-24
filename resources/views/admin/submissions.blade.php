@extends('layouts.admin')

@section('title', 'Pengajuan Surat')
@section('page-heading', 'Daftar Pengajuan Warga')

@section('content')
    @if(session('success'))
        <div class="admin-alert">{{ session('success') }}</div>
    @endif

    <div class="admin-card" style="padding:0; overflow:hidden;">
        @if($pengajuans->isEmpty())
            <div style="padding:24px;">Tidak ada data pengajuan.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Jenis Surat</th>
                        <th>No. HP</th>
                        <th>Status</th>
                        <th>Chat Terakhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajuans as $item)
                    <tr>
                        <td>{{ $item->kode_pengajuan }}</td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>{{ $item->jenis_surat }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td><span style="padding:6px 10px; border-radius:999px; background:#fef3c7; color:#92400e;">{{ $item->status }}</span></td>
                        <td>
                            @if($item->latestChat)
                                <div style="display:flex; gap:8px; align-items:center;">
                                    <span>{{ Str::limit($item->latestChat->message, 40) }}</span>
                                    @if($item->unreadChats->count() > 0)
                                        <span style="padding:4px 8px; background:#f87171; color:#ffffff; border-radius:999px; font-size:0.8rem;">{{ $item->unreadChats->count() }}</span>
                                    @endif
                                </div>
                            @else
                                <span style="color:#64748b;">Belum ada chat</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; gap:8px; flex-wrap:wrap; align-items:center;">
                                <form method="POST" action="{{ route('admin.pengajuan.status', $item->id) }}" style="display:flex; gap:8px; flex-wrap:wrap; margin:0;">
                                    @csrf
                                    <select name="status" style="padding:8px 10px; border-radius:10px; border:1px solid #cbd5e1;">
                                        <option value="Pending" {{ $item->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Proses" {{ $item->status === 'Proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="Selesai" {{ $item->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="Ditolak" {{ $item->status === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <button type="submit" class="admin-button" style="padding:8px 12px;">Update</button>
                                </form>
                                <a href="{{ route('admin.chat.show', $item->id) }}" class="admin-button" style="padding:8px 12px; background:#d1fae5; color:#0f5132;">Chat</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
