@extends('layouts.admin')

@section('title', isset($umkm) ? 'Edit UMKM' : 'Tambah UMKM Baru')
@section('page-heading', isset($umkm) ? 'Edit UMKM' : 'Tambah UMKM Baru')
@section('page-subtitle', isset($umkm) ? 'Perbarui informasi usaha: '.$umkm->nama_usaha : 'Daftarkan usaha baru warga Desa Kragilan.')

@section('content')

@if ($errors->any())
  <div class="adm-alert adm-alert-error" style="margin-bottom:20px;">
    <i class="fas fa-exclamation-circle" style="flex-shrink:0;"></i>
    <div>
      <strong>Ada {{ $errors->count() }} kesalahan:</strong>
      <ul style="margin:6px 0 0;padding-left:20px;">
        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
      </ul>
    </div>
  </div>
@endif

<form method="POST" action="{{ isset($umkm) ? route('admin.umkm.update', $umkm->id) : route('admin.umkm.store') }}" id="umkmForm" enctype="multipart/form-data">
@csrf

<style>
  .umkm-form-layout { display: grid; grid-template-columns: 1fr 320px; gap: 24px; align-items: start; }
  @media (max-width: 992px) {
    .umkm-form-layout { grid-template-columns: 1fr; }
  }
</style>

