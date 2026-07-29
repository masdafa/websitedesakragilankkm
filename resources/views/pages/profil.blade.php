@extends('layouts.app')

@section('content')
<div class="page-header" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/bg-hero.jpg') }}') center/cover; padding: 100px 0 60px; text-align: center; color: white;">
    <div class="container">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 10px;">Profil Lengkap Desa Kragilan</h1>
        <p style="font-size: 1.1rem; opacity: 0.9;">Informasi Geografis, Demografis, dan Statistik Desa</p>
    </div>
</div>

<div class="container" style="padding: 60px 15px;">
    
    <!-- Bagian 1: Geografis & Batas Desa -->
    <div class="section-title text-center" style="margin-bottom: 40px;">
        <span style="background:#dcfce7; color:#166534; padding:5px 15px; border-radius:20px; font-weight:600; font-size:14px;">Letak Geografis</span>
        <h2 style="font-size: 2rem; color: #1e293b; margin-top: 10px;">Batas Wilayah & Luas Desa</h2>
    </div>

    <div class="profil-grid">
        <div class="profil-card">
            <div class="card-icon" style="background:#eff6ff; color:#3b82f6;"><i class="fas fa-map"></i></div>
            <h3>Batas Wilayah Administrasi</h3>
            <ul class="info-list">
                <li><span class="label">Sebelah Utara</span><span class="value">Desa Tegal Maja</span></li>
                <li><span class="label">Sebelah Timur</span><span class="value">Sungai Ciujung, Undar Andir</span></li>
                <li><span class="label">Sebelah Selatan</span><span class="value">Desa Kendayakan / Undar Andir</span></li>
                <li><span class="label">Sebelah Barat</span><span class="value">Desa Sentul</span></li>
            </ul>
        </div>
        
        <div class="profil-card">
            <div class="card-icon" style="background:#fef3c7; color:#d97706;"><i class="fas fa-chart-pie"></i></div>
            <h3>Luas Wilayah (371,278 Ha)</h3>
            <ul class="info-list">
                <li><span class="label">Pemukiman</span><span class="value">40,600 Ha</span></li>
                <li><span class="label">Perkantoran</span><span class="value">20,000 Ha</span></li>
                <li><span class="label">Pertanian</span><span class="value">5,000 Ha</span></li>
                <li><span class="label">Industri / Lain-lain</span><span class="value">309,678 Ha</span></li>
            </ul>
        </div>

        <div class="profil-card">
            <div class="card-icon" style="background:#fce7f3; color:#db2777;"><i class="fas fa-sitemap"></i></div>
            <h3>Pembagian Wilayah Kerja</h3>
            <p style="margin-bottom: 15px; color:#64748b; font-size:14.5px;">Desa Kragilan terbagi menjadi 5 RW dan 22 RT dengan rincian:</p>
            <ul class="info-list">
                <li><span class="label">RW 001, 002, 003</span><span class="value">Masing-masing 4 RT</span></li>
                <li><span class="label">RW 004</span><span class="value">6 RT</span></li>
                <li><span class="label">RW 005</span><span class="value">5 RT</span></li>
            </ul>
        </div>
    </div>

    <!-- Bagian 2: Demografi -->
    <div class="section-title text-center" style="margin-top: 80px; margin-bottom: 40px;">
        <span style="background:#e0e7ff; color:#3730a3; padding:5px 15px; border-radius:20px; font-weight:600; font-size:14px;">Kependudukan</span>
        <h2 style="font-size: 2rem; color: #1e293b; margin-top: 10px;">Gambaran Umum Demografis</h2>
        <p style="color:#64748b; margin-top: 10px;">Data Keadaan Penduduk sampai dengan Desember 2025</p>
    </div>

    <div class="demo-stats">
        <div class="stat-box primary">
            <i class="fas fa-users"></i>
            <h4>Total Penduduk</h4>
            <div class="angka">9.828 <span>Jiwa</span></div>
        </div>
        <div class="stat-box">
            <i class="fas fa-home"></i>
            <h4>Kepala Keluarga</h4>
            <div class="angka">3.227 <span>KK</span></div>
        </div>
        <div class="stat-box male">
            <i class="fas fa-male"></i>
            <h4>Laki-laki</h4>
            <div class="angka">4.987 <span>Jiwa</span></div>
        </div>
        <div class="stat-box female">
            <i class="fas fa-female"></i>
            <h4>Perempuan</h4>
            <div class="angka">4.593 <span>Jiwa</span></div>
        </div>
    </div>

    <!-- Charts Data -->
    <div class="charts-grid">
        
        <!-- Pendidikan -->
        <div class="chart-card">
            <h3><i class="fas fa-graduation-cap" style="color:#10b981;"></i> Berdasarkan Pendidikan</h3>
            <div class="bar-item">
                <div class="bar-label"><span>SLA / SMA</span> <span>2.783</span></div>
                <div class="bar-track"><div class="bar-fill" style="width: 100%; background:#10b981;"></div></div>
            </div>
            <div class="bar-item">
                <div class="bar-label"><span>SMP</span> <span>1.714</span></div>
                <div class="bar-track"><div class="bar-fill" style="width: 61%; background:#10b981;"></div></div>
            </div>
            <div class="bar-item">
                <div class="bar-label"><span>SD</span> <span>1.615</span></div>
                <div class="bar-track"><div class="bar-fill" style="width: 58%; background:#10b981;"></div></div>
            </div>
            <div class="bar-item">
                <div class="bar-label"><span>Sarjana</span> <span>389</span></div>
                <div class="bar-track"><div class="bar-fill" style="width: 14%; background:#10b981;"></div></div>
            </div>
            <div class="bar-item">
                <div class="bar-label"><span>Tidak Selesai</span> <span>342</span></div>
                <div class="bar-track"><div class="bar-fill" style="width: 12%; background:#10b981;"></div></div>
            </div>
            <div class="bar-item">
                <div class="bar-label"><span>D1 dan D2</span> <span>42</span></div>
                <div class="bar-track"><div class="bar-fill" style="width: 2%; background:#10b981;"></div></div>
            </div>
        </div>

        <!-- Agama -->
        <div class="chart-card">
            <h3><i class="fas fa-praying-hands" style="color:#f59e0b;"></i> Berdasarkan Agama</h3>
            <div class="bar-item">
                <div class="bar-label"><span>Islam</span> <span>9.762</span></div>
                <div class="bar-track"><div class="bar-fill" style="width: 100%; background:#f59e0b;"></div></div>
            </div>
            <div class="bar-item">
                <div class="bar-label"><span>Kristen/Protestan</span> <span>54</span></div>
                <div class="bar-track"><div class="bar-fill" style="width: 3%; background:#f59e0b;"></div></div>
            </div>
            <div class="bar-item">
                <div class="bar-label"><span>Budha</span> <span>7</span></div>
                <div class="bar-track"><div class="bar-fill" style="width: 1%; background:#f59e0b;"></div></div>
            </div>
            <div class="bar-item">
                <div class="bar-label"><span>Hindu</span> <span>4</span></div>
                <div class="bar-track"><div class="bar-fill" style="width: 1%; background:#f59e0b;"></div></div>
            </div>
            <div class="bar-item">
                <div class="bar-label"><span>Khatolik</span> <span>1</span></div>
                <div class="bar-track"><div class="bar-fill" style="width: 1%; background:#f59e0b;"></div></div>
            </div>
        </div>

        <!-- Kelompok Usia -->
        <div class="chart-card" style="grid-column: 1 / -1;">
            <h3><i class="fas fa-chart-bar" style="color:#6366f1;"></i> Berdasarkan Kelompok Usia</h3>
            <div class="age-grid">
                <div class="age-item">
                    <span class="age-range">05-09</span>
                    <div class="age-bar"><div class="age-fill" style="height: 97%;"></div></div>
                    <span class="age-count">886</span>
                </div>
                <div class="age-item">
                    <span class="age-range">10-14</span>
                    <div class="age-bar"><div class="age-fill" style="height: 100%;"></div></div>
                    <span class="age-count">906</span>
                </div>
                <div class="age-item">
                    <span class="age-range">15-19</span>
                    <div class="age-bar"><div class="age-fill" style="height: 81%;"></div></div>
                    <span class="age-count">736</span>
                </div>
                <div class="age-item">
                    <span class="age-range">20-24</span>
                    <div class="age-bar"><div class="age-fill" style="height: 93%;"></div></div>
                    <span class="age-count">846</span>
                </div>
                <div class="age-item">
                    <span class="age-range">25-29</span>
                    <div class="age-bar"><div class="age-fill" style="height: 83%;"></div></div>
                    <span class="age-count">756</span>
                </div>
                <div class="age-item">
                    <span class="age-range">30-34</span>
                    <div class="age-bar"><div class="age-fill" style="height: 79%;"></div></div>
                    <span class="age-count">723</span>
                </div>
                <div class="age-item">
                    <span class="age-range">35-39</span>
                    <div class="age-bar"><div class="age-fill" style="height: 87%;"></div></div>
                    <span class="age-count">794</span>
                </div>
                <div class="age-item">
                    <span class="age-range">40-44</span>
                    <div class="age-bar"><div class="age-fill" style="height: 93%;"></div></div>
                    <span class="age-count">845</span>
                </div>
                <div class="age-item">
                    <span class="age-range">45-49</span>
                    <div class="age-bar"><div class="age-fill" style="height: 92%;"></div></div>
                    <span class="age-count">835</span>
                </div>
                <div class="age-item">
                    <span class="age-range">50-54</span>
                    <div class="age-bar"><div class="age-fill" style="height: 66%;"></div></div>
                    <span class="age-count">606</span>
                </div>
                <div class="age-item">
                    <span class="age-range">55-59</span>
                    <div class="age-bar"><div class="age-fill" style="height: 54%;"></div></div>
                    <span class="age-count">495</span>
                </div>
                <div class="age-item">
                    <span class="age-range">60-64</span>
                    <div class="age-bar"><div class="age-fill" style="height: 33%;"></div></div>
                    <span class="age-count">303</span>
                </div>
                <div class="age-item">
                    <span class="age-range">65-69</span>
                    <div class="age-bar"><div class="age-fill" style="height: 20%;"></div></div>
                    <span class="age-count">188</span>
                </div>
                <div class="age-item">
                    <span class="age-range">70-74</span>
                    <div class="age-bar"><div class="age-fill" style="height: 16%;"></div></div>
                    <span class="age-count">150</span>
                </div>
                <div class="age-item">
                    <span class="age-range">75+</span>
                    <div class="age-bar"><div class="age-fill" style="height: 15%;"></div></div>
                    <span class="age-count">136</span>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    /* Styling khusus profil */
    .profil-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
    }
    .profil-card {
        background: #fff;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid #f1f5f9;
        transition: transform 0.3s ease;
    }
    .profil-card:hover {
        transform: translateY(-5px);
    }
    .card-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 20px;
    }
    .profil-card h3 {
        font-size: 1.1rem;
        color: #0f172a;
        margin-bottom: 15px;
        font-weight: 700;
    }
    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .info-list li {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px dashed #e2e8f0;
        font-size: 14.5px;
    }
    .info-list li:last-child {
        border-bottom: none;
    }
    .info-list .label {
        color: #64748b;
    }
    .info-list .value {
        font-weight: 600;
        color: #334155;
        text-align: right;
    }

    /* Demografi */
    .demo-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }
    .stat-box {
        background: #fff;
        padding: 25px 20px;
        border-radius: 16px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #f1f5f9;
    }
    .stat-box i {
        font-size: 28px;
        color: #64748b;
        margin-bottom: 15px;
    }
    .stat-box.primary i { color: #16a34a; }
    .stat-box.male i { color: #3b82f6; }
    .stat-box.female i { color: #ec4899; }
    .stat-box h4 {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 8px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .stat-box .angka {
        font-size: 2rem;
        font-weight: 800;
        color: #0f172a;
    }
    .stat-box .angka span {
        font-size: 14px;
        color: #94a3b8;
        font-weight: 500;
    }

    /* Charts Grid */
    .charts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 25px;
    }
    .chart-card {
        background: #fff;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid #f1f5f9;
    }
    .chart-card h3 {
        font-size: 1.1rem;
        margin-bottom: 25px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .bar-item { margin-bottom: 15px; }
    .bar-label {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 6px;
    }
    .bar-track {
        background: #f1f5f9;
        height: 8px;
        border-radius: 10px;
        overflow: hidden;
    }
    .bar-fill {
        height: 100%;
        border-radius: 10px;
        transition: width 1s ease-out;
    }

    .age-grid {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        height: 250px;
        padding-top: 20px;
        gap: 8px;
    }
    .age-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        height: 100%;
        justify-content: flex-end;
    }
    .age-count {
        font-size: 11px;
        font-weight: 700;
        color: #475569;
        margin-bottom: 5px;
    }
    .age-bar {
        width: 100%;
        max-width: 30px;
        background: #f1f5f9;
        height: 150px;
        border-radius: 6px 6px 0 0;
        position: relative;
        display: flex;
        align-items: flex-end;
        justify-content: center;
    }
    .age-fill {
        width: 100%;
        background: #6366f1;
        border-radius: 6px 6px 0 0;
        transition: height 1s ease-out;
    }
    .age-range {
        font-size: 10px;
        color: #64748b;
        margin-top: 8px;
        text-align: center;
    }
    @media(max-width: 768px) {
        .age-grid { overflow-x: auto; padding-bottom: 10px; }
        .age-item { min-width: 35px; }
    }
</style>
@endsection
