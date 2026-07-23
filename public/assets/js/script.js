// ============================
// DATA PERSYARATAN SURAT
// ============================
const suratData = {
  domisili: {
    title: 'Surat Keterangan Domisili',
    tag: 'Kependudukan', tagClass: 'kependudukan',
    desc: 'Digunakan untuk keperluan perbankan, melamar pekerjaan, mendaftar sekolah, dan administrasi lainnya.',
    syarat: [
      'Surat pengantar dari RT dan RW setempat',
      'Fotokopi KTP yang masih berlaku',
      'Fotokopi Kartu Keluarga (KK)',
      'Surat pernyataan bermaterai (jika diperlukan)',
    ],
    note: 'Pastikan nama di KTP sudah sesuai dengan KK. Bawa dokumen asli untuk verifikasi.'
  },
  kelahiran: {
    title: 'Surat Keterangan Kelahiran',
    tag: 'Kependudukan', tagClass: 'kependudukan',
    desc: 'Surat pengantar desa untuk pengajuan akta kelahiran ke Dinas Dukcapil Kabupaten Serang.',
    syarat: [
      'Surat pengantar dari RT dan RW',
      'Fotokopi KTP kedua orang tua',
      'Fotokopi Kartu Keluarga (KK)',
      'Fotokopi buku nikah orang tua',
      'Surat keterangan lahir dari bidan / rumah sakit',
    ],
    note: 'Pengajuan akta kelahiran paling lambat 60 hari setelah kelahiran agar tidak dikenakan denda.'
  },
  kematian: {
    title: 'Surat Keterangan Kematian',
    tag: 'Kependudukan', tagClass: 'kependudukan',
    desc: 'Diperlukan untuk keperluan asuransi jiwa, warisan, pengurusan BPJS, dan pencabutan dokumen kependudukan.',
    syarat: [
      'Surat pengantar RT dan RW',
      'Fotokopi KTP almarhum/almarhumah',
      'Fotokopi KK yang memuat nama almarhum',
      'Surat keterangan kematian dari dokter / puskesmas / RS (jika ada)',
      'Fotokopi KTP pelapor (ahli waris)',
    ],
    note: 'Segera laporkan kematian dalam waktu 30 hari untuk memudahkan pengurusan administrasi.'
  },
  ktpkk: {
    title: 'Surat Pengantar KTP / KK',
    tag: 'Kependudukan', tagClass: 'kependudukan',
    desc: 'Surat pengantar dari desa untuk membuat, memperpanjang, atau mengubah data KTP dan Kartu Keluarga.',
    syarat: [
      'Surat pengantar RT dan RW',
      'Fotokopi KK lama (untuk perubahan data)',
      'Fotokopi KTP lama (untuk perpanjangan)',
      'Ijazah / akta kelahiran (untuk pembuatan baru)',
      'Dokumen pendukung sesuai jenis perubahan (akta nikah, akta cerai, dll)',
    ],
    note: 'KTP wajib dimiliki oleh setiap warga yang telah berusia 17 tahun atau sudah menikah.'
  },
  belumnikah: {
    title: 'Surat Keterangan Belum Menikah',
    tag: 'Kependudukan', tagClass: 'kependudukan',
    desc: 'Dibutuhkan untuk persyaratan pernikahan di KUA, melamar kerja di instansi tertentu, atau beasiswa.',
    syarat: [
      'Surat pengantar RT dan RW',
      'Fotokopi KTP pemohon',
      'Fotokopi KK pemohon',
      'Pas foto terbaru ukuran 3×4 (2 lembar)',
    ],
    note: 'Surat ini hanya berlaku selama 3 bulan sejak tanggal dikeluarkan.'
  },
  pindah: {
    title: 'Surat Keterangan Pindah',
    tag: 'Kependudukan', tagClass: 'kependudukan',
    desc: 'Diperlukan untuk melaporkan perpindahan domisili antar desa, kecamatan, atau kabupaten.',
    syarat: [
      'Surat pengantar RT dan RW asal',
      'Fotokopi KTP yang masih berlaku',
      'Fotokopi KK asal',
      'Surat permohonan pindah bermaterai',
      'Alamat tujuan pindah yang lengkap',
    ],
    note: 'Setelah mendapat surat pindah dari desa, wajib melapor ke Disdukcapil dalam waktu 30 hari.'
  },
  sku: {
    title: 'Surat Keterangan Usaha (SKU)',
    tag: 'Usaha & Ekonomi', tagClass: 'usaha',
    desc: 'Dibutuhkan untuk pengajuan kredit usaha (KUR), mendaftar UMKM, atau keperluan perizinan usaha.',
    syarat: [
      'Surat pengantar RT dan RW',
      'Fotokopi KTP pemohon',
      'Fotokopi KK pemohon',
      'Foto tempat usaha (tampak depan dan dalam)',
      'Deskripsi singkat jenis dan lokasi usaha',
    ],
    note: 'SKU yang diterbitkan desa dapat digunakan sebagai syarat pengajuan KUR di bank/koperasi.'
  },
  sktm: {
    title: 'Surat Keterangan Tidak Mampu (SKTM)',
    tag: 'Sosial & Bantuan', tagClass: 'sosial',
    desc: 'Digunakan untuk keperluan beasiswa, keringanan biaya pendidikan, layanan kesehatan gratis, atau bantuan sosial.',
    syarat: [
      'Surat pengantar RT dan RW',
      'Fotokopi KTP pemohon',
      'Fotokopi KK pemohon',
      'Pas foto terbaru 3×4 (2 lembar)',
      'Surat permohonan yang menjelaskan tujuan penggunaan',
      'Dokumen pendukung kondisi ekonomi jika ada (slip gaji, rekening koran, dll)',
    ],
    note: 'Petugas desa dapat melakukan kunjungan lapangan untuk verifikasi kondisi ekonomi pemohon.'
  },
  beasiswa: {
    title: 'Surat Pengantar Beasiswa',
    tag: 'Sosial & Bantuan', tagClass: 'sosial',
    desc: 'Surat rekomendasi dari Kepala Desa sebagai salah satu persyaratan pengajuan beasiswa pendidikan.',
    syarat: [
      'Surat pengantar RT dan RW',
      'Fotokopi KTP pemohon atau orang tua',
      'Fotokopi KK',
      'Fotokopi rapor / transkrip nilai terakhir',
      'Surat keterangan aktif sekolah/kuliah',
      'Informasi lembaga/program beasiswa yang dituju',
    ],
    note: 'Surat ini umumnya diperlukan untuk beasiswa dari pemerintah, swasta, maupun perguruan tinggi.'
  },
  tanah: {
    title: 'Surat Keterangan Tanah',
    tag: 'Tanah & Aset', tagClass: 'tanah',
    desc: 'Diperlukan sebagai bukti kepemilikan/penguasaan tanah yang belum bersertifikat untuk berbagai keperluan.',
    syarat: [
      'Surat pengantar RT dan RW',
      'Fotokopi KTP pemohon',
      'Fotokopi KK pemohon',
      'Letter C / girik / pipil tanah (jika ada)',
      'Denah / sketsa lokasi tanah',
      'Surat pernyataan tidak sengketa bermaterai',
      'Bukti pembayaran PBB tahun terakhir',
    ],
    note: 'Proses memerlukan survei lapangan oleh petugas desa. Harap berkoordinasi dengan perangkat desa terlebih dahulu.'
  },
  lakubaik: {
    title: 'Surat Keterangan Berkelakuan Baik',
    tag: 'Sosial & Bantuan', tagClass: 'sosial',
    desc: 'Digunakan untuk melamar pekerjaan, mendaftar organisasi, atau keperluan administrasi lainnya.',
    syarat: [
      'Surat pengantar RT dan RW',
      'Fotokopi KTP pemohon',
      'Fotokopi KK pemohon',
      'Pas foto terbaru 3×4 (2 lembar)',
      'Surat permohonan dengan menyebutkan tujuan penggunaan',
    ],
    note: 'Surat ini berbeda dengan SKCK. Untuk SKCK (Surat Catatan Kepolisian), pemohon harus mengurus ke Polsek setempat.'
  },
  imb: {
    title: 'Surat Pengantar IMB',
    tag: 'Tanah & Aset', tagClass: 'tanah',
    desc: 'Surat pengantar dari desa untuk proses pengajuan Izin Mendirikan Bangunan (IMB) ke Dinas terkait.',
    syarat: [
      'Surat pengantar RT dan RW',
      'Fotokopi KTP pemohon',
      'Fotokopi KK pemohon',
      'Sertifikat tanah / surat keterangan tanah',
      'Denah/gambar rencana bangunan',
      'Surat pernyataan tidak sengketa bermaterai',
      'Bukti pembayaran PBB tahun terakhir',
    ],
    note: 'IMB wajib dimiliki sebelum memulai pembangunan. Mendirikan bangunan tanpa IMB dapat dikenakan sanksi.'
  },
};

