@extends('layouts.app')
@section('content')
<!-- HERO -->
<section class="hero" id="beranda">
  <div class="hero-overlay"></div>
  <div class="hero-content container">
    <span class="badge-hero"><i class="fas fa-check-circle"></i> Layanan Aktif</span>
    <h2>Pelayanan Administrasi Surat<br/>Desa Kragilan</h2>
    <p>Urus surat desa lebih mudah, cepat, dan transparan.<br/>Cek persyaratan sebelum datang agar tidak bolak-balik.</p>
    <div class="hero-actions">
      <a href="{{ route('pelayanan') }}" class="btn btn-primary"><i class="fas fa-file-alt"></i> Lihat Jenis Surat</a>
      <a href="{{ route('persyaratan') }}" class="btn btn-outline"><i class="fas fa-list-check"></i> Cek Persyaratan</a>
    </div>
  </div>
</section>

<!-- QUICK ACCESS CARDS -->
<section class="quick-access-section">
  <div class="container">
    <div class="quick-access-grid">
      <a href="{{ route('pelayanan') }}" class="quick-card">
        <div class="quick-card-icon" style="background:linear-gradient(135deg,#1a6b3c,#2d9b61)">
          <i class="fas fa-file-alt"></i>
        </div>
        <div class="quick-card-text">
          <strong>Jenis Surat</strong>
          <span>9 Layanan Tersedia</span>
        </div>
        <i class="fas fa-chevron-right quick-card-arrow"></i>
      </a>
      <a href="{{ route('persyaratan') }}" class="quick-card">
        <div class="quick-card-icon" style="background:linear-gradient(135deg,#c8973a,#e8b45a)">
          <i class="fas fa-list-check"></i>
        </div>
        <div class="quick-card-text">
          <strong>Persyaratan</strong>
          <span>Dokumen yang Dibutuhkan</span>
        </div>
        <i class="fas fa-chevron-right quick-card-arrow"></i>
      </a>
      <a href="{{ route('pengajuan') }}" class="quick-card">
        <div class="quick-card-icon" style="background:linear-gradient(135deg,#2563eb,#4f8ef7)">
          <i class="fas fa-paper-plane"></i>
        </div>
        <div class="quick-card-text">
          <strong>Pengajuan Online</strong>
          <span>Ajukan Tanpa Antri</span>
        </div>
        <i class="fas fa-chevron-right quick-card-arrow"></i>
      </a>
      <a href="{{ route('cek-status') }}" class="quick-card">
        <div class="quick-card-icon" style="background:linear-gradient(135deg,#7c3aed,#a78bfa)">
          <i class="fas fa-search"></i>
        </div>
        <div class="quick-card-text">
          <strong>Cek Status</strong>
          <span>Pantau Pengajuan Anda</span>
        </div>
        <i class="fas fa-chevron-right quick-card-arrow"></i>
      </a>
    </div>
  </div>
</section>

<!-- ==============================
     PROFIL DESA
