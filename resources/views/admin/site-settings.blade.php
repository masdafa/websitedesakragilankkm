@extends('layouts.admin')

@section('page-heading', 'Pengaturan Situs')

@section('content')
<div class="admin-card">
    @if(session('success'))
        <div class="admin-alert">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="admin-alert" style="background:#fee2e2; color:#991b1b; border-color:#fca5a5;">{{ session('error') }}</div>
    @endif
    <h2 style="margin-top:0;">Informasi Desa</h2>
    <form method="POST" action="{{ route('admin.site.settings.update') }}">
        @csrf
        <div style="display:grid; gap:18px;">
            <div>
                <label>Judul Profil</label>
                <input type="text" name="profile_title" value="{{ old('profile_title', $siteInfo->profile_title) }}" style="width:100%; padding:12px; margin-top:6px;" required>
            </div>
            <div>
                <label>Subjudul Profil</label>
                <textarea name="profile_subtitle" rows="3" style="width:100%; padding:12px; margin-top:6px;">{{ old('profile_subtitle', $siteInfo->profile_subtitle) }}</textarea>
            </div>
            <div>
                <label>Visi</label>
                <textarea name="vision" rows="3" style="width:100%; padding:12px; margin-top:6px;">{{ old('vision', $siteInfo->vision) }}</textarea>
            </div>
            <div>
                <label>Misi (pisahkan baris dengan enter)</label>
                <textarea name="mission" rows="5" style="width:100%; padding:12px; margin-top:6px;">{{ old('mission', $siteInfo->mission) }}</textarea>
            </div>
            <div>
                <label>Subjudul Halaman Pelayanan</label>
                <textarea name="service_page_subtitle" rows="2" style="width:100%; padding:12px; margin-top:6px;">{{ old('service_page_subtitle', $siteInfo->service_page_subtitle) }}</textarea>
            </div>
            <div>
                <label>Alamat Kontak</label>
                <textarea name="contact_address" rows="3" style="width:100%; padding:12px; margin-top:6px;">{{ old('contact_address', $siteInfo->contact_address) }}</textarea>
            </div>
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:18px;">
                <div>
                    <label>Telepon</label>
                    <input type="text" name="contact_phone" value="{{ old('contact_phone', $siteInfo->contact_phone) }}" style="width:100%; padding:12px; margin-top:6px;">
                </div>
                <div>
                    <label>WhatsApp</label>
                    <input type="text" name="contact_whatsapp" value="{{ old('contact_whatsapp', $siteInfo->contact_whatsapp) }}" style="width:100%; padding:12px; margin-top:6px;">
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', $siteInfo->contact_email) }}" style="width:100%; padding:12px; margin-top:6px;">
                </div>
            </div>
            <div>
                <label>Jam Pelayanan (gunakan enter untuk baris baru)</label>
                <textarea name="service_hours" rows="3" style="width:100%; padding:12px; margin-top:6px;">{{ old('service_hours', $siteInfo->service_hours) }}</textarea>
            </div>
        </div>
        <button type="submit" class="admin-button" style="margin-top:18px;">Simpan Pengaturan</button>
    </form>
</div>

<div class="admin-card" style="margin-top:24px;">
    <h2>Struktur Organisasi</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Kategori</th>
                <th>Icon</th>
                <th>Urutan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orgMembers as $member)
            <tr>
                @if(!empty($member->id))
                    <form method="POST" action="{{ route('admin.org.update', $member->id) }}">
                        @csrf
                        <td>{{ $loop->iteration }}</td>
                        <td><input type="text" name="name" value="{{ old('name', $member->name) }}" style="width:100%; padding:8px;"></td>
                        <td><input type="text" name="position" value="{{ old('position', $member->position) }}" style="width:100%; padding:8px;"></td>
                        <td>
                            <select name="category" style="width:100%; padding:8px;">
                                <option value="kepala" {{ $member->category === 'kepala' ? 'selected' : '' }}>Kepala Desa</option>
                                <option value="bpd" {{ $member->category === 'bpd' ? 'selected' : '' }}>BPD</option>
                                <option value="sekretaris" {{ $member->category === 'sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                                <option value="kaur" {{ $member->category === 'kaur' ? 'selected' : '' }}>Kaur</option>
                                <option value="kasi" {{ $member->category === 'kasi' ? 'selected' : '' }}>Kasi</option>
                                <option value="kampung" {{ $member->category === 'kampung' ? 'selected' : '' }}>Kampung / RT / RW</option>
                            </select>
                        </td>
                        <td><input type="text" name="icon" value="{{ old('icon', $member->icon) }}" style="width:100%; padding:8px;"></td>
                        <td><input type="number" name="sort_order" value="{{ old('sort_order', $member->sort_order) }}" min="0" style="width:100%; padding:8px;"></td>
                        <td style="display:flex; gap:8px; flex-wrap:wrap;">
                            <button type="submit" class="admin-button" style="padding:8px 12px;">Update</button>
                    </form>
                    <form method="POST" action="{{ route('admin.org.delete', $member->id) }}">
                        @csrf
                        <button type="submit" class="admin-button" style="background:#dc2626;">Hapus</button>
                    </form>
                        </td>
                @else
                    <td colspan="7" style="text-align:center; padding:20px;">Anggota organisasi tidak valid untuk diedit. Pastikan tabel org_members dan datanya sudah ada.</td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; padding:20px;">Belum ada anggota organisasi. Tambahkan anggota menggunakan form di bawah.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:24px;">
        <h3>Tambah Anggota Organisasi</h3>
        <form method="POST" action="{{ route('admin.org.store') }}" style="display:grid; gap:18px;">
            @csrf
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:18px;">
                <div>
                    <label>Nama</label>
                    <input type="text" name="name" style="width:100%; padding:12px;" required>
                </div>
                <div>
                    <label>Jabatan</label>
                    <input type="text" name="position" style="width:100%; padding:12px;" required>
                </div>
                <div>
                    <label>Kategori</label>
                    <select name="category" style="width:100%; padding:12px;" required>
                        <option value="kepala">Kepala Desa</option>
                        <option value="bpd">BPD</option>
                        <option value="sekretaris">Sekretaris</option>
                        <option value="kaur">Kaur</option>
                        <option value="kasi">Kasi</option>
                        <option value="kampung">Kampung / RT / RW</option>
                    </select>
                </div>
                <div>
                    <label>Icon FontAwesome</label>
                    <input type="text" name="icon" style="width:100%; padding:12px;" placeholder="fa-user-tie">
                </div>
                <div>
                    <label>Urutan</label>
                    <input type="number" name="sort_order" value="0" min="0" style="width:100%; padding:12px;">
                </div>
            </div>
            <button type="submit" class="admin-button">Tambah Anggota</button>
        </form>
    </div>
</div>
@endsection