// ============================
// RENDER SYARAT CONTENT
// ============================
function renderSyarat(key) {
  const d = suratData[key];
  if (!d) return '<p>Data tidak ditemukan.</p>';
  return `
    <h3>${d.title}</h3>
    <span class="card-tag ${d.tagClass} modal-tag">${d.tag}</span>
    <p class="syarat-desc">${d.desc}</p>
    <ul class="syarat-list">
      ${d.syarat.map(s => `<li><i class="fas fa-check-circle"></i> ${s}</li>`).join('')}
    </ul>
    <div class="syarat-note"><i class="fas fa-info-circle"></i> <strong>Catatan:</strong> ${d.note}</div>
  `;
}

// ============================
// PERSYARATAN TAB SWITCH
// ============================
function switchSyarat(key, btn) {
  document.getElementById('syaratContent').innerHTML = renderSyarat(key);
  document.querySelectorAll('.syarat-tab').forEach(t => t.classList.remove('active'));
  if (btn) btn.classList.add('active');
}

// Init default tab
document.addEventListener('DOMContentLoaded', () => {
  switchSyarat('domisili');

  // ============================
  // FILTER SURAT
  // ============================
  const filterBtns = document.querySelectorAll('.filter-btn');
  const cards = document.querySelectorAll('.surat-card');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const filter = btn.dataset.filter;
      cards.forEach(card => {
        if (filter === 'all' || card.dataset.kategori === filter) {
          card.classList.remove('hidden');
        } else {
          card.classList.add('hidden');
        }
      });
    });
  });

  // ============================
  // HAMBURGER MENU
  // ============================
  const hamburger = document.getElementById('hamburger');
  const mobileNav = document.getElementById('mobileNav');
  hamburger.addEventListener('click', () => {
    mobileNav.classList.toggle('open');
  });

  // Close mobile nav on link click
  mobileNav.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => mobileNav.classList.remove('open'));
  });
});