================================ -->
<section class="section" id="profil">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Profil Desa</span>
      <h2>Mengenal Desa Kragilan</h2>
      <p>Informasi umum tentang pemerintahan dan wilayah Desa Kragilan</p>
    </div>
    <div class="profil-visimisi">
      <div class="visimisi-card visi">
        <div class="visimisi-icon"><i class="fas fa-eye"></i></div>
        <h3>Visi</h3>
        <p>"Terwujudnya Desa Kragilan yang Maju, Mandiri, dan Sejahtera Berbasis Potensi Lokal dengan Tata Kelola Pemerintahan yang Bersih dan Transparan"</p>
      </div>
      <div class="visimisi-card misi">
        <div class="visimisi-icon"><i class="fas fa-bullseye"></i></div>
        <h3>Misi</h3>
        <ul>
          <li><i class="fas fa-check"></i> Meningkatkan kualitas pelayanan administrasi kepada masyarakat</li>
          <li><i class="fas fa-check"></i> Mengembangkan potensi ekonomi lokal dan UMKM desa</li>
          <li><i class="fas fa-check"></i> Meningkatkan kualitas infrastruktur dan fasilitas umum</li>
          <li><i class="fas fa-check"></i> Memberdayakan masyarakat melalui pendidikan dan pelatihan</li>
          <li><i class="fas fa-check"></i> Mewujudkan tata kelola pemerintahan yang transparan dan akuntabel</li>
        </ul>
      </div>
    </div>

    <!-- STRUKTUR ORGANISASI -->
    <div class="section-header" style="margin-top:60px; margin-bottom:36px;">
      <span class="section-tag">Struktur Organisasi</span>
      <h2>Perangkat Desa Kragilan</h2>
    </div>
    <div class="struktur-wrap">

      <!-- Baris 1: Kepala Desa + BPD -->
      <div class="struktur-top">
        <div class="struktur-card kepala">
          <div class="struktur-avatar"><i class="fas fa-user-tie"></i></div>
          <div class="struktur-nama">Budy Cahyadi, S.Sos</div>
          <div class="struktur-jabatan">Pj. Kepala Desa</div>
        </div>
        <div class="struktur-card bpd">
          <div class="struktur-avatar"><i class="fas fa-landmark"></i></div>
          <div class="struktur-nama">BPD</div>
          <div class="struktur-jabatan">Badan Permusyawaratan Desa</div>
        </div>
      </div>

      <!-- Baris 2: Sekretaris Desa -->
      <div class="struktur-line-v"></div>
      <div class="struktur-mid">
        <div class="struktur-card sekretaris">
          <div class="struktur-avatar"><i class="fas fa-user"></i></div>
          <div class="struktur-nama">Elzan Haerul Yahya</div>
          <div class="struktur-jabatan">Sekretaris Desa</div>
        </div>
      </div>

      <!-- Baris 3: Kaur (3 orang) + Kasi (3 orang) -->
      <div class="struktur-line-v"></div>
      <div class="struktur-line-h"></div>

      <!-- Kaur -->
      <div class="struktur-group-label">Kepala Urusan (Kaur)</div>
      <div class="struktur-bottom">
        <div class="struktur-card kaur">
          <div class="struktur-avatar"><i class="fas fa-desktop"></i></div>
          <div class="struktur-nama">Suherman</div>
          <div class="struktur-jabatan">Kaur Tata Usaha & Umum</div>
        </div>
        <div class="struktur-card kaur">
          <div class="struktur-avatar"><i class="fas fa-coins"></i></div>
          <div class="struktur-nama">Vanesa Adni</div>
          <div class="struktur-jabatan">Kaur Keuangan</div>
        </div>
        <div class="struktur-card kaur">
          <div class="struktur-avatar"><i class="fas fa-chart-bar"></i></div>
          <div class="struktur-nama">Aspari</div>
          <div class="struktur-jabatan">Kaur Perencanaan</div>
        </div>
      </div>

      <!-- Kasi -->
      <div class="struktur-group-label" style="margin-top:28px;">Kepala Seksi (Kasi)</div>
      <div class="struktur-bottom">
        <div class="struktur-card kasi">
          <div class="struktur-avatar"><i class="fas fa-file-invoice"></i></div>
          <div class="struktur-nama">Ipa Fita Hidayani</div>
          <div class="struktur-jabatan">Kasi Pemerintahan</div>
        </div>
        <div class="struktur-card kasi">
          <div class="struktur-avatar"><i class="fas fa-concierge-bell"></i></div>
          <div class="struktur-nama">Arif Kurniawan</div>
          <div class="struktur-jabatan">Kasi Pelayanan</div>
        </div>
        <div class="struktur-card kasi">
          <div class="struktur-avatar"><i class="fas fa-hands-helping"></i></div>
          <div class="struktur-nama">M. Fauzi Al Ghifari</div>
          <div class="struktur-jabatan">Kasi Kesejahteraan</div>
        </div>
      </div>

      <!-- Kampung -->
      <div class="struktur-line-v"></div>
      <div class="struktur-bottom">
        <div class="struktur-card kampung">
          <div class="struktur-avatar"><i class="fas fa-home"></i></div>
          <div class="struktur-nama">Kampung / RT / RW</div>
          <div class="struktur-jabatan">Tingkat Kampung</div>
        </div>
      </div>

      <!-- Legenda -->
      <div class="struktur-legenda">
        <span><span class="leg-line konsultasi"></span> Garis Konsultasi</span>
        <span><span class="leg-line komando"></span> Garis Komando</span>
        <span><span class="leg-line koordinasi"></span> Garis Koordinasi</span>
      </div>

    </div>

    <!-- INFO DESA -->
    <div class="infodesa-grid" style="margin-top:60px;">
      <div class="infodesa-card">
        <i class="fas fa-map"></i>
        <div>
          <div class="infodesa-label">Luas Wilayah</div>
          <div class="infodesa-val">Ã‚Â± 312 Ha</div>
        </div>
      </div>
      <div class="infodesa-card">
        <i class="fas fa-users"></i>
        <div>
          <div class="infodesa-label">Jumlah Penduduk</div>
          <div class="infodesa-val">3.241 Jiwa</div>
        </div>
      </div>
      <div class="infodesa-card">
        <i class="fas fa-home"></i>
        <div>
          <div class="infodesa-label">Jumlah KK</div>
          <div class="infodesa-val">987 KK</div>
        </div>
      </div>
      <div class="infodesa-card">
        <i class="fas fa-road"></i>
        <div>
          <div class="infodesa-label">Jumlah RT / RW</div>
          <div class="infodesa-val">24 RT / 6 RW</div>
        </div>
      </div>
      <div class="infodesa-card">
        <i class="fas fa-landmark"></i>
        <div>
          <div class="infodesa-label">Kecamatan</div>
          <div class="infodesa-val">Kragilan</div>
        </div>
      </div>
      <div class="infodesa-card">
        <i class="fas fa-map-marked-alt"></i>
        <div>
          <div class="infodesa-label">Kabupaten / Provinsi</div>
          <div class="infodesa-val">Serang / Banten</div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- STATISTIK -->
