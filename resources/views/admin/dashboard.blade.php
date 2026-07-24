@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-heading', 'Dashboard Desa Kragilan')

@section('content')
    <div class="admin-card-grid" style="margin-bottom:24px;">
        <div class="admin-card">
            <strong>Total Pengajuan</strong>
            <span>{{ $stats['total_pengajuan'] }} data</span>
        </div>
        <div class="admin-card">
            <strong>Menunggu</strong>
            <span>{{ $stats['pending'] }} pengajuan</span>
        </div>
        <div class="admin-card">
            <strong>Diproses</strong>
            <span>{{ $stats['proses'] }} pengajuan</span>
        </div>
        <div class="admin-card">
            <strong>Selesai</strong>
            <span>{{ $stats['selesai'] }} pengajuan</span>
        </div>
        <div class="admin-card">
            <strong>Unread Chat</strong>
            <span>{{ $stats['unread_chat'] }} pesan</span>
        </div>
    </div>

    <div class="admin-card" style="margin-bottom:24px;">
        <h3 style="margin-top:0;">Menu Utama</h3>
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px,1fr)); gap:16px; margin-top:16px;">
            <a href="{{ route('admin.submissions') }}" class="admin-button" style="justify-content:flex-start; background:#e2f7ef; color:#0f5132;">
                <span class="icon"><i class="fas fa-file-alt"></i></span>
                Pengajuan Surat
            </a>
            <a href="{{ route('admin.testimonials') }}" class="admin-button" style="justify-content:flex-start; background:#eef2ff; color:#3730a3;">
                <span class="icon"><i class="fas fa-comments"></i></span>
                Testimoni Warga
            </a>
        </div>
    </div>

    <div class="admin-card" style="padding:0; overflow:hidden;">
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Jenis Surat</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengajuans as $item)
                <tr>
                    <td>{{ $item->kode_pengajuan }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->jenis_surat }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Tidak ada pengajuan saat ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