// ============================
// MODAL
// ============================
function showModal(key) {
  const d = suratData[key];
  if (!d) return;
  document.getElementById('modalContent').innerHTML = `
    <span class="card-tag ${d.tagClass} modal-tag">${d.tag}</span>
    <h2>${d.title}</h2>
    <p style="color:#718096;font-size:14px;margin-bottom:20px;">${d.desc}</p>
    <h4 style="margin-bottom:12px;color:#1a6b3c;"><i class="fas fa-clipboard-list"></i> Persyaratan Dokumen</h4>
    <ul class="syarat-list">
      ${d.syarat.map(s => `<li><i class="fas fa-check-circle"></i> ${s}</li>`).join('')}
    </ul>
    <div class="syarat-note" style="margin-top:20px;">
      <i class="fas fa-info-circle"></i> <strong>Catatan:</strong> ${d.note}
    </div>
    <a href="#kontak" onclick="closeModal()" class="btn btn-primary" style="margin-top:20px;width:100%;justify-content:center;">
      <i class="fas fa-phone"></i> Hubungi Kantor Desa
    </a>
  `;
  document.getElementById('modalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}

function closeModal() {
  document.getElementById('modalOverlay').classList.remove('open');
  document.body.style.overflow = '';
}

// Close modal on Escape key
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') closeModal();
});

// ============================
// FAQ ACCORDION
// ============================
function toggleFaq(btn) {
  const answer = btn.nextElementSibling;
  const isOpen = btn.classList.contains('open');

  // Close all
  document.querySelectorAll('.faq-q').forEach(q => {
    q.classList.remove('open');
    q.nextElementSibling.classList.remove('open');
  });

  // Open clicked if it was closed
  if (!isOpen) {
    btn.classList.add('open');
    answer.classList.add('open');
  }
}

// ============================
// SMOOTH SCROLL ACTIVE NAV
// ============================
const sections = document.querySelectorAll('section[id], .hero[id]');
window.addEventListener('scroll', () => {
  let current = '';
  sections.forEach(sec => {
    if (window.scrollY >= sec.offsetTop - 80) current = sec.getAttribute('id');
  });
  document.querySelectorAll('.main-nav a').forEach(a => {
    a.style.background = '';
    a.style.color = '';
    if (a.getAttribute('href') === '#' + current) {
      a.style.background = 'rgba(255,255,255,0.15)';
      a.style.color = '#fff';
    }
  });
});