<section class="stats-section container">
  <div class="stat-card">
    <i class="fas fa-file-signature"></i>
    <div class="stat-num">12</div>
    <div class="stat-label">Jenis Surat Tersedia</div>
  </div>
  <div class="stat-card">
    <i class="fas fa-users"></i>
    <div class="stat-num">3.241</div>
    <div class="stat-label">Penduduk Terlayani</div>
  </div>
  <div class="stat-card">
    <i class="fas fa-clock"></i>
    <div class="stat-num">1-3</div>
    <div class="stat-label">Hari Proses Surat</div>
  </div>
  <div class="stat-card">
    <i class="fas fa-star"></i>
    <div class="stat-num">Gratis</div>
    <div class="stat-label">Biaya Pelayanan</div>
  </div>
</section>


<!-- PANDUAN ALUR -->
<section class="section" id="panduan">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Alur Pengajuan</span>
      <h2>Cara Mengurus Surat Desa</h2>
      <p>Ikuti langkah-langkah berikut untuk memperlancar proses pengajuan surat</p>
    </div>
    <div class="alur-grid">
      <div class="alur-step">
        <div class="alur-num">1</div>
        <div class="alur-icon"><i class="fas fa-search"></i></div>
        <h3>Cek Persyaratan</h3>
        <p>Buka halaman persyaratan di website ini dan catat semua dokumen yang dibutuhkan sesuai jenis surat.</p>
      </div>
      <div class="alur-arrow"><i class="fas fa-chevron-right"></i></div>
      <div class="alur-step">
        <div class="alur-num">2</div>
        <div class="alur-icon"><i class="fas fa-file-alt"></i></div>
        <h3>Siapkan Dokumen</h3>
        <p>Siapkan dokumen asli dan fotokopi sesuai daftar persyaratan sebelum datang ke kantor desa.</p>
      </div>
      <div class="alur-arrow"><i class="fas fa-chevron-right"></i></div>
      <div class="alur-step">
        <div class="alur-num">3</div>
        <div class="alur-icon"><i class="fas fa-building"></i></div>
        <h3>Datang ke Kantor Desa</h3>
        <p>Kunjungi kantor desa pada jam pelayanan SeninÃ¢â‚¬â€œJumat pukul 08.00Ã¢â‚¬â€œ14.00 WIB.</p>
      </div>
      <div class="alur-arrow"><i class="fas fa-chevron-right"></i></div>
      <div class="alur-step">
        <div class="alur-num">4</div>
        <div class="alur-icon"><i class="fas fa-pen-fancy"></i></div>
        <h3>Isi Formulir</h3>
        <p>Ambil dan isi formulir pengajuan yang tersedia di kantor desa dengan data lengkap dan benar.</p>
      </div>
      <div class="alur-arrow"><i class="fas fa-chevron-right"></i></div>
      <div class="alur-step">
        <div class="alur-num">5</div>
        <div class="alur-icon"><i class="fas fa-envelope-open-text"></i></div>
        <h3>Ambil Surat</h3>
        <p>Surat akan selesai dalam 1Ã¢â‚¬â€œ3 hari kerja. Anda akan dihubungi via WhatsApp saat surat siap diambil.</p>
      </div>
    </div>
  </div>