<div class="umkm-form-layout">

  <!-- ── LEFT COLUMN ── -->
  <div style="display:flex; flex-direction:column; gap:20px;">

    <!-- Identitas Usaha -->
    <div class="adm-card">
      <div class="adm-card-header">
        <div class="adm-card-title"><i class="fas fa-store" style="color:#ea580c;margin-right:6px;"></i> Identitas Usaha</div>
      </div>
      <div class="adm-card-body">
        <div class="frm-grid frm-grid-2">
          <div class="frm-group" style="grid-column:1/-1;">
            <label class="frm-label">Nama Usaha <span class="frm-required">*</span></label>
            <input type="text" name="nama_usaha" id="namaUsaha" class="frm-input"
              value="{{ old('nama_usaha', $umkm->nama_usaha ?? '') }}"
              placeholder="Contoh: Warung Makan Bu Sari" required
              oninput="updatePreview()">
          </div>
          <div class="frm-group">
            <label class="frm-label">Nama Pemilik <span class="frm-required">*</span></label>
            <input type="text" name="pemilik" id="pemilikUsaha" class="frm-input"
              value="{{ old('pemilik', $umkm->pemilik ?? '') }}"
              placeholder="Nama lengkap pemilik" required
              oninput="updatePreview()">
          </div>
          <div class="frm-group">
            <label class="frm-label">Kategori Usaha <span class="frm-required">*</span></label>
            <select name="kategori" id="kategoriUsaha" class="frm-select" required onchange="updatePreview()">
              <option value="">-- Pilih Kategori --</option>
              @foreach($kategoriList as $key => $kat)
              <option value="{{ $key }}" {{ old('kategori', $umkm->kategori ?? '') === $key ? 'selected' : '' }}>
                {{ $kat['label'] }}
              </option>
              @endforeach
            </select>
          </div>
          <div class="frm-group">
            <label class="frm-label">Produk / Jasa Unggulan</label>
            <input type="text" name="produk_unggulan" id="produkUnggulan" class="frm-input"
              value="{{ old('produk_unggulan', $umkm->produk_unggulan ?? '') }}"
              placeholder="Contoh: Nasi Goreng, Batik Tulis"
              oninput="updatePreview()">
            <span class="frm-hint">Pisahkan dengan koma jika lebih dari satu.</span>
          </div>
          <div class="frm-group" style="grid-column:1/-1;">
            <label class="frm-label">Deskripsi Usaha</label>
            <textarea name="deskripsi" id="deskripsiUsaha" class="frm-textarea" rows="4"
              placeholder="Ceritakan secara singkat tentang usaha ini, produk/jasa yang ditawarkan, keunggulan, dll."
              oninput="updatePreview()">{{ old('deskripsi', $umkm->deskripsi ?? '') }}</textarea>
          </div>
        </div>
      </div>
    </div>

    <!-- Foto & Gambar -->
    <div class="adm-card">
      <div class="adm-card-header">
        <div class="adm-card-title"><i class="fas fa-image" style="color:#8b5cf6;margin-right:6px;"></i> Foto & Gambar</div>
      </div>
      <div class="adm-card-body">
        <div class="frm-grid frm-grid-2">
          <div class="frm-group" style="grid-column:1/-1;">
            <label class="frm-label">Gambar Utama</label>
            @if(isset($umkm) && $umkm->gambar_utama)
              <div style="margin-bottom:10px;">
                <img src="{{ $umkm->gambar_utama_url }}" alt="Gambar Utama" style="width:120px;height:120px;object-fit:cover;border-radius:10px;border:1px solid #e2e8f0;">
              </div>
            @endif
            <input type="file" name="gambar_utama" class="frm-input" accept="image/jpeg,image/png,image/webp">
            <span class="frm-hint">Rasio disarankan 1:1 (persegi). Maksimal 2MB. Format: JPG, PNG, WEBP.</span>
          </div>
          <div class="frm-group" style="grid-column:1/-1;">
            <label class="frm-label">Gambar Produk Tambahan</label>
            @if(isset($umkm) && !empty($umkm->gambar_produk))
              <div style="display:flex;gap:10px;margin-bottom:10px;flex-wrap:wrap;">
                @foreach($umkm->gambar_produk_urls as $url)
                  <img src="{{ $url }}" alt="Gambar Produk" style="width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;">
                @endforeach
              </div>
            @endif
            <input type="file" name="gambar_produk[]" class="frm-input" accept="image/jpeg,image/png,image/webp" multiple>
            <span class="frm-hint">Bisa memilih lebih dari 1 file. Maksimal 2MB per file. (Mengunggah gambar baru akan mengganti gambar produk yang lama).</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Lokasi & Jam -->
    <div class="adm-card">
      <div class="adm-card-header">
        <div class="adm-card-title"><i class="fas fa-map-marker-alt" style="color:#ef4444;margin-right:6px;"></i> Lokasi & Jam Buka</div>
      </div>
      <div class="adm-card-body">
        <div class="frm-grid frm-grid-2">
          <div class="frm-group" style="grid-column:1/-1;">
            <label class="frm-label">Alamat Usaha</label>
            <textarea name="alamat" id="alamatUsaha" class="frm-textarea" rows="2"
              placeholder="Contoh: RT 03/RW 01, Kampung Kragilan, Desa Kragilan"
              oninput="updatePreview()">{{ old('alamat', $umkm->alamat ?? '') }}</textarea>
          </div>
          <div class="frm-group">
            <label class="frm-label">Jam Buka</label>
            <input type="text" name="jam_buka" id="jamBuka" class="frm-input"
              value="{{ old('jam_buka', $umkm->jam_buka ?? '') }}"
              placeholder="Contoh: Senin–Sabtu 08.00–17.00"
              oninput="updatePreview()">
          </div>
          <div class="frm-group">
            <label class="frm-label">Urutan Tampil</label>
            <input type="number" name="sort_order" class="frm-input" min="0"
              value="{{ old('sort_order', $umkm->sort_order ?? 0) }}">
            <span class="frm-hint">Angka lebih kecil = tampil lebih dulu.</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Kontak & Sosmed -->
    <div class="adm-card">
      <div class="adm-card-header">
        <div class="adm-card-title"><i class="fas fa-share-alt" style="color:#3b82f6;margin-right:6px;"></i> Kontak & Media Sosial</div>
      </div>
      <div class="adm-card-body">
        <div class="frm-grid frm-grid-2">
          <div class="frm-group">
            <label class="frm-label"><i class="fab fa-whatsapp" style="color:#16a34a;"></i> WhatsApp / No. HP</label>
            <input type="text" name="no_hp" id="noHp" class="frm-input"
              value="{{ old('no_hp', $umkm->no_hp ?? '') }}"
              placeholder="0812-xxxx-xxxx"
              oninput="updatePreview()">
            <span class="frm-hint">Digunakan untuk tombol "Chat via WhatsApp".</span>
          </div>
          <div class="frm-group">
            <label class="frm-label"><i class="fab fa-instagram" style="color:#a21caf;"></i> Instagram</label>
            <div style="position:relative;">
              <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:15px;">@</span>
              <input type="text" name="instagram" id="igUsaha" class="frm-input" style="padding-left:30px;"
                value="{{ old('instagram', ltrim($umkm->instagram ?? '', '@')) }}"
                placeholder="username_instagram"
                oninput="updatePreview()">
            </div>
          </div>
          <div class="frm-group">
            <label class="frm-label"><i class="fab fa-facebook-f" style="color:#1d4ed8;"></i> Facebook</label>
            <input type="text" name="facebook" class="frm-input"
              value="{{ old('facebook', $umkm->facebook ?? '') }}"
              placeholder="nama.halaman.facebook">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ── RIGHT COLUMN: Preview + Status ── -->
  <div style="display:flex; flex-direction:column; gap:20px; position:sticky; top:88px;">

    <!-- Status Card -->
    <div class="adm-card">
      <div class="adm-card-header">
        <div class="adm-card-title"><i class="fas fa-toggle-on" style="color:#16a34a;margin-right:6px;"></i> Status Publikasi</div>
      </div>
      <div class="adm-card-body">
        <div style="padding:16px;background:#f8fafc;border-radius:10px;border:1px solid #e2e8f0;margin-bottom:16px;">
          <div class="frm-toggle-wrap">
            <label class="frm-toggle">
              <input type="checkbox" name="aktif" id="aktifToggle" value="1"
                {{ old('aktif', isset($umkm) ? $umkm->aktif : true) ? 'checked' : '' }}>
              <span class="frm-toggle-slider"></span>
            </label>
            <div>
              <div style="font-weight:600;color:#1e293b;font-size:14px;" id="toggleLabel">
                {{ old('aktif', isset($umkm) ? $umkm->aktif : true) ? 'Ditampilkan ke Publik' : 'Disembunyikan' }}
              </div>
              <div style="font-size:12px;color:#94a3b8;margin-top:2px;">
                Nonaktifkan untuk menyembunyikan sementara.
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:13px;">
          <i class="fas fa-save"></i>
          {{ isset($umkm) ? 'Simpan Perubahan' : 'Tambah UMKM' }}
        </button>
        <a href="{{ route('admin.umkm.index') }}" class="btn btn-secondary" style="width:100%;justify-content:center;margin-top:10px;">
          <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
        @isset($umkm)
        <div style="margin-top:12px;padding-top:12px;border-top:1px solid #f1f5f9;">
          <form method="POST" action="{{ route('admin.umkm.destroy', $umkm->id) }}"
                onsubmit="return confirm('Hapus UMKM ini secara permanen?')">
            @csrf
            <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center;">
              <i class="fas fa-trash-alt"></i> Hapus UMKM Ini
            </button>
          </form>
        </div>
        @endisset
      </div>
    </div>

    <!-- Preview Card -->
    <div class="adm-card">
      <div class="adm-card-header">
        <div class="adm-card-title"><i class="fas fa-eye" style="color:#6b7280;margin-right:6px;"></i> Pratinjau Kartu</div>
      </div>
      <div class="adm-card-body" style="padding:16px;">
        <div id="previewCard" style="border-radius:16px;overflow:hidden;border:1px solid #e2e8f0;box-shadow:0 4px 12px rgba(0,0,0,.06);">
          <div id="previewBar" style="height:5px;background:#e2e8f0;"></div>
          <div style="padding:16px;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
              <span id="previewBadge" style="display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:100px;font-size:11.5px;font-weight:700;background:#f1f5f9;color:#94a3b8;border:1px solid #e2e8f0;">
                <i class="fas fa-store" style="font-size:10px;"></i> <span id="previewKat">Kategori</span>
              </span>
            </div>
            <div id="previewAvatar" style="width:52px;height:52px;border-radius:14px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:22px;color:#94a3b8;margin:0 auto 10px;">
              <i class="fas fa-store"></i>
            </div>
            <div id="previewNama" style="text-align:center;font-weight:700;color:#1e293b;font-size:14px;margin-bottom:3px;">Nama Usaha</div>
            <div id="previewPemilik" style="text-align:center;font-size:12px;color:#94a3b8;margin-bottom:10px;"><i class="fas fa-user-circle" style="font-size:10px;"></i> Nama Pemilik</div>
            <div id="previewProduk" style="background:#fffbeb;border:1px solid #fde68a;border-radius:8px;padding:6px 10px;font-size:11.5px;color:#92400e;display:none;margin-bottom:8px;">
              <i class="fas fa-star" style="color:#f59e0b;font-size:10px;"></i> <span id="previewProdukText"></span>
            </div>
            <div id="previewDesc" style="font-size:12px;color:#64748b;text-align:center;line-height:1.5;margin-bottom:10px;display:none;"><span id="previewDescText"></span></div>
            <div id="previewAlamat" style="font-size:11.5px;color:#64748b;display:none;margin-bottom:4px;"><i class="fas fa-map-marker-alt" style="font-size:9px;color:#94a3b8;"></i> <span id="previewAlamatText"></span></div>
            <div id="previewJam" style="font-size:11.5px;color:#64748b;display:none;"><i class="fas fa-clock" style="font-size:9px;color:#94a3b8;"></i> <span id="previewJamText"></span></div>
            <div id="previewWa" style="margin-top:10px;display:none;">
              <div style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;border-radius:8px;font-size:12px;font-weight:600;background:#f0fdf4;color:#16a34a;border:1px solid #bbf7d0;">
                <i class="fab fa-whatsapp"></i> <span id="previewWaText"></span>
              </div>
            </div>
            <div id="previewIg" style="margin-top:6px;display:none;">
              <div style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;border-radius:8px;font-size:12px;font-weight:600;background:#fdf4ff;color:#a21caf;border:1px solid #f0abfc;">
                <i class="fab fa-instagram"></i> <span id="previewIgText"></span>
              </div>
            </div>
          </div>
        </div>
        <p style="font-size:11px;color:#94a3b8;text-align:center;margin-top:10px;"><i class="fas fa-info-circle"></i> Pratinjau diperbarui otomatis saat Anda mengetik.</p>
      </div>
    </div>

  </div>
