@extends('layouts.admin')

@section('title', 'Pengaturan Situs')
@section('page-heading', 'Pengaturan Situs')
@section('page-subtitle', 'Kelola informasi, kontak, dan struktur organisasi Desa Kragilan.')

@section('content')

@if(session('success'))
  <div class="adm-alert adm-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="adm-alert adm-alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
@endif

<!-- ── TABS ── -->
<div style="display:flex;gap:4px;margin-bottom:24px;background:#f1f5f9;border-radius:14px;padding:6px;" id="settingsTabs">
  <button class="settings-tab active" data-tab="info" onclick="switchTab('info',this)">
    <i class="fas fa-building"></i> Informasi Desa
  </button>
  <button class="settings-tab" data-tab="contact" onclick="switchTab('contact',this)">
    <i class="fas fa-phone-alt"></i> Kontak
  </button>
  <button class="settings-tab" data-tab="org" onclick="switchTab('org',this)">
    <i class="fas fa-sitemap"></i> Struktur Organisasi
  </button>
</div>

<style>
.settings-tab {
  flex:1; display:flex; align-items:center; justify-content:center; gap:7px;
  padding:11px 16px; border-radius:10px; border:none; background:transparent;
  color:#64748b; font-size:13px; font-weight:600; cursor:pointer; font-family:inherit;
  transition:all .2s; white-space:nowrap;
}
.settings-tab.active { background:#fff; color:#166534; box-shadow:0 2px 8px rgba(0,0,0,.08); }
.settings-tab:hover:not(.active) { color:#374151; }
.tab-pane { display:none; }
.tab-pane.active { display:block; }
@media (max-width: 768px) {
  #settingsTabs { flex-direction: column; }
}
</style>

<form id="settingsForm" method="POST" action="{{ route('admin.site.settings.update') }}" onsubmit="return handleSettingsSubmit(event)">
@csrf

<!-- ══ TAB: INFO ══ -->
<div class="tab-pane active" id="tab-info">
  <div class="adm-card" style="margin-bottom:20px;">
    <div class="adm-card-header">
      <div class="adm-card-title"><i class="fas fa-id-card" style="color:#16a34a;margin-right:6px;"></i> Identitas Desa</div>
    </div>
    <div class="adm-card-body">
      <div class="frm-grid frm-grid-2">
        <div class="frm-group">
          <label class="frm-label">Nama Desa <span class="frm-required">*</span></label>
          <input type="text" name="profile_title" class="frm-input"
            value="{{ old('profile_title', $siteInfo->profile_title) }}"
            placeholder="Contoh: Desa Kragilan" required>
        </div>
        <div class="frm-group">
          <label class="frm-label">Subjudul / Tagline</label>
          <input type="text" name="profile_subtitle" class="frm-input"
            value="{{ old('profile_subtitle', $siteInfo->profile_subtitle) }}"
            placeholder="Contoh: Kecamatan Kragilan • Kabupaten Serang">
        </div>
        <div class="frm-group" style="grid-column:1/-1;">
          <label class="frm-label">Visi Desa</label>
          <textarea name="vision" class="frm-textarea" rows="3"
            placeholder="Tuliskan visi desa...">{{ old('vision', $siteInfo->vision) }}</textarea>
        </div>
        <div class="frm-group" style="grid-column:1/-1;">
          <label class="frm-label">Misi Desa</label>
          <p class="frm-hint" style="margin-bottom:6px;">Pisahkan tiap poin misi dengan baris baru (Enter).</p>
          <textarea name="mission" class="frm-textarea" rows="5"
            placeholder="Tulis tiap misi pada baris terpisah...">{{ old('mission', $siteInfo->mission) }}</textarea>
        </div>
        <div class="frm-group" style="grid-column:1/-1;">
          <label class="frm-label">Subjudul Halaman Pelayanan</label>
          <input type="text" name="service_page_subtitle" class="frm-input"
            value="{{ old('service_page_subtitle', $siteInfo->service_page_subtitle) }}"
            placeholder="Contoh: Temukan jenis surat yang Anda butuhkan">
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══ TAB: CONTACT ══ -->
<div class="tab-pane" id="tab-contact">
  <div class="adm-card" style="margin-bottom:20px;">
    <div class="adm-card-header">
      <div class="adm-card-title"><i class="fas fa-phone-alt" style="color:#16a34a;margin-right:6px;"></i> Informasi Kontak</div>
    </div>
    <div class="adm-card-body">
      <div class="frm-grid frm-grid-2">
        <div class="frm-group" style="grid-column:1/-1;">
          <label class="frm-label">Alamat Kantor Desa</label>
          <textarea name="contact_address" class="frm-textarea" rows="2"
            placeholder="Jl. Raya Kragilan No. 01, ...">{{ old('contact_address', $siteInfo->contact_address) }}</textarea>
        </div>
        <div class="frm-group">
          <label class="frm-label"><i class="fas fa-phone" style="color:#6b7280;"></i> Nomor Telepon</label>
          <input type="text" name="contact_phone" class="frm-input"
            value="{{ old('contact_phone', $siteInfo->contact_phone) }}"
            placeholder="(0254) 123-4567">
        </div>
        <div class="frm-group">
          <label class="frm-label"><i class="fab fa-whatsapp" style="color:#16a34a;"></i> Nomor WhatsApp</label>
          <input type="text" name="contact_whatsapp" class="frm-input"
            value="{{ old('contact_whatsapp', $siteInfo->contact_whatsapp) }}"
            placeholder="0821-1234-5678">
        </div>
        <div class="frm-group">
          <label class="frm-label"><i class="fas fa-envelope" style="color:#3b82f6;"></i> Alamat Email</label>
          <input type="email" name="contact_email" class="frm-input"
            value="{{ old('contact_email', $siteInfo->contact_email) }}"
            placeholder="desa@kragilan.go.id">
        </div>
        <div class="frm-group">
          <label class="frm-label"><i class="fas fa-clock" style="color:#f59e0b;"></i> Jam Pelayanan</label>
          <p class="frm-hint" style="margin-bottom:6px;">Pisahkan hari dengan baris baru.</p>
          <textarea name="service_hours" class="frm-textarea" rows="3"
            placeholder="Senin – Kamis: 08.00 – 14.00 WIB&#10;Jumat: 08.00 – 11.00 WIB&#10;Sabtu – Minggu: Tutup">{{ old('service_hours', $siteInfo->service_hours) }}</textarea>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══ TAB: ORG ══ -->
<div class="tab-pane" id="tab-org">
  <div class="adm-card" style="margin-bottom:20px;">
    <div class="adm-card-header">
      <div class="adm-card-title"><i class="fas fa-users" style="color:#16a34a;margin-right:6px;"></i> Struktur Organisasi</div>
    </div>
    <div class="adm-table-wrap">
      <table class="adm-table">
        <thead>
          <tr>
            <th style="width:36px;">#</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Kategori</th>
            <th>Urutan</th>
            <th style="width:120px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($orgMembers as $member)
          <tr>
            @if(!empty($member->id))
            <form method="POST" action="{{ route('admin.org.update', $member->id) }}">
              @csrf
              <td style="color:#94a3b8;font-size:12px;">{{ $loop->iteration }}</td>
              <td><input type="text" name="name" value="{{ old('name', $member->name) }}" class="frm-input" style="padding:7px 10px;font-size:13px;min-width:150px;"></td>
              <td><input type="text" name="position" value="{{ old('position', $member->position) }}" class="frm-input" style="padding:7px 10px;font-size:13px;min-width:150px;"></td>
              <td>
                <select name="category" class="frm-select" style="padding:7px 32px 7px 10px;font-size:13px;min-width:130px;">
                  @foreach(['kepala'=>'Kepala Desa','bpd'=>'BPD','sekretaris'=>'Sekretaris','kaur'=>'Kaur','kasi'=>'Kasi','kampung'=>'RT / RW'] as $v=>$l)
                  <option value="{{ $v }}" {{ $member->category===$v?'selected':'' }}>{{ $l }}</option>
                  @endforeach
                </select>
                <!-- hidden fields not shown in org tab -->
                <input type="hidden" name="icon" value="{{ $member->icon }}">
              </td>
              <td><input type="number" name="sort_order" value="{{ old('sort_order',$member->sort_order) }}" min="0" class="frm-input" style="padding:7px 10px;font-size:13px;width:70px;"></td>
              <td>
                <div style="display:flex;gap:5px;">
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i></button>
            </form>
            <form method="POST" action="{{ route('admin.org.delete', $member->id) }}" onsubmit="return confirm('Hapus {{ addslashes($member->name) }}?')">
              @csrf
              <button type="submit" class="btn btn-sm btn-danger btn-icon"><i class="fas fa-trash"></i></button>
            </form>
                </div>
              </td>
            @else
            <td colspan="6" style="text-align:center;color:#94a3b8;padding:20px;">Data tidak valid.</td>
            @endif
          </tr>
          @empty
          <tr>
            <td colspan="6" style="text-align:center;color:#94a3b8;padding:32px;">
              Belum ada anggota. Tambahkan di bawah.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Tambah Anggota -->
  <div class="adm-card" style="margin-bottom:20px;">
    <div class="adm-card-header">
      <div class="adm-card-title"><i class="fas fa-user-plus" style="color:#16a34a;margin-right:6px;"></i> Tambah Anggota Organisasi</div>
    </div>
    <div class="adm-card-body">
      <form id="addOrgForm" method="POST" action="{{ route('admin.org.store') }}">
        @csrf
        <div class="frm-grid frm-grid-3" style="margin-bottom:16px;">
          <div class="frm-group">
            <label class="frm-label">Nama Lengkap <span class="frm-required">*</span></label>
            <input type="text" name="name" class="frm-input" placeholder="Nama anggota" required>
          </div>
          <div class="frm-group">
            <label class="frm-label">Jabatan <span class="frm-required">*</span></label>
            <input type="text" name="position" class="frm-input" placeholder="Contoh: Kepala Desa" required>
          </div>
          <div class="frm-group">
            <label class="frm-label">Kategori <span class="frm-required">*</span></label>
            <select name="category" class="frm-select" required>
              <option value="">-- Pilih --</option>
              <option value="kepala">Kepala Desa</option>
              <option value="bpd">BPD</option>
              <option value="sekretaris">Sekretaris</option>
              <option value="kaur">Kaur</option>
              <option value="kasi">Kasi</option>
              <option value="kampung">RT / RW</option>
            </select>
          </div>
          <div class="frm-group">
            <label class="frm-label">Icon FontAwesome</label>
            <input type="text" name="icon" class="frm-input" placeholder="fa-user-tie">
            <span class="frm-hint">Nama icon dari fontawesome.com</span>
          </div>
          <div class="frm-group">
            <label class="frm-label">Urutan</label>
            <input type="number" name="sort_order" value="0" min="0" class="frm-input">
          </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Anggota</button>
      </form>
    </div>
  </div>
</div>

<!-- ── SAVE BUTTON (for info & contact tabs) ── -->
<div id="saveBar" style="position:sticky;bottom:0;z-index:50;background:rgba(241,245,249,.95);backdrop-filter:blur(8px);border-top:1px solid #e2e8f0;padding:14px 0;margin-top:4px;">
  <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
    <span style="font-size:13px;color:#64748b;"><i class="fas fa-info-circle"></i> Klik Simpan untuk menyimpan perubahan informasi dan kontak.</span>
    <div style="display:flex;gap:10px;">
      <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
      <button type="button" onclick="handleSettingsSubmit()" class="btn btn-primary" style="padding:11px 24px;"><i class="fas fa-save"></i> Simpan Pengaturan</button>
    </div>
  </div>
</div>

</form>

{{-- Modal Konfirmasi Simpan --}}
<div id="confirmModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(15,23,42,0.6);z-index:99999;align-items:center;justify-content:center;">
  <div style="background:#fff;border-radius:20px;padding:36px 32px 28px;max-width:420px;width:90%;text-align:center;box-shadow:0 24px 64px rgba(0,0,0,0.25);">
    <div style="font-size:48px;margin-bottom:16px;">💾</div>
    <h3 style="margin:0 0 10px;color:#1e293b;font-size:18px;font-weight:700;">Simpan Perubahan?</h3>
    <p style="color:#64748b;margin:0 0 28px;font-size:14px;line-height:1.6;">Apakah Anda yakin ingin menyimpan perubahan pengaturan situs ini?</p>
    <div style="display:flex;gap:12px;">
      <button onclick="closeConfirm()" style="flex:1;padding:12px;border:2px solid #e2e8f0;border-radius:10px;background:#fff;color:#64748b;font-size:14px;font-weight:600;cursor:pointer;font-family:inherit;">
        ✕ Tidak
      </button>
      <button onclick="doConfirmYes()" style="flex:1;padding:12px;border:none;border-radius:10px;background:#16a34a;color:#fff;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;">
        ✓ Ya, Simpan
      </button>
    </div>
  </div>
</div>

<script>
var _formToSubmit = null;

function handleSettingsSubmit() {
  _formToSubmit = document.getElementById('settingsForm');
  document.getElementById('confirmModal').style.display = 'flex';
}

function doConfirmYes() {
  document.getElementById('confirmModal').style.display = 'none';
  if (_formToSubmit) _formToSubmit.submit();
}

function closeConfirm() {
  document.getElementById('confirmModal').style.display = 'none';
  _formToSubmit = null;
}

function switchTab(tab, el) {
  document.querySelectorAll('.settings-tab').forEach(function(b) { b.classList.remove('active'); });
  document.querySelectorAll('.tab-pane').forEach(function(p) { p.classList.remove('active'); });
  el.classList.add('active');
  document.getElementById('tab-' + tab).classList.add('active');
  document.getElementById('saveBar').style.display = (tab === 'org') ? 'none' : 'block';
}

document.getElementById('saveBar').style.display = 'block';
</script>
@endsection
