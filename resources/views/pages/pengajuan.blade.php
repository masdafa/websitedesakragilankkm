@extends("layouts.app")
@section("content")

<section class="page-hero">
  <div class="container page-hero-inner">
    <div>
      <div class="page-breadcrumb"><a href="{{ route("home") }}">Beranda</a> <i class="fas fa-chevron-right"></i> Pengajuan Online</div>
      <h2 class="page-title">Form Pengajuan Surat Online</h2>
      <p class="page-subtitle">Isi formulir dengan lengkap dan benar. Surat akan diproses 1-3 hari kerja.</p>
    </div>
  </div>
</section>

<section class="section bg-light">
  <div class="container" style="max-width:800px;">

    <div class="form-card">
      <div class="form-card-header">
        <i class="fas fa-file-alt"></i>
        <div>
          <h3>Formulir Pengajuan Surat Desa Kragilan</h3>
          <p>Semua kolom bertanda <span style="color:red">*</span> wajib diisi</p>
        </div>
      </div>

      <form id="formPengajuanPage" class="pengajuan-form" novalidate>
        @csrf

        <div class="form-section-title"><i class="fas fa-file-signature"></i> Jenis Surat</div>
        <div class="form-group">
          <label for="jenisSuratPage">Jenis Surat <span class="req">*</span></label>
          <select id="jenisSuratPage" name="jenisSurat" required>
            <option value="">-- Pilih Jenis Surat --</option>
            <option>Surat Keterangan Domisili</option>
            <option>Surat Keterangan Keluarga</option>
            <option>Surat Keterangan Usaha</option>
            <option>Surat Keterangan Tidak Mampu</option>
            <option>Surat Keterangan Belum Menikah</option>
            <option>Surat Keterangan Tanah</option>
            <option>Surat Pengantar BPJS</option>
            <option>Surat Keterangan untuk Beasiswa</option>
          </select>
        </div>
        <div class="form-group">
          <label for="keperluanPage">Keperluan / Tujuan <span class="req">*</span></label>
          <input type="text" id="keperluanPage" name="keperluan" placeholder="Contoh: untuk mendaftar sekolah" required>
        </div>

        <div class="form-section-title"><i class="fas fa-user"></i> Data Pemohon</div>
        <div class="form-row">
          <div class="form-group">
            <label for="namaLengkapPage">Nama Lengkap <span class="req">*</span></label>
            <input type="text" id="namaLengkapPage" name="namaLengkap" placeholder="Sesuai KTP" required>
          </div>
          <div class="form-group">
            <label for="nikPage">NIK <span class="req">*</span></label>
            <input type="text" id="nikPage" name="nik" maxlength="16" placeholder="16 digit NIK" required
              oninput="validasiNIK(this.value)">
            <div id="nikInfo" style="margin-top:6px;font-size:0.82rem;display:none;"></div>
            <small style="color:#6b7280;font-size:0.78rem;">⚠️ Hanya KTP Kecamatan Kragilan, Kab. Serang, Banten yang dapat mengajukan surat.</small>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="tempatLahirPage">Tempat Lahir <span class="req">*</span></label>
            <input type="text" id="tempatLahirPage" name="tempatLahir" placeholder="Kota kelahiran" required>
          </div>
          <div class="form-group">
            <label for="tanggalLahirPage">Tanggal Lahir <span class="req">*</span></label>
            <input type="date" id="tanggalLahirPage" name="tanggalLahir" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="jenisKelaminPage">Jenis Kelamin <span class="req">*</span></label>
            <select id="jenisKelaminPage" name="jenisKelamin" required>
              <option value="">-- Pilih --</option>
              <option>Laki-laki</option>
              <option>Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="agamaPage">Agama <span class="req">*</span></label>
            <select id="agamaPage" name="agama" required>
              <option value="">-- Pilih --</option>
              <option>Islam</option>
              <option>Kristen Protestan</option>
              <option>Kristen Katolik</option>
              <option>Hindu</option>
              <option>Buddha</option>
              <option>Konghucu</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="alamatPage">Alamat Lengkap <span class="req">*</span></label>
          <textarea id="alamatPage" name="alamat" rows="3" placeholder="Jalan, RT/RW, Dusun, Desa" required></textarea>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="noHPPage">Nomor HP/WhatsApp <span class="req">*</span></label>
            <input type="tel" id="noHPPage" name="noHP" placeholder="08xxxxxxxxxx" required>
          </div>
          <div class="form-group">
            <label for="pekerjaanPage">Pekerjaan</label>
            <input type="text" id="pekerjaanPage" name="pekerjaan" placeholder="Opsional">
          </div>
        </div>

        <div id="formAlertPage" class="form-alert" style="display:none"></div>

        <div class="form-action-buttons">
          <button type="submit" class="btn-submit-form" id="submitBtnPage">
            <i class="fas fa-paper-plane"></i> Kirim Pengajuan
          </button>
          <button type="button" class="btn-reset-form" id="resetBtnPage" onclick="resetForm()">
            <i class="fas fa-redo-alt"></i> Reset Form
          </button>
        </div>
      </form>
    </div>

  </div>