// ============================
// NOMOR WA PETUGAS DESA
// Ganti dengan nomor asli (format: 628XXXXXXXXX)
// ============================
const WA_PETUGAS = '6282112345678';

// ============================
// DOWNLOAD FORMULIR
// Karena belum ada file PDF, tampilkan toast info
// Ganti url dengan path file PDF yang sesungguhnya
// ============================
const formulirFiles = {
  domisili  : { name: 'Formulir_Domisili_DesaKeragilan.pdf',   url: 'formulir/formulir_domisili.pdf'   },
  kelahiran : { name: 'Formulir_Kelahiran_DesaKeragilan.pdf',  url: 'formulir/formulir_kelahiran.pdf'  },
  ktpkk     : { name: 'Formulir_KTPKK_DesaKeragilan.pdf',     url: 'formulir/formulir_ktpkk.pdf'      },
  pindah    : { name: 'Formulir_Pindah_DesaKeragilan.pdf',     url: 'formulir/formulir_pindah.pdf'     },
  sku       : { name: 'Formulir_SKU_DesaKeragilan.pdf',        url: 'formulir/formulir_sku.pdf'        },
  sktm      : { name: 'Formulir_SKTM_DesaKeragilan.pdf',       url: 'formulir/formulir_sktm.pdf'       },
  beasiswa  : { name: 'Formulir_Beasiswa_DesaKeragilan.pdf',   url: 'formulir/formulir_beasiswa.pdf'   },
  tanah     : { name: 'Formulir_Tanah_DesaKeragilan.pdf',      url: 'formulir/formulir_tanah.pdf'      },
};

function downloadFormulir(key) {
  const f = formulirFiles[key];
  if (!f) return;

  // Cek apakah file nyata ada — untuk demo tampilkan toast panduan
  // Di produksi: letakkan file PDF di folder /formulir/ lalu ini akan langsung download
  const link = document.createElement('a');
  link.href = f.url;
  link.download = f.name;
  link.click();

  showToast('info', `Mengunduh: ${f.name}`);
}

// ============================
// TOAST NOTIFICATION
// ============================
function showToast(type, msg) {
  let toast = document.getElementById('toastBox');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'toastBox';
    toast.className = 'toast';
    document.body.appendChild(toast);
  }
  const icon = type === 'success' ? 'fa-check-circle' : type === 'info' ? 'fa-info-circle' : 'fa-exclamation-circle';
  toast.className = `toast ${type}`;
  toast.innerHTML = `<i class="fas ${icon}"></i> ${msg}`;
  toast.classList.add('show');
  setTimeout(() => toast.classList.remove('show'), 3500);
}

// ============================
// FORM — FIELD KONDISIONAL
// ============================
function updateFormFields() {
  const jenis = document.getElementById('jenisSurat').value;
  const container = document.getElementById('extra-fields');

  const extraMap = {
    'Surat Keterangan Kelahiran': `
      <div class="form-section-title" style="margin-top:28px;">
        <i class="fas fa-baby"></i> Data Kelahiran
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Nama Bayi <span class="req">*</span></label>
          <input type="text" name="namaBayi" placeholder="Nama lengkap bayi" required />
        </div>
        <div class="form-group">
          <label>Tanggal Lahir Bayi <span class="req">*</span></label>
          <input type="date" name="tglLahirBayi" required />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Jenis Kelamin Bayi <span class="req">*</span></label>
          <select name="jkBayi" required>
            <option value="">-- Pilih --</option>
            <option>Laki-laki</option>
            <option>Perempuan</option>
          </select>
        </div>
        <div class="form-group">
          <label>Nama Bidan / Dokter / RS</label>
          <input type="text" name="namaRs" placeholder="Tempat persalinan" />
        </div>
      </div>`,
    'Surat Keterangan Kematian': `
      <div class="form-section-title" style="margin-top:28px;">
        <i class="fas fa-heart-broken"></i> Data Almarhum/Almarhumah
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Nama Almarhum/Almarhumah <span class="req">*</span></label>
          <input type="text" name="namaAlmarhum" placeholder="Nama lengkap" required />
        </div>
        <div class="form-group">
          <label>Tanggal Meninggal <span class="req">*</span></label>
          <input type="date" name="tglMeninggal" required />
        </div>
      </div>
      <div class="form-group">
        <label>Hubungan Pelapor dengan Almarhum</label>
        <input type="text" name="hubungan" placeholder="Contoh: Anak, Suami/Istri, Saudara" />
      </div>`,
    'Surat Keterangan Pindah': `
      <div class="form-section-title" style="margin-top:28px;">
        <i class="fas fa-plane-departure"></i> Data Kepindahan
      </div>
      <div class="form-group">
        <label>Alamat Tujuan Pindah <span class="req">*</span></label>
        <textarea name="alamatTujuan" rows="2" placeholder="Alamat lengkap tujuan pindah" required></textarea>
      </div>
      <div class="form-group">
        <label>Alasan Pindah</label>
        <input type="text" name="alasanPindah" placeholder="Contoh: Mengikuti suami/istri, pekerjaan, dll" />
      </div>`,
    'Surat Keterangan Usaha (SKU)': `
      <div class="form-section-title" style="margin-top:28px;">
        <i class="fas fa-store"></i> Data Usaha
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Nama Usaha <span class="req">*</span></label>
          <input type="text" name="namaUsaha" placeholder="Nama toko / usaha" required />
        </div>
        <div class="form-group">
          <label>Jenis Usaha <span class="req">*</span></label>
          <input type="text" name="jenisUsaha" placeholder="Contoh: Warung makan, toko kelontong" required />
        </div>
      </div>
      <div class="form-group">
        <label>Alamat Usaha</label>
        <input type="text" name="alamatUsaha" placeholder="Lokasi usaha (jika berbeda dengan alamat KTP)" />
      </div>`,
    'Surat Keterangan Tidak Mampu (SKTM)': `
      <div class="form-section-title" style="margin-top:28px;">
        <i class="fas fa-hand-holding-heart"></i> Data Tambahan SKTM
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Penghasilan per Bulan (Rp)</label>
          <input type="number" name="penghasilan" placeholder="Contoh: 1500000" />
        </div>
        <div class="form-group">
          <label>Jumlah Tanggungan Keluarga</label>
          <input type="number" name="tanggungan" placeholder="Jumlah anggota keluarga" min="1" />
        </div>
      </div>`,
  };

  container.innerHTML = extraMap[jenis] || '';
}