</section>

<!-- TIPS / FAQ -->
<section class="section bg-light">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Tips & FAQ</span>
      <h2>Pertanyaan yang Sering Ditanyakan</h2>
    </div>
    <div class="faq-grid">
      <div class="faq-item">
        <button class="faq-q" onclick="toggleFaq(this)">
          <span>Berapa lama proses pembuatan surat?</span>
          <i class="fas fa-plus"></i>
        </button>
        <div class="faq-a">
          <p>Sebagian besar surat dapat selesai dalam <strong>1 hari kerja</strong>. Untuk surat yang memerlukan survei lapangan seperti surat tanah atau IMB, proses dapat memakan waktu 2Ã¢â‚¬â€œ3 hari kerja.</p>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-q" onclick="toggleFaq(this)">
          <span>Apakah ada biaya untuk mengurus surat?</span>
          <i class="fas fa-plus"></i>
        </button>
        <div class="faq-a">
          <p>Semua layanan pembuatan surat di Desa Kragilan adalah <strong>GRATIS</strong>. Tidak ada pungutan dalam bentuk apapun.</p>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-q" onclick="toggleFaq(this)">
          <span>Mengapa warga sering bolak-balik ke kantor desa?</span>
          <i class="fas fa-plus"></i>
        </button>
        <div class="faq-a">
          <p>Penyebab paling umum adalah <strong>dokumen yang kurang lengkap</strong> saat pertama kali datang. Dengan mengecek persyaratan di website ini terlebih dahulu, Anda bisa menyiapkan semua dokumen sekaligus.</p>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-q" onclick="toggleFaq(this)">
          <span>Surat apa yang paling sering diurus warga?</span>
          <i class="fas fa-plus"></i>
        </button>
        <div class="faq-a">
          <p>Surat yang paling sering diajukan adalah <strong>SKTM (Surat Keterangan Tidak Mampu)</strong>, <strong>Surat Keterangan Domisili</strong>, dan <strong>Surat Keterangan Usaha</strong>.</p>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-q" onclick="toggleFaq(this)">
          <span>Apakah bisa mengajukan surat lewat WhatsApp?</span>
          <i class="fas fa-plus"></i>
        </button>
        <div class="faq-a">
          <p>Untuk saat ini, pengajuan masih dilakukan secara langsung di kantor desa. Namun Anda dapat <strong>menghubungi petugas via WhatsApp</strong> untuk konfirmasi persyaratan atau jadwal sebelum datang.</p>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-q" onclick="toggleFaq(this)">
          <span>Apakah perlu surat pengantar RT/RW terlebih dahulu?</span>
          <i class="fas fa-plus"></i>
        </button>
        <div class="faq-a">
          <p>Ya, untuk sebagian besar jenis surat <strong>diperlukan surat pengantar dari RT dan RW</strong> setempat sebagai langkah pertama sebelum datang ke kantor desa.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==============================
     BERITA & PENGUMUMAN