</div>

</form>

@push('scripts')
<script>
// Category metadata for live preview
const katData = {
  @foreach($kategoriList as $key => $kat)
  '{{ $key }}': { label: '{{ $kat['label'] }}', icon: '{{ $kat['icon'] }}', color: '{{ $kat['color'] }}' },
  @endforeach
};

function updatePreview() {
  const nama      = document.getElementById('namaUsaha').value || 'Nama Usaha';
  const pemilik   = document.getElementById('pemilikUsaha').value || 'Nama Pemilik';
  const katVal    = document.getElementById('kategoriUsaha').value;
  const produk    = document.getElementById('produkUnggulan').value;
  const desc      = document.getElementById('deskripsiUsaha').value;
  const alamat    = document.getElementById('alamatUsaha').value;
  const jam       = document.getElementById('jamBuka').value;
  const hp        = document.getElementById('noHp').value;
  const ig        = document.getElementById('igUsaha').value;

  document.getElementById('previewNama').textContent = nama;
  document.getElementById('previewPemilik').innerHTML = '<i class="fas fa-user-circle" style="font-size:10px;"></i> ' + pemilik;

  const kat = katData[katVal];
  if (kat) {
    document.getElementById('previewBar').style.background = kat.color;
    document.getElementById('previewBadge').style.background = kat.color + '1a';
    document.getElementById('previewBadge').style.color = kat.color;
    document.getElementById('previewBadge').style.borderColor = kat.color + '33';
    document.getElementById('previewKat').textContent = kat.label;
    document.getElementById('previewBadge').querySelector('i').className = 'fas ' + kat.icon + ' ' + 'fa-fw';
    document.getElementById('previewAvatar').style.background = kat.color + '20';
    document.getElementById('previewAvatar').style.color = kat.color;
    document.getElementById('previewAvatar').innerHTML = '<i class="fas ' + kat.icon + '" style="font-size:22px;"></i>';
  } else {
    document.getElementById('previewBar').style.background = '#e2e8f0';
    document.getElementById('previewKat').textContent = 'Kategori';
  }

  setShow('previewProduk',  produk,  () => { document.getElementById('previewProdukText').textContent = produk; });
  setShow('previewDesc',    desc,    () => { document.getElementById('previewDescText').textContent = desc.substring(0,80) + (desc.length>80?'...':''); });
  setShow('previewAlamat',  alamat,  () => { document.getElementById('previewAlamatText').textContent = alamat.substring(0,45)+(alamat.length>45?'...':''); });
  setShow('previewJam',     jam,     () => { document.getElementById('previewJamText').textContent = jam; });
  setShow('previewWa',      hp,      () => { document.getElementById('previewWaText').textContent = hp; });
  setShow('previewIg',      ig,      () => { document.getElementById('previewIgText').textContent = '@' + ig; });
}

function setShow(elId, val, fn) {
  const el = document.getElementById(elId);
  if (val && val.trim()) { el.style.display = ''; fn(); }
  else { el.style.display = 'none'; }
}

// Toggle label
const toggle = document.getElementById('aktifToggle');
toggle.addEventListener('change', function() {
  document.getElementById('toggleLabel').textContent = this.checked ? 'Ditampilkan ke Publik' : 'Disembunyikan';
});

// Init preview
updatePreview();
</script>
@endpush

@endsection