// ============================
// KIRIM VIA WHATSAPP
// ============================
async function kirimWhatsApp(e) {
  e.preventDefault();
  const form = document.getElementById('pengajuanForm');

  const jenis     = form.jenisSurat.value;
  const keperluan = form.keperluan.value;
  const nama      = form.namaLengkap.value;
  const nik       = form.nik.value;
  const ttl       = `${form.tempatLahir.value}, ${formatTanggal(form.tanggalLahir.value)}`;
  const jk        = form.jenisKelamin.value;
  const agama     = form.agama.value;
  const alamat    = form.alamat.value;
  const hp        = form.noHP.value;
  const pekerjaan = form.pekerjaan.value || '-';

  // Validasi NIK
  if (!/^\d{16}$/.test(nik)) {
    showToast('error', 'NIK harus 16 digit angka');
    document.getElementById('nik').classList.add('error');
    document.getElementById('nik').focus();
    return;
  }
  document.getElementById('nik').classList.remove('error');

  const btnSubmit = form.querySelector('button[type="submit"]');
  const originalBtnText = btnSubmit.innerHTML;
  btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
  btnSubmit.disabled = true;

  try {
    const formData = new FormData(form);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    const response = await fetch('/submit-pengajuan', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      },
      body: formData
    });
    
    // Check if the response is actually JSON
    const contentType = response.headers.get("content-type");
    if (!contentType || !contentType.includes("application/json")) {
      throw new TypeError("Oops, we haven't got JSON!");
    }
    
    const result = await response.json();

    if (result.status === 'success') {
      const kode_pengajuan = result.kode_pengajuan || '-';
      
      const pesan =
`*PERMOHONAN SURAT - Desa Kragilan*
━━━━━━━━━━━━━━━━━━━━━━
📄 *Jenis Surat:* ${jenis}
📝 *Keperluan:* ${keperluan}
🏷️ *Kode Pengajuan:* ${kode_pengajuan}

👤 *DATA PEMOHON*
━━━━━━━━━━━━━━━━━━━━━━
• Nama Lengkap : ${nama}
• NIK          : ${nik}
• Tempat/Tgl Lahir : ${ttl}
• Jenis Kelamin : ${jk}
• Agama        : ${agama}
• Pekerjaan    : ${pekerjaan}
• Alamat       : ${alamat}
• No. HP/WA    : ${hp}

_Pesan ini dikirim melalui website Desa Kragilan_`;

      const url = `https://wa.me/${WA_PETUGAS}?text=${encodeURIComponent(pesan)}`;
      window.open(url, '_blank');
      showToast('success', 'Pengajuan berhasil disimpan & WhatsApp dibuka!');
      form.reset();
    } else {
      showToast('error', result.message || 'Gagal menyimpan data.');
    }
  } catch (error) {
    showToast('error', 'Terjadi kesalahan jaringan atau server.');
    console.error(error);
  } finally {
    btnSubmit.innerHTML = originalBtnText;
    btnSubmit.disabled = false;
  }
}

