<div align="center">

# 🏛️ Website Desa Kragilan
### Sistem Informasi & Pelayanan Administrasi Desa

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![SQLite](https://img.shields.io/badge/SQLite-Database-003B57?style=for-the-badge&logo=sqlite&logoColor=white)](https://sqlite.org)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

> Website resmi pelayanan administrasi surat Desa Kragilan, Kecamatan Kragilan, Kabupaten Serang, Provinsi Banten.

</div>

---

## 📋 Tentang Proyek

Website ini dikembangkan sebagai sistem informasi desa yang memungkinkan warga untuk mengakses layanan administrasi secara online. Dibangun sebagai bagian dari program **KKM Kelompok 35 – Universitas Bina Bangsa**.

### ✨ Fitur Utama

| Fitur | Deskripsi |
|-------|-----------|
| 📄 **Pengajuan Surat Online** | Warga dapat mengajukan berbagai surat keterangan secara online |
| 🔍 **Cek Status Pengajuan** | Pantau progress surat yang sedang diproses |
| 💬 **Live Chat** | Komunikasi langsung antara warga dan petugas |
| 🏪 **UMKM Desa** | Direktori usaha mikro kecil menengah di desa |
| ⭐ **Testimoni** | Ulasan warga tentang pelayanan desa |
| 🗺️ **Lokasi Kantor** | Peta interaktif lokasi kantor desa |
| 🔐 **Panel Admin** | Manajemen pengajuan, UMKM, dan konten website |
| 📱 **Responsive** | Tampilan optimal di semua perangkat |

---

## 🛠️ Tech Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Database:** SQLite
- **Frontend:** Blade Template, Vanilla CSS, JavaScript
- **Icons:** Font Awesome 6
- **Fonts:** Plus Jakarta Sans (Google Fonts)
- **Maps:** Google Maps Embed

---

## ⚙️ Persyaratan Sistem

Pastikan komputer Anda sudah terinstall:

- ✅ **PHP** versi **8.2** atau lebih baru → [Download PHP](https://www.php.net/downloads)
- ✅ **Composer** → [Download Composer](https://getcomposer.org/download/)
- ✅ **Git** → [Download Git](https://git-scm.com/downloads)
- ✅ **Node.js & npm** (opsional, untuk asset building) → [Download Node.js](https://nodejs.org)

Cek versi yang terinstall:
```bash
php --version
composer --version
git --version
node --version
```

---

## 🚀 Cara Clone & Instalasi

### 1️⃣ Clone Repository

```bash
git clone https://github.com/USERNAME/NAMA-REPO.git
cd NAMA-REPO
```

> 💡 Ganti `USERNAME` dan `NAMA-REPO` sesuai dengan URL repository GitHub Anda.

---

### 2️⃣ Install Dependency PHP

```bash
composer install
```

---

### 3️⃣ Buat File `.env`

Salin file konfigurasi contoh:

```bash
cp .env.example .env
```

> **Windows (Command Prompt):**
> ```cmd
> copy .env.example .env
> ```

---

### 4️⃣ Generate Application Key

```bash
php artisan key:generate
```

---

### 5️⃣ Buat Database SQLite

Buat file database SQLite kosong:

```bash
# Linux / macOS
touch database/database.sqlite

# Windows (PowerShell)
New-Item -Path "database/database.sqlite" -ItemType File
```

Pastikan file `.env` menggunakan SQLite:

```env
DB_CONNECTION=sqlite
# DB_HOST, DB_PORT, DB_DATABASE, dst. tidak perlu diisi untuk SQLite
```

---

### 6️⃣ Jalankan Migrasi Database

```bash
php artisan migrate
```

Jika ingin mengisi data awal (seeder):

```bash
php artisan db:seed
```

---

### 7️⃣ Konfigurasi Storage

```bash
php artisan storage:link
```

---

### 8️⃣ Jalankan Server

```bash
php artisan serve
```

Buka browser dan akses: **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## 🔑 Akses Admin Panel

Akses panel admin di: **[http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin)**

| Field | Default |
|-------|---------|
| Username | `admin` |
| Password | `admin123` |

> ⚠️ Segera ganti password setelah login pertama kali!

---

## 📁 Struktur Direktori Penting

```
laravel-desa-kragilan/
├── app/
│   ├── Http/Controllers/     # Controller aplikasi
│   └── Models/               # Model database
├── database/
│   ├── migrations/           # Skema tabel database
│   ├── seeders/              # Data awal
│   └── database.sqlite       # File database SQLite
├── public/
│   └── assets/
│       ├── css/style.css     # Stylesheet utama
│       ├── js/script.js      # JavaScript utama
│       └── images/           # Gambar & logo
├── resources/
│   └── views/
│       ├── layouts/          # Template layout utama
│       ├── pages/            # Halaman publik
│       ├── admin/            # Halaman admin panel
│       └── home.blade.php    # Halaman beranda
└── routes/
    └── web.php               # Definisi route
```

---

## 🖼️ Halaman Website

| Halaman | URL | Deskripsi |
|---------|-----|-----------|
| Beranda | `/` | Halaman utama dengan info desa |
| Pelayanan | `/pelayanan` | Daftar layanan surat tersedia |
| Persyaratan | `/persyaratan` | Persyaratan pengajuan surat |
| Pengajuan | `/pengajuan` | Form pengajuan surat online |
| Cek Status | `/cek-status` | Cek status pengajuan |
| UMKM | `/umkm` | Direktori UMKM desa |
| Admin Login | `/admin/login` | Halaman login admin |
| Admin Panel | `/admin` | Dashboard admin |

---

## 🐛 Troubleshooting

**Error: `No application encryption key has been specified`**
```bash
php artisan key:generate
```

**Error: `SQLSTATE[HY000] [14] unable to open database file`**
```bash
# Pastikan file database.sqlite ada
touch database/database.sqlite   # Linux/macOS
New-Item database/database.sqlite -ItemType File  # Windows
```

**Error: `Class not found` atau autoload issue**
```bash
composer dump-autoload
```

**Cache bermasalah**
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

---

## 👥 Tim Pengembang

Dikembangkan dengan ❤️ oleh **KKM Kelompok 35 – Universitas Bina Bangsa**

---

## 📍 Informasi Desa

**Kantor Desa Kragilan**
📌 Jl. Raya Kragilan No. 01, Desa Kragilan, Kecamatan Kragilan, Kabupaten Serang, Provinsi Banten
🕐 Senin – Kamis: 08.00 – 14.00 WIB
📞 082320931103
📧 desa@kragilan.go.id

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

<div align="center">
  <sub>© 2025 Pemerintah Desa Kragilan. Dibuat dengan ❤️ untuk pelayanan warga.</sub>
</div>
