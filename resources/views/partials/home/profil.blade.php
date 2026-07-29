<!-- ==============================
     PROFIL DESA
================================ -->
<section class="section" id="profil">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Profil Desa</span>
      <h2>{{ $siteInfo->profile_title }}</h2>
      <p>{{ $siteInfo->profile_subtitle }}</p>
    </div>
    <div class="profil-visimisi">
      <div class="visimisi-card visi">
        <div class="visimisi-icon"><i class="fas fa-eye"></i></div>
        <h3>Visi</h3>
        <p>{!! nl2br(e($siteInfo->vision)) !!}</p>
      </div>
      <div class="visimisi-card misi">
        <div class="visimisi-icon"><i class="fas fa-bullseye"></i></div>
        <h3>Misi</h3>
        <ul>
          @foreach(explode("\n", $siteInfo->mission) as $mission)
            @if(trim($mission))
              <li><i class="fas fa-check"></i> {{ trim($mission) }}</li>
            @endif
          @endforeach
        </ul>
      </div>
    </div>
    
    <div style="text-align: center; margin-top: 40px;">
        <a href="{{ route('profil') }}" class="btn btn-primary" style="padding: 12px 24px; font-size: 16px; border-radius: 8px;">
            <i class="fas fa-arrow-right"></i> Lihat Data & Profil Lengkap Desa
        </a>
    </div>

  </div>
</section>