================================ -->
<section class="section bg-light" id="berita">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Informasi</span>
      <h2>Berita & Pengumuman Desa</h2>
      <p>Informasi terkini seputar pelayanan, kegiatan, dan kebijakan Desa Kragilan</p>
    </div>
    <div class="berita-grid">

      <div class="berita-card featured">
        <div class="berita-badge">Ã°Å¸â€œÂ¢ Pengumuman</div>
        <div class="berita-date"><i class="fas fa-calendar"></i> 20 Juli 2025</div>
        <h3>Penyesuaian Jam Layanan Selama Bulan Juli 2025</h3>
        <p>Kantor Desa Kragilan menyesuaikan jam pelayanan selama masa liburan sekolah. Pelayanan tetap buka SeninÃ¢â‚¬â€œJumat pukul 08.00Ã¢â‚¬â€œ14.00 WIB. Khusus Jumat ditutup pukul 11.00 WIB.</p>
        <span class="berita-tag pengumuman">Pelayanan</span>
      </div>

      <div class="berita-card">
        <div class="berita-badge">Ã°Å¸Å½â€œ Sosial</div>
        <div class="berita-date"><i class="fas fa-calendar"></i> 15 Juli 2025</div>
        <h3>Pendaftaran Beasiswa Bidikmisi 2025 Dibuka</h3>
        <p>Warga yang memerlukan Surat Pengantar Beasiswa untuk keperluan Bidikmisi dapat segera mengurus ke kantor desa. Siapkan persyaratan yang diperlukan.</p>
        <span class="berita-tag sosial">Pendidikan</span>
      </div>

      <div class="berita-card">
        <div class="berita-badge">Ã°Å¸ÂËœÃ¯Â¸Â Kegiatan</div>
        <div class="berita-date"><i class="fas fa-calendar"></i> 10 Juli 2025</div>
        <h3>Gotong Royong Pembersihan Lingkungan RT 05</h3>
        <p>Kegiatan gotong royong rutin bulanan Desa Kragilan berjalan lancar. Warga antusias berpartisipasi dalam menjaga kebersihan dan keindahan lingkungan desa.</p>
        <span class="berita-tag kegiatan">Kegiatan</span>
      </div>

      <div class="berita-card">
        <div class="berita-badge">Ã°Å¸â€™Â° Bantuan</div>
        <div class="berita-date"><i class="fas fa-calendar"></i> 5 Juli 2025</div>
        <h3>Penyaluran Bantuan PKH Tahap III 2025</h3>
        <p>Penyaluran bantuan Program Keluarga Harapan (PKH) tahap III tahun 2025 untuk warga penerima manfaat di Desa Kragilan telah selesai dilaksanakan.</p>
        <span class="berita-tag bantuan">Bantuan Sosial</span>
      </div>

      <div class="berita-card">
        <div class="berita-badge">Ã°Å¸Å¡Â§ Infrastruktur</div>
        <div class="berita-date"><i class="fas fa-calendar"></i> 1 Juli 2025</div>
        <h3>Perbaikan Jalan Desa RW 03 Dimulai</h3>
        <p>Proyek perbaikan jalan desa di wilayah RW 03 resmi dimulai. Warga diimbau berhati-hati saat melintas di area konstruksi selama proses pengerjaan berlangsung.</p>
        <span class="berita-tag kegiatan">Infrastruktur</span>
      </div>

      <div class="berita-card">
        <div class="berita-badge">Ã°Å¸â€œâ€¹ Administrasi</div>
        <div class="berita-date"><i class="fas fa-calendar"></i> 25 Juni 2025</div>
        <h3>Pemutakhiran Data Penduduk Semester I 2025</h3>
        <p>Desa Kragilan mengadakan pemutakhiran data kependudukan semester I 2025. Warga yang belum memperbarui data KTP dan KK diimbau segera melapor ke kantor desa.</p>
        <span class="berita-tag pengumuman">Kependudukan</span>
      </div>

    </div>
  </div>
</section>

<!-- ==============================
     GALERI FOTO DESA
