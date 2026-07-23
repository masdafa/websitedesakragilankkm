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
            <input type="text" id="nikPage" name="nik" maxlength="16" placeholder="16 digit NIK" required>
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

        <button type="submit" class="btn-submit-form" id="submitBtnPage">
          <i class="fas fa-paper-plane"></i> Kirim Pengajuan via WhatsApp
        </button>
      </form>
    </div>

  </div>
</section>

<script>
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
  const alert = document.getElementById('formAlertPage');
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
      const jenis = formData.get('jenisSurat');
      const kode = data.kode_pengajuan;
      const noHP = '6282112345678';
      const pesan = encodeURIComponent(
        `Halo Admin Desa Kragilan,\n\nSaya ingin mengajukan:\n- Jenis Surat: ${jenis}\n- Nama: ${nama}\n- Kode Pengajuan: ${kode}\n\nMohon bantuannya. Terima kasih.`
      );
      alert.className = 'form-alert success';
      alert.innerHTML = `<i class="fas fa-check-circle"></i> Pengajuan berhasil! Kode: <strong>${kode}</strong>. Halaman WhatsApp akan terbuka...`;
      alert.style.display = 'block';
      setTimeout(() => window.open(`https://wa.me/${noHP}?text=${pesan}`, '_blank'), 1500);
    } else {
      alert.className = 'form-alert error';
      alert.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${data.message}`;
      alert.style.display = 'block';
    }
  } catch (err) {
    alert.className = 'form-alert error';
    alert.innerHTML = '<i class="fas fa-exclamation-circle"></i> Gagal terhubung ke server.';
    alert.style.display = 'block';
  } finally {
    btn.disabled = false;
    btn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim Pengajuan via WhatsApp';
  }
});
</script>
@endsection
