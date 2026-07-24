@extends('layouts.admin')

@section('title', 'Testimoni Warga')
@section('page-heading', 'Moderasi Testimoni')

@section('content')
    @if(session('success'))
        <div class="admin-alert">{{ session('success') }}</div>
    @endif

    <div class="admin-card" style="padding:0; overflow:hidden;">
        @if($testimonis->isEmpty())
            <div style="padding:24px;">Belum ada testimoni masuk.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Wilayah</th>
                        <th>Testimoni</th>
                        <th>Bintang</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonis as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->wilayah }}</td>
                        <td>{{ mb_strimwidth($item->isi, 0, 80, '...') }}</td>
                        <td>{{ $item->bintang }}/5</td>
                        <td>{{ $item->disetujui ? 'Ditampilkan' : 'Menunggu' }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.testimoni.toggle', $item->id) }}">
                                @csrf
                                <button type="submit" class="admin-button" style="padding:8px 12px;">{{ $item->disetujui ? 'Sembunyikan' : 'Setujui' }}</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
