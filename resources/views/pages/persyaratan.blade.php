@extends("layouts.app")
@section("content")

<section class="page-hero">
  <div class="container page-hero-inner">
    <div>
      <div class="page-breadcrumb"><a href="{{ route("home") }}">Beranda</a> <i class="fas fa-chevron-right"></i> Persyaratan</div>
      <h2 class="page-title">Persyaratan Pengajuan Surat</h2>
      <p class="page-subtitle">Siapkan dokumen yang diperlukan sebelum datang atau mengajukan online</p>
    </div>
    <a href="{{ route("pengajuan") }}" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Ajukan Online</a>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="syarat-wrapper">
      <div class="syarat-sidebar">
        <button class="syarat-tab active" onclick="switchTab(this,'domisili')">Surat Domisili</button>
        <button class="syarat-tab" onclick="switchTab(this,'keluarga')">Surat Keterangan Keluarga</button>
        <button class="syarat-tab" onclick="switchTab(this,'usaha')">Surat Keterangan Usaha</button>
        <button class="syarat-tab" onclick="switchTab(this,'tidakmampu')">Surat Tidak Mampu</button>
        <button class="syarat-tab" onclick="switchTab(this,'nikah')">Surat Belum Menikah</button>
        <button class="syarat-tab" onclick="switchTab(this,'tanah')">Surat Keterangan Tanah</button>
        <button class="syarat-tab" onclick="switchTab(this,'bpjs')">Surat Pengantar BPJS</button>
        <button class="syarat-tab" onclick="switchTab(this,'beasiswa')">Surat Beasiswa</button>
      </div>
      <div class="syarat-content">

        <div id="tab-domisili" class="syarat-panel">
          <h3>Surat Keterangan Domisili</h3>
          <p class="syarat-desc">Untuk keperluan pendaftaran sekolah, NPWP, rekening bank, dan lainnya.</p>
          <ul class="syarat-list">
            <li><i class="fas fa-check-circle"></i> Fotokopi KTP yang masih berlaku</li>
            <li><i class="fas fa-check-circle"></i> Fotokopi Kartu Keluarga (KK)</li>
            <li><i class="fas fa-check-circle"></i> Surat pengantar dari RT/RW setempat</li>
            <li><i class="fas fa-check-circle"></i> Mengisi formulir permohonan di balai desa atau online</li>
          </ul>
          <div class="syarat-note"><i class="fas fa-info-circle"></i> Estimasi waktu penyelesaian: <strong>1 hari kerja</strong></div>
        </div>

        <div id="tab-keluarga" class="syarat-panel" style="display:none">
          <h3>Surat Keterangan Keluarga</h3>
          <p class="syarat-desc">Menjelaskan susunan anggota keluarga dalam satu rumah tangga.</p>
          <ul class="syarat-list">
            <li><i class="fas fa-check-circle"></i> Fotokopi KTP semua anggota keluarga yang sudah dewasa</li>
            <li><i class="fas fa-check-circle"></i> Fotokopi Kartu Keluarga (KK)</li>
            <li><i class="fas fa-check-circle"></i> Surat pengantar dari RT/RW</li>
          </ul>
          <div class="syarat-note"><i class="fas fa-info-circle"></i> Estimasi waktu: <strong>1 hari kerja</strong></div>
        </div>

        <div id="tab-usaha" class="syarat-panel" style="display:none">
          <h3>Surat Keterangan Usaha</h3>
          <p class="syarat-desc">Untuk mengurus perizinan usaha, BPJS, atau keperluan perbankan.</p>
          <ul class="syarat-list">
            <li><i class="fas fa-check-circle"></i> Fotokopi KTP pemilik usaha</li>
            <li><i class="fas fa-check-circle"></i> Fotokopi Kartu Keluarga (KK)</li>
            <li><i class="fas fa-check-circle"></i> Foto lokasi usaha (minimal 2 foto)</li>
            <li><i class="fas fa-check-circle"></i> Surat pengantar dari RT/RW</li>
            <li><i class="fas fa-check-circle"></i> Deskripsi singkat jenis usaha</li>
          </ul>
          <div class="syarat-note"><i class="fas fa-info-circle"></i> Estimasi waktu: <strong>1 hari kerja</strong></div>
        </div>

        <div id="tab-tidakmampu" class="syarat-panel" style="display:none">
          <h3>Surat Keterangan Tidak Mampu</h3>
          <p class="syarat-desc">Untuk mendapat keringanan biaya pendidikan, kesehatan, dll.</p>
          <ul class="syarat-list">
            <li><i class="fas fa-check-circle"></i> Fotokopi KTP</li>
            <li><i class="fas fa-check-circle"></i> Fotokopi Kartu Keluarga (KK)</li>
            <li><i class="fas fa-check-circle"></i> Surat pernyataan dari RT/RW bahwa benar tidak mampu</li>
            <li><i class="fas fa-check-circle"></i> Foto rumah bagian dalam dan luar</li>
          </ul>
          <div class="syarat-note"><i class="fas fa-info-circle"></i> Estimasi waktu: <strong>2 hari kerja</strong> (perlu survei)</div>
        </div>

        <div id="tab-nikah" class="syarat-panel" style="display:none">
          <h3>Surat Keterangan Belum Menikah</h3>
          <p class="syarat-desc">Dibutuhkan untuk proses pernikahan di KUA.</p>
          <ul class="syarat-list">
            <li><i class="fas fa-check-circle"></i> Fotokopi KTP</li>
            <li><i class="fas fa-check-circle"></i> Fotokopi Kartu Keluarga (KK)</li>
            <li><i class="fas fa-check-circle"></i> Fotokopi Akta Kelahiran</li>
            <li><i class="fas fa-check-circle"></i> Surat pengantar dari RT/RW</li>
          </ul>
          <div class="syarat-note"><i class="fas fa-info-circle"></i> Estimasi waktu: <strong>1 hari kerja</strong></div>
        </div>

        <div id="tab-tanah" class="syarat-panel" style="display:none">
          <h3>Surat Keterangan Tanah</h3>
          <p class="syarat-desc">Keterangan kepemilikan tanah untuk keperluan jual beli atau warisan.</p>
          <ul class="syarat-list">
            <li><i class="fas fa-check-circle"></i> Fotokopi KTP pemilik tanah</li>
            <li><i class="fas fa-check-circle"></i> Bukti kepemilikan tanah (girik / akte lama)</li>
            <li><i class="fas fa-check-circle"></i> Surat pernyataan tidak sengketa dari RT/RW</li>
            <li><i class="fas fa-check-circle"></i> Sketsa/peta lokasi tanah</li>
          </ul>
          <div class="syarat-note"><i class="fas fa-info-circle"></i> Estimasi waktu: <strong>3 hari kerja</strong></div>
        </div>

        <div id="tab-bpjs" class="syarat-panel" style="display:none">
          <h3>Surat Pengantar BPJS</h3>
          <p class="syarat-desc">Pengantar pembuatan atau perubahan data BPJS Kesehatan.</p>
          <ul class="syarat-list">
            <li><i class="fas fa-check-circle"></i> Fotokopi KTP</li>
            <li><i class="fas fa-check-circle"></i> Fotokopi Kartu Keluarga (KK)</li>
            <li><i class="fas fa-check-circle"></i> Kartu BPJS lama (jika perubahan data)</li>
          </ul>
          <div class="syarat-note"><i class="fas fa-info-circle"></i> Estimasi waktu: <strong>1 hari kerja</strong></div>
        </div>

        <div id="tab-beasiswa" class="syarat-panel" style="display:none">
          <h3>Surat Keterangan untuk Beasiswa</h3>
          <p class="syarat-desc">Pengantar pengajuan beasiswa pendidikan dari berbagai lembaga.</p>
          <ul class="syarat-list">
            <li><i class="fas fa-check-circle"></i> Fotokopi KTP (orang tua atau wali)</li>
            <li><i class="fas fa-check-circle"></i> Fotokopi Kartu Keluarga (KK)</li>
            <li><i class="fas fa-check-circle"></i> Surat keterangan masih aktif sekolah/kuliah</li>
            <li><i class="fas fa-check-circle"></i> Surat pengantar dari RT/RW</li>
          </ul>
          <div class="syarat-note"><i class="fas fa-info-circle"></i> Estimasi waktu: <strong>1 hari kerja</strong></div>
        </div>

      </div>
    </div>

    <div class="syarat-note" style="margin-top:32px; background:#e8f5ee; border-left-color:var(--green); color:var(--green-dark);">
      <i class="fas fa-lightbulb"></i>
      <strong>Tips:</strong> Semua dokumen harap difotokopi rangkap 2. Dokumen asli dibawa untuk diverifikasi saat pengambilan surat.
      Pengajuan online melalui form di bawah ini akan mempersingkat proses antrian di balai desa.
    </div>

    <div style="text-align:center; margin-top:40px;">
      <a href="{{ route('pengajuan') }}" class="btn btn-primary" style="font-size:16px; padding:14px 32px;">
        <i class="fas fa-paper-plane"></i> Ajukan Sekarang via Online
      </a>
    </div>
  </div>
</section>

<script>
function switchTab(btn, id) {
  document.querySelectorAll('.syarat-tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.syarat-panel').forEach(p => p.style.display = 'none');
  btn.classList.add('active');
  document.getElementById('tab-' + id).style.display = 'block';
}
</script>
@endsection