================================ -->
<section class="section bg-light" id="galeri">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Galeri</span>
      <h2>Foto Kegiatan Desa Kragilan</h2>
      <p>Dokumentasi kegiatan pelayanan, pembangunan, dan kehidupan masyarakat desa</p>
    </div>
    <div class="galeri-grid">

      <div class="galeri-item" onclick="showGaleri(0)">
        <div class="galeri-img" style="background:linear-gradient(135deg,#1a6b3c,#2d9b61)">
          <i class="fas fa-building"></i>
        </div>
        <div class="galeri-overlay"><i class="fas fa-expand"></i></div>
        <div class="galeri-caption">Kantor Desa Kragilan</div>
      </div>

      <div class="galeri-item" onclick="showGaleri(1)">
        <div class="galeri-img" style="background:linear-gradient(135deg,#c8973a,#e8b45a)">
          <i class="fas fa-users"></i>
        </div>
        <div class="galeri-overlay"><i class="fas fa-expand"></i></div>
        <div class="galeri-caption">Pelayanan Administrasi</div>
      </div>

      <div class="galeri-item" onclick="showGaleri(2)">
        <div class="galeri-img" style="background:linear-gradient(135deg,#2563eb,#4f8ef7)">
          <i class="fas fa-hands-helping"></i>
        </div>
        <div class="galeri-overlay"><i class="fas fa-expand"></i></div>
        <div class="galeri-caption">Gotong Royong Warga</div>
      </div>

      <div class="galeri-item" onclick="showGaleri(3)">
        <div class="galeri-img" style="background:linear-gradient(135deg,#7c3aed,#a78bfa)">
          <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="galeri-overlay"><i class="fas fa-expand"></i></div>
        <div class="galeri-caption">Penyerahan Beasiswa</div>
      </div>

      <div class="galeri-item" onclick="showGaleri(4)">
        <div class="galeri-img" style="background:linear-gradient(135deg,#e53e3e,#fc8181)">
          <i class="fas fa-road"></i>
        </div>
        <div class="galeri-overlay"><i class="fas fa-expand"></i></div>
        <div class="galeri-caption">Pembangunan Jalan Desa</div>
      </div>

      <div class="galeri-item" onclick="showGaleri(5)">
        <div class="galeri-img" style="background:linear-gradient(135deg,#319795,#81e6d9)">
          <i class="fas fa-seedling"></i>
        </div>
        <div class="galeri-overlay"><i class="fas fa-expand"></i></div>
        <div class="galeri-caption">Penghijauan Lingkungan</div>
      </div>

    </div>
    <p class="galeri-note"><i class="fas fa-images"></i> Foto di atas merupakan ilustrasi. Ganti dengan foto asli kegiatan Desa Kragilan.</p>
  </div>
</section>

<!-- ==============================
     TESTIMONI WARGA
