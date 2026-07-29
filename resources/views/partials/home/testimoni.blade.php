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
        <p>{!! nl2br(e($siteInfo->contact_address)) !!}</p>
      </div>
      <div class="kontak-card">
        <i class="fas fa-clock"></i>
        <h3>Jam Pelayanan</h3>
        <p>{!! nl2br(e($siteInfo->service_hours)) !!}</p>
      </div>
      <div class="kontak-card">
        <i class="fab fa-whatsapp"></i>
        <h3>WhatsApp</h3>
        <p>{{ $siteInfo->contact_whatsapp }}<br/><small>(Untuk konfirmasi persyaratan & jadwal)</small></p>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteInfo->contact_whatsapp) }}" class="btn btn-primary" style="margin-top:10px;">
          <i class="fab fa-whatsapp"></i> Chat WhatsApp
        </a>
      </div>
      <div class="kontak-card">
        <i class="fas fa-envelope"></i>
        <h3>Email</h3>
        <p>{{ $siteInfo->contact_email }}</p>
      </div>
    </div>