function formatTanggal(val) {
  if (!val) return '-';
  const [y, m, d] = val.split('-');
  const bulan = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  return `${+d} ${bulan[+m]} ${y}`;
}

function resetForm() {
  document.getElementById('extra-fields').innerHTML = '';
  showToast('info', 'Form telah direset');
}

// ============================
// BACK TO TOP BUTTON
// ============================
document.addEventListener('DOMContentLoaded', () => {
  // Buat tombol back-to-top
  const btn = document.createElement('button');
  btn.className = 'back-to-top';
  btn.id = 'backToTop';
  btn.innerHTML = '<i class="fas fa-chevron-up"></i>';
  btn.setAttribute('aria-label', 'Kembali ke atas');
  btn.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
  document.body.appendChild(btn);

  window.addEventListener('scroll', () => {
    btn.classList.toggle('visible', window.scrollY > 400);
  });
});

// ============================
// SEARCH SURAT
// ============================
function searchSuratCards(query) {
  const q = query.toLowerCase().trim();
  const cards = document.querySelectorAll('.surat-card');
  const clearBtn = document.getElementById('searchClear');
  const grid = document.getElementById('suratGrid');
  let found = 0;

  clearBtn.style.display = q ? 'block' : 'none';

  cards.forEach(card => {
    const title = card.querySelector('h3').textContent.toLowerCase();
    const desc  = card.querySelector('p').textContent.toLowerCase();
    const tag   = card.querySelector('.card-tag').textContent.toLowerCase();
    const match = !q || title.includes(q) || desc.includes(q) || tag.includes(q);
    card.classList.toggle('hidden', !match);
    if (match) found++;
  });

  // Hilangkan pesan "tidak ditemukan" lama jika ada
  const noRes = document.getElementById('searchNoResult');
  if (noRes) noRes.remove();

  if (q && found === 0) {
    const msg = document.createElement('div');
    msg.id = 'searchNoResult';
    msg.className = 'search-no-result';
    msg.innerHTML = `<i class="fas fa-search"></i>Surat "<strong>${query}</strong>" tidak ditemukan.<br/><small>Coba kata kunci lain atau hubungi petugas desa.</small>`;
    grid.after(msg);
  }

  // Reset filter button aktif saat search digunakan
  if (q) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    document.querySelector('.filter-btn[data-filter="all"]').classList.add('active');
  }
}

function clearSearch() {
  const input = document.getElementById('searchSurat');
  input.value = '';
  searchSuratCards('');
  input.focus();
}

// ============================
// TRACKING STATUS SURAT
// Data demo — di produksi hubungkan ke backend/spreadsheet
// ============================
const trackingData = {
  'DKG-2025-0001': {
    status: 'selesai',
    jenis: 'Surat Keterangan Domisili',
    nama: 'Budi Santoso',
    tgl: '18 Juli 2025',
    icon: '✅',
    label: 'Selesai – Siap Diambil',
    pesan: 'Surat Anda sudah selesai diproses dan siap diambil di kantor desa. Jam pengambilan: Senin–Jumat 08.00–14.00 WIB.'
  },
  'DKG-2025-0042': {
    status: 'diproses',
    jenis: 'Surat Keterangan Usaha (SKU)',
    nama: 'Siti Rahayu',
    tgl: '20 Juli 2025',
    icon: '🔄',
    label: 'Sedang Diproses',
    pesan: 'Surat Anda sedang dalam proses pembuatan. Estimasi selesai 1–2 hari kerja. Anda akan dihubungi via WhatsApp jika sudah siap.'
  },
  'DKG-2025-0055': {
    status: 'menunggu',
    jenis: 'SKTM',
    nama: 'Ahmad Fauzi',
    tgl: '21 Juli 2025',
    icon: '⏳',
    label: 'Menunggu Verifikasi',
    pesan: 'Pengajuan Anda diterima dan sedang menunggu verifikasi dokumen oleh petugas. Harap tunggu konfirmasi dari kami.'
  },
  'DKG-2025-0063': {
    status: 'ditolak',
    jenis: 'Surat Keterangan Tanah',
    nama: 'Hendra Wijaya',
    tgl: '22 Juli 2025',
    icon: '⚠️',
    label: 'Perlu Kelengkapan Dokumen',
    pesan: 'Pengajuan Anda memerlukan kelengkapan dokumen tambahan. Silakan hubungi petugas via WhatsApp: 0821-1234-5678 untuk informasi lebih lanjut.'
  },
};