================================ -->
<section class="section" id="testimoni" style="background: linear-gradient(135deg, #f0f7f3 0%, #fafafa 100%);">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Testimoni</span>
      <h2>Apa Kata Warga Kami</h2>
      <p>Pengalaman nyata warga Desa Kragilan dalam mengurus surat administrasi</p>
    </div>

    <!-- Testimoni Grid -->
    <div class="testimoni-grid">
      @foreach($testimonis as $t)
      <div class="testi-card">
        <div class="testi-quote"><i class="fas fa-quote-left"></i></div>
        <div class="testi-stars">
          @for($s=1; $s<=5; $s++)
            <i class="fas fa-star{{ $s <= (is_array($t) ? $t['bintang'] : $t->bintang) ? '' : '-half-alt' }}"
               style="color: {{ $s <= (is_array($t) ? $t['bintang'] : $t->bintang) ? '#f59e0b' : '#d1d5db' }};"></i>
          @endfor
        </div>
        <p class="testi-text">"{{ is_array($t) ? $t['isi'] : $t->isi }}"</p>
        <div class="testi-author">
          <div class="testi-avatar">
            <i class="fas fa-user"></i>
          </div>
          <div>
            <strong>{{ is_array($t) ? $t['nama'] : $t->nama }}</strong>
            <span>{{ is_array($t) ? $t['wilayah'] : $t->wilayah }}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Form Tambah Testimoni -->
    <div class="testi-form-wrap">
      <div class="testi-form-header">
        <i class="fas fa-pen-to-square"></i>
        <div>
          <h3>Bagikan Pengalaman Anda</h3>
          <p>Ceritakan pengalaman Anda mengurus surat di Desa Kragilan</p>
        </div>
      </div>
      <form id="testiForm" class="testi-form">
        <div class="form-row">
          <div class="form-group">
            <label for="testiNama">Nama Lengkap <span class="req">*</span></label>
            <input type="text" id="testiNama" placeholder="Contoh: Bapak Ahmad" required>
          </div>
          <div class="form-group">
            <label for="testiWilayah">RT/RW (opsional)</label>
            <input type="text" id="testiWilayah" placeholder="Contoh: Warga RT 05 / RW 02">
          </div>
        </div>
        <div class="form-group">
          <label>Rating <span class="req">*</span></label>
          <div class="star-rating" id="starRating">
            <i class="fas fa-star star-btn" data-val="1"></i>
            <i class="fas fa-star star-btn" data-val="2"></i>
            <i class="fas fa-star star-btn" data-val="3"></i>
            <i class="fas fa-star star-btn" data-val="4"></i>
            <i class="fas fa-star star-btn" data-val="5"></i>
          </div>
          <input type="hidden" id="testiBintang" value="0">
        </div>
        <div class="form-group">
          <label for="testiIsi">Cerita / Pengalaman Anda <span class="req">*</span></label>
          <textarea id="testiIsi" rows="3" placeholder="Tuliskan pengalaman Anda mengurus surat di sini..." maxlength="500" required></textarea>
          <div class="char-count"><span id="charCount">0</span>/500 karakter</div>
        </div>
        <div id="testiAlert" class="form-alert" style="display:none"></div>
        <button type="submit" class="btn-submit-form" id="testiBtn">
          <i class="fas fa-paper-plane"></i> Kirim Testimoni
        </button>
      </form>
    </div>

  </div>
</section>



<!-- ==============================
     KONTAK DESA
================================ -->
<section class="section" id="kontak">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Kontak</span>
      <h2>Informasi Kontak Desa Kragilan</h2>
    </div>
    <div class="kontak-grid">
      <div class="kontak-card">
        <i class="fas fa-map-marker-alt"></i>
        <h3>Alamat Kantor</h3>
        <p>Jl. Raya Keragilan No. 01, Desa Kragilan,<br/>Kecamatan Kragilan, Kabupaten Serang,<br/>Provinsi Banten</p>
      </div>
      <div class="kontak-card">
        <i class="fas fa-clock"></i>
        <h3>Jam Pelayanan</h3>
        <p>Senin Ã¢â‚¬â€œ Kamis: 08.00 Ã¢â‚¬â€œ 14.00 WIB<br/>Jumat: 08.00 Ã¢â‚¬â€œ 11.00 WIB<br/>Sabtu Ã¢â‚¬â€œ Minggu: Tutup</p>
      </div>
      <div class="kontak-card">
        <i class="fab fa-whatsapp"></i>
        <h3>WhatsApp</h3>
        <p>0821-1234-5678<br/><small>(Untuk konfirmasi persyaratan & jadwal)</small></p>
        <a href="https://wa.me/6282112345678" class="btn btn-primary" style="margin-top:10px;">
          <i class="fab fa-whatsapp"></i> Chat WhatsApp
        </a>
      </div>
      <div class="kontak-card">
        <i class="fas fa-envelope"></i>
        <h3>Email</h3>
        <p>desakragilan@gmail.com</p>
      </div>
    </div>

    <!-- MAPS -->
    <div class="maps-wrap">
      <h3><i class="fas fa-map-marked-alt"></i> Lokasi Kantor Desa Kragilan</h3>
      <div class="maps-frame">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.9!2d106.1!3d-6.12!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e41f0000000001%3A0x0!2sDesa%20Keragilan%2C%20Kec.%20Serang%2C%20Kab.%20Serang!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
          allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          title="Peta lokasi Kantor Desa Kragilan">
        </iframe>
      </div>
      <a href="https://maps.google.com/?q=Desa+Keragilan+Serang+Banten" target="_blank" rel="noopener" class="btn btn-primary maps-btn">
        <i class="fas fa-directions"></i> Buka di Google Maps
      </a>
    </div>
  </div>
</section>

@endsection



