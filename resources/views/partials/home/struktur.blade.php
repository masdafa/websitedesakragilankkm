    <!-- STRUKTUR ORGANISASI -->
    <div id="struktur-org" class="section-header" style="margin-top:60px; margin-bottom:36px;">
      <span class="section-tag">Struktur Organisasi</span>
      <h2>Perangkat Desa Kragilan</h2>
    </div>
    <div class="struktur-wrap">
      @php
        $kepala     = $orgMembers->firstWhere('category', 'kepala');
        $bpd        = $orgMembers->firstWhere('category', 'bpd');
        $sekretaris = $orgMembers->firstWhere('category', 'sekretaris');
        $kaurs      = $orgMembers->where('category', 'kaur');
        $kasis      = $orgMembers->where('category', 'kasi');
        $kampung    = $orgMembers->firstWhere('category', 'kampung');
      @endphp

      <style>
      /* CSS Tree Chart */
      .tree-chart {
        display: flex;
        justify-content: center;
        overflow-x: auto;
        padding-bottom: 20px;
        margin-top: 20px;
      }
      .tree-chart ul {
        padding-top: 20px;
        position: relative;
        transition: all 0.5s;
        display: flex;
        justify-content: center;
        padding-left: 0;
      }
      .tree-chart li {
        float: left;
        text-align: center;
        list-style-type: none;
        position: relative;
        padding: 20px 10px 0 10px;
        transition: all 0.5s;
      }
      /* Connectors */
      .tree-chart li::before, .tree-chart li::after {
        content: '';
        position: absolute;
        top: 0;
        right: 50%;
        border-top: 2px solid #16a34a;
        width: 50%;
        height: 20px;
      }
      .tree-chart li::after {
        right: auto;
        left: 50%;
        border-left: 2px solid #16a34a;
      }
      /* Remove left-right connectors from elements without any siblings */
      .tree-chart li:only-child::after, .tree-chart li:only-child::before {
        display: none;
      }
      /* Remove space from the top of single children */
      .tree-chart li:only-child {
        padding-top: 0;
      }
      /* Remove left connector from first child and right connector from last child */
      .tree-chart li:first-child::before, .tree-chart li:last-child::after {
        border: 0 none;
      }
      /* Adding back the vertical connector to the last nodes */
      .tree-chart li:last-child::before {
        border-right: 2px solid #16a34a;
        border-radius: 0 5px 0 0;
      }
      .tree-chart li:first-child::after {
        border-radius: 5px 0 0 0;
      }
      /* Downward connectors from parents */
      .tree-chart ul ul::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        border-left: 2px solid #16a34a;
        width: 0;
        height: 20px;
        margin-left: -1px;
      }

      /* Card Styling */
      .oc-card {
        background:#fff; border-radius:12px;
        padding:14px 12px 12px; text-align:center;
        box-shadow:0 3px 16px rgba(0,0,0,.10);
        display:inline-flex; flex-direction:column; align-items:center;
        width:140px; flex-shrink:0;
        position: relative;
        z-index: 10;
        margin: 0 auto;
      }
      .oc-card.kepala    { border-top:4px solid #16a34a; width: 160px; }
      .oc-card.bpd       { border-top:4px solid #e11d48; width:140px; position: absolute; left: 100%; top: 0; margin-left: 40px; }
      .oc-card.sek       { border-top:4px solid #2563eb; width:155px; }
      .oc-card.kasi      { border-top:4px solid #d97706; width:130px; }
      .oc-card.kaur      { border-top:4px solid #7c3aed; width:130px; }
      .oc-card.kampung-c {
        border-top:4px solid #0f2e1a; background:#0f2e1a; color:#fff;
        width:auto; padding:14px 32px; border-radius:10px;
        font-size:16px; font-weight:800; letter-spacing:2px;
      }

      /* BPD Dashed Line */
      .bpd-connector {
        position: absolute;
        width: 40px;
        border-top: 2px dashed #94a3b8;
        top: 40px;
        right: -40px;
        z-index: 5;
      }

      .oc-ico {
        width:52px; height:52px; border-radius:50%;
        display:flex; align-items:center; justify-content:center;
        font-size:18px; color:#fff; margin-bottom:8px; flex-shrink:0;
        overflow:hidden; border:3px solid #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
      }
      .oc-ico img { width:100%; height:100%; object-fit:cover; }
      .kepala .oc-ico { background:linear-gradient(135deg,#14532d,#22c55e); }
      .bpd    .oc-ico { background:linear-gradient(135deg,#9f1239,#e11d48); }
      .sek    .oc-ico { background:linear-gradient(135deg,#1e3a8a,#3b82f6); }
      .kasi   .oc-ico { background:linear-gradient(135deg,#92400e,#f59e0b); }
      .kaur   .oc-ico { background:linear-gradient(135deg,#5b21b6,#a78bfa); }

      .oc-name { font-size:12px; font-weight:700; color:#0f172a; line-height:1.3; margin-bottom:3px; }
      .oc-pos  { font-size:10.5px; color:#64748b; }
      
      /* Color overrides for specific branches */
      .tree-chart li.sek-branch::before, .tree-chart li.sek-branch::after { border-color: #2563eb; }
      .tree-chart li.sek-branch:last-child::before { border-right-color: #2563eb; }
      .tree-chart li.sek-branch > ul::before { border-left-color: #2563eb; }
      
      .tree-chart li.kasi-branch::before, .tree-chart li.kasi-branch::after { border-color: #d97706; }
      .tree-chart li.kasi-branch:last-child::before { border-right-color: #d97706; }
      
      .tree-chart li.kaur-node::before, .tree-chart li.kaur-node::after { border-color: #7c3aed; }
      .tree-chart li.kaur-node:last-child::before { border-right-color: #7c3aed; }
      </style>

      <div class="tree-chart">
        <ul>
          <li>
            @if($kepala)
            <div style="position: relative; display: inline-block;">
              <div class="oc-card kepala">
                <div class="oc-ico">
                  @if($kepala->photo)
                    <img src="{{ asset('storage/'.$kepala->photo) }}" alt="{{ $kepala->name }}">
                  @else
                    <i class="fas fa-user-tie"></i>
                  @endif
                </div>
                <div class="oc-name">{{ $kepala->name }}</div>
                <div class="oc-pos">{{ $kepala->position }}</div>
              </div>
              
              @if($bpd)
              <div class="bpd-connector"></div>
              <div class="oc-card bpd">
                <div class="oc-ico">
                  @if($bpd->photo)
                    <img src="{{ asset('storage/'.$bpd->photo) }}" alt="{{ $bpd->name }}">
                  @else
                    <i class="fas fa-landmark"></i>
                  @endif
                </div>
                <div class="oc-name">{{ $bpd->name }}</div>
                <div class="oc-pos">{{ $bpd->position }}</div>
              </div>
              @endif
            </div>
            @endif

            <ul>
              {{-- Kasi Branch --}}
              @if($kasis->count() > 0)
              <li class="kasi-branch">
                {{-- Group node for Kasi --}}
                <div style="padding: 10px; font-size: 11px; font-weight: bold; color: #d97706; border: 1px solid #d97706; border-radius: 20px; background: #fffaf0; display: inline-block; margin-bottom: 20px;">
                  Kepala Seksi
                </div>
                <ul>
                  @foreach($kasis as $kasi)
                  <li class="kasi-branch">
                    <div class="oc-card kasi">
                      <div class="oc-ico">
                        @if($kasi->photo)
                          <img src="{{ asset('storage/'.$kasi->photo) }}" alt="{{ $kasi->name }}">
                        @else
                          <i class="fas fa-file-invoice"></i>
                        @endif
                      </div>
                      <div class="oc-name">{{ $kasi->name }}</div>
                      <div class="oc-pos">{{ $kasi->position }}</div>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </li>
              @endif

              {{-- Sekretaris Branch --}}
              @if($sekretaris || $kaurs->count() > 0)
              <li class="sek-branch">
                @if($sekretaris)
                <div class="oc-card sek">
                  <div class="oc-ico">
                    @if($sekretaris->photo)
                      <img src="{{ asset('storage/'.$sekretaris->photo) }}" alt="{{ $sekretaris->name }}">
                    @else
                      <i class="fas fa-user"></i>
                    @endif
                  </div>
                  <div class="oc-name">{{ $sekretaris->name }}</div>
                  <div class="oc-pos">{{ $sekretaris->position }}</div>
                </div>
                @endif
                
                @if($kaurs->count() > 0)
                <ul>
                  @foreach($kaurs as $kaur)
                  <li class="kaur-node">
                    <div class="oc-card kaur">
                      <div class="oc-ico">
                        @if($kaur->photo)
                          <img src="{{ asset('storage/'.$kaur->photo) }}" alt="{{ $kaur->name }}">
                        @else
                          <i class="fas fa-desktop"></i>
                        @endif
                      </div>
                      <div class="oc-name">{{ $kaur->name }}</div>
                      <div class="oc-pos">{{ $kaur->position }}</div>
                    </div>
                  </li>
                  @endforeach
                </ul>
                @endif
                
                {{-- Kampung under Sekretaris? Or under Kepala? Usually Kampung is under Sekretaris/Kepala --}}
                @if($kampung)
                <ul>
                  <li>
                    <div class="oc-card kampung-c" style="margin-top: 10px;">
                      <i class="fas fa-home" style="margin-right:8px;"></i>{{ $kampung->name ?: 'KAMPUNG' }}
                    </div>
                  </li>
                </ul>
                @endif
              </li>
              @endif
              
            </ul>
          </li>
        </ul>
      </div>

      {{-- Legenda --}}
      <div style="display:flex; gap:18px; flex-wrap:wrap; justify-content:center; margin-top:26px; padding-top:16px; border-top:1px solid #e2e8f0; font-size:11.5px; color:#64748b;">
        <span><span style="display:inline-block; width:26px; border-top:2px dashed #94a3b8; vertical-align:middle; margin-right:4px;"></span>Garis Konsultasi</span>
        <span><span style="display:inline-block; width:26px; border-top:2px solid #16a34a; vertical-align:middle; margin-right:4px;"></span>Garis Komando</span>
      </div>
    </div>