</section>

<script>
// ============================================================
// VALIDASI NIK KECAMATAN KRAGILAN
// NIK Indonesia: 16 digit
// 6 digit pertama = kode wilayah KTP
// 360411 = Banten (36) + Kab. Serang (04) + Kec. Kragilan (11)
// ============================================================
const KODE_KRAGILAN = '360411';

function resetForm() {
  const form = document.getElementById('formPengajuanPage');
  form.reset();
  // Reset NIK info & alert
  const nikInfo = document.getElementById('nikInfo');
  nikInfo.style.display = 'none';
  nikInfo.innerHTML = '';
  const alertBox = document.getElementById('formAlertPage');
  alertBox.style.display = 'none';
  alertBox.innerHTML = '';
  // Scroll ke atas form
  form.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function validasiNIK(nik) {
  const nikInfo = document.getElementById('nikInfo');
  nik = nik.replace(/\D/g, '');

  if (nik.length === 0) {
    nikInfo.style.display = 'none';
    return null;
  }
  if (nik.length < 6) {
    nikInfo.style.display = 'block';
    nikInfo.style.color = '#6b7280';
    nikInfo.innerHTML = '⏳ Masukkan NIK lengkap 16 digit...';
    return null;
  }

  const kodeWilayah = nik.substring(0, 6);
  const isKragilan = kodeWilayah === KODE_KRAGILAN;

  nikInfo.style.display = 'block';
  if (nik.length === 16 && isKragilan) {
    nikInfo.style.color = '#16a34a';
    nikInfo.innerHTML = '✅ NIK valid — KTP Kecamatan Kragilan, Kab. Serang, Banten.';
    return true;
  } else if (nik.length === 16 && !isKragilan) {
    nikInfo.style.color = '#dc2626';
    nikInfo.innerHTML = '❌ NIK tidak terdaftar di Kecamatan Kragilan. Pengajuan surat hanya untuk warga Kec. Kragilan, Kab. Serang, Banten.';
    return false;
  } else if (nik.length < 16) {
    nikInfo.style.color = '#6b7280';
    nikInfo.innerHTML = `⏳ NIK masih ${nik.length}/16 digit...`;
    return null;
  }
  return null;
}

// Pre-fill jenis surat dari query param
const urlParams = new URLSearchParams(window.location.search);
const jenis = urlParams.get('jenis');
if (jenis) {
  const sel = document.getElementById('jenisSuratPage');
  for (let opt of sel.options) {
    if (opt.text === jenis) { opt.selected = true; break; }
  }
}

document.getElementById('formPengajuanPage').addEventListener('submit', async function(e) {
  e.preventDefault();
  const btn = document.getElementById('submitBtnPage');
  const alertBox = document.getElementById('formAlertPage');

  // ─── SECURITY CHECK: Validasi NIK sebelum apapun ───
  const nikVal = document.getElementById('nikPage').value.replace(/\D/g, '');

  if (nikVal.length !== 16) {
    alertBox.className = 'form-alert error';
    alertBox.innerHTML = '<i class="fas fa-exclamation-triangle"></i> NIK harus 16 digit.';
    alertBox.style.display = 'block';
    document.getElementById('nikPage').focus();
    return;
  }

  const kodeWilayah = nikVal.substring(0, 6);
  if (kodeWilayah !== KODE_KRAGILAN) {
    alertBox.className = 'form-alert error';
    alertBox.innerHTML = `
      <i class="fas fa-ban"></i>
      <strong>Pengajuan Ditolak!</strong><br>
      NIK Anda tidak terdaftar di Kecamatan Kragilan, Kabupaten Serang, Banten.<br>
      <small>Layanan ini hanya tersedia untuk warga ber-KTP Kec. Kragilan. Silakan hubungi kantor desa setempat untuk informasi lebih lanjut.</small>
    `;
    alertBox.style.display = 'block';
    alertBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
    return; // ← Hentikan proses, jangan kirim ke server
  }
  // ─── END SECURITY CHECK ───

  btn.disabled = true;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

  const formData = new FormData(this);
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  try {
    const resp = await fetch('/submit-pengajuan', {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
      body: formData
    });
    const data = await resp.json();

    if (data.status === 'success') {
      const nama = formData.get('namaLengkap');
      const jenisSurat = formData.get('jenisSurat');
      const kode = data.kode_pengajuan;
      alertBox.className = 'form-alert success';
      alertBox.innerHTML = `<i class="fas fa-check-circle"></i> Pengajuan berhasil! Kode: <strong>${kode}</strong>. Data telah masuk ke sistem.`;
      alertBox.style.display = 'block';
      setTimeout(() => resetForm(), 3000);
    } else {
      alertBox.className = 'form-alert error';
      alertBox.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${data.message}`;
      alertBox.style.display = 'block';
    }
  } catch (err) {
    alertBox.className = 'form-alert error';
    alertBox.innerHTML = '<i class="fas fa-exclamation-circle"></i> Gagal terhubung ke server.';
    alertBox.style.display = 'block';
  } finally {
    btn.disabled = false;
    btn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim Pengajuan';
  }
});
</script>
@endsection