function cekStatusSurat() {
  const kode = document.getElementById('trkKode').value.trim().toUpperCase();
  const box = document.getElementById('trkResult');
  if (!kode) { showToast('error', 'Masukkan kode pengajuan terlebih dahulu'); return; }

  const data = trackingData[kode];
  if (!data) {
    box.style.display = 'block';
    box.className = 'trk-result';
    box.innerHTML = `
      <div class="trk-result-header">
        <span class="trk-result-icon">❓</span>
        <div><h4>Kode Tidak Ditemukan</h4></div>
      </div>
      <p>Kode <strong>${kode}</strong> tidak ditemukan dalam sistem kami. Pastikan kode sudah benar atau hubungi petugas via WhatsApp.</p>`;
    return;
  }

  box.style.display = 'block';
  box.className = `trk-result ${data.status}`;
  box.innerHTML = `
    <div class="trk-result-header">
      <span class="trk-result-icon">${data.icon}</span>
      <div>
        <h4>${data.label}</h4>
        <span style="font-size:13px;font-weight:600;color:#1a202c">${data.jenis}</span>
      </div>
    </div>
    <p>${data.pesan}</p>
    <div class="trk-result-meta">
      <span><i class="fas fa-user"></i> ${data.nama}</span>
      <span><i class="fas fa-calendar"></i> ${data.tgl}</span>
      <span><i class="fas fa-hashtag"></i> ${kode}</span>
    </div>`;
  box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function cekStatusNik() {
  const nik = document.getElementById('trkNik').value.trim();
  const box = document.getElementById('trkResult');
  if (!nik || nik.length !== 16 || !/^\d+$/.test(nik)) {
    showToast('error', 'NIK harus 16 digit angka');
    return;
  }
  // Simulasi pencarian berdasarkan NIK (demo)
  box.style.display = 'block';
  box.className = 'trk-result diproses';
  box.innerHTML = `
    <div class="trk-result-header">
      <span class="trk-result-icon">🔄</span>
      <div><h4>Sedang Diproses</h4><span style="font-size:13px;font-weight:600">Surat Keterangan Domisili</span></div>
    </div>
    <p>Pengajuan terakhir Anda sedang dalam proses. Estimasi selesai 1 hari kerja. Anda akan dihubungi via WhatsApp jika sudah siap diambil.</p>
    <div class="trk-result-meta">
      <span><i class="fas fa-id-card"></i> ${nik.substring(0,4)}****${nik.substring(12)}</span>
      <span><i class="fas fa-calendar"></i> 21 Juli 2025</span>
    </div>`;
  box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function switchTrackTab(tab, btn) {
  document.querySelectorAll('.trk-tab').forEach(t => t.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('trk-kode-wrap').style.display = tab === 'kode' ? 'block' : 'none';
  document.getElementById('trk-nik-wrap').style.display  = tab === 'nik'  ? 'block' : 'none';
  document.getElementById('trkResult').style.display = 'none';
}

// ============================
// GALERI LIGHTBOX (simple)
// ============================
const galeriInfo = [
  { title: 'Kantor Desa Kragilan',  desc: 'Gedung Kantor Kepala Desa Kragilan, Kec. Serang' },
  { title: 'Pelayanan Administrasi', desc: 'Petugas melayani warga di loket pelayanan surat' },
  { title: 'Gotong Royong Warga',    desc: 'Kegiatan gotong royong rutin bulanan warga desa' },
  { title: 'Penyerahan Beasiswa',    desc: 'Prosesi penyerahan beasiswa kepada siswa berprestasi' },
  { title: 'Pembangunan Jalan Desa', desc: 'Proyek perbaikan dan pembangunan jalan desa RW 03' },
  { title: 'Penghijauan Lingkungan', desc: 'Program penghijauan dan penanaman pohon di desa' },
];

function showGaleri(idx) {
  const d = galeriInfo[idx];
  const overlay = document.createElement('div');
  overlay.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,0.85);z-index:10000;display:flex;align-items:center;justify-content:center;padding:20px;flex-direction:column;gap:16px;';
  overlay.innerHTML = `
    <button onclick="this.parentElement.remove()" style="position:absolute;top:20px;right:20px;background:rgba(255,255,255,0.2);border:none;color:#fff;width:40px;height:40px;border-radius:50%;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;"><i class="fas fa-times"></i></button>
    <div style="width:100%;max-width:600px;aspect-ratio:4/3;background:linear-gradient(135deg,#1a6b3c,#2d9b61);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:80px;color:rgba(255,255,255,0.5)"><i class="fas fa-image"></i></div>
    <div style="text-align:center;color:#fff"><h3 style="font-size:18px;margin-bottom:6px;">${d.title}</h3><p style="font-size:14px;color:#a8d5b5;">${d.desc}</p></div>
    <p style="font-size:12px;color:#6a9e7a;text-align:center;">Ganti dengan foto asli kegiatan Desa Kragilan</p>`;
  overlay.onclick = e => { if (e.target === overlay) overlay.remove(); };
  document.addEventListener('keydown', function esc(e) { if (e.key === 'Escape') { overlay.remove(); document.removeEventListener('keydown', esc); } });
  document.body.appendChild(overlay);
}

// ============================
// UPDATE WA_PETUGAS sesuai nomor asli
// ============================
// Ganti nilai di bawah ini dengan nomor WhatsApp petugas
// Format: 62 + nomor tanpa 0 di depan
// Contoh: 0821-1234-5678 → '6282112345678'

// ============================
// TESTIMONI FORM
// ============================
(function() {
  const stars = document.querySelectorAll('.star-btn');
  const bintangInput = document.getElementById('testiBintang');
  const testiIsi = document.getElementById('testiIsi');
  const charCount = document.getElementById('charCount');
  const testiForm = document.getElementById('testiForm');
  const testiAlert = document.getElementById('testiAlert');
  const testiBtn = document.getElementById('testiBtn');

  if (!stars.length) return;

  // Star rating interaction
  let selectedStar = 0;
  stars.forEach(star => {
    star.addEventListener('mouseenter', () => {
      const val = parseInt(star.dataset.val);
      stars.forEach((s, i) => s.classList.toggle('active', i < val));
    });
    star.addEventListener('mouseleave', () => {
      stars.forEach((s, i) => s.classList.toggle('active', i < selectedStar));
    });
    star.addEventListener('click', () => {
      selectedStar = parseInt(star.dataset.val);
      bintangInput.value = selectedStar;
      stars.forEach((s, i) => s.classList.toggle('active', i < selectedStar));
    });
  });

  // Character count
  if (testiIsi) {
    testiIsi.addEventListener('input', () => {
      charCount.textContent = testiIsi.value.length;
    });
  }

  // Form submit
  if (testiForm) {
    testiForm.addEventListener('submit', async function(e) {
      e.preventDefault();

      const bintang = parseInt(bintangInput.value);
      if (bintang < 1) {
        showTestiAlert('error', '<i class="fas fa-exclamation-circle"></i> Harap pilih rating bintang terlebih dahulu.');
        return;
      }

      testiBtn.disabled = true;
      testiBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';

      const csrf = document.querySelector('meta[name="csrf-token"]').content;
      const body = new FormData();
      body.append('nama', document.getElementById('testiNama').value);
      body.append('wilayah', document.getElementById('testiWilayah').value);
      body.append('isi', testiIsi.value);
      body.append('bintang', bintang);

      try {
        const res = await fetch('/testimoni', {
          method: 'POST',
          headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
          body: body
        });
        const data = await res.json();

        if (data.status === 'success') {
          showTestiAlert('success', '<i class="fas fa-check-circle"></i> ' + data.message);
          testiForm.reset();
          selectedStar = 0;
          bintangInput.value = 0;
          stars.forEach(s => s.classList.remove('active'));
          charCount.textContent = '0';
        } else {
          showTestiAlert('error', '<i class="fas fa-exclamation-circle"></i> Gagal mengirim. Coba lagi.');
        }
      } catch (err) {
        showTestiAlert('error', '<i class="fas fa-exclamation-circle"></i> Gagal terhubung ke server.');
      } finally {
        testiBtn.disabled = false;
        testiBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim Testimoni';
      }
    });
  }

  function showTestiAlert(type, msg) {
    testiAlert.className = 'form-alert ' + type;
    testiAlert.innerHTML = msg;
    testiAlert.style.display = 'flex';
    setTimeout(() => { testiAlert.style.display = 'none'; }, 6000);
  }
})();
