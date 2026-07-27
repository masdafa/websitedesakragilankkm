<?php

namespace Database\Seeders;

use App\Models\Umkm;
use Illuminate\Database\Seeder;

class UmkmSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_usaha'      => 'Warung Makan Bu Sari',
                'pemilik'         => 'Sari Dewi',
                'kategori'        => 'kuliner',
                'deskripsi'       => 'Warung makan rumahan yang menyajikan masakan Sunda otentik dengan cita rasa tradisional. Menggunakan bahan-bahan segar dari pasar lokal Kragilan.',
                'alamat'          => 'RT 03/RW 01, Kampung Kragilan',
                'no_hp'           => '081211110001',
                'instagram'       => '@warunbusari_kragilan',
                'produk_unggulan' => 'Nasi Liwet, Soto Ayam Kampung',
                'jam_buka'        => 'Setiap hari 07.00 – 20.00',
                'aktif'           => true,
                'sort_order'      => 1,
            ],
            [
                'nama_usaha'      => 'Kerajinan Anyaman Bambu Pak Hendra',
                'pemilik'         => 'Hendra Santoso',
                'kategori'        => 'kerajinan',
                'deskripsi'       => 'Usaha kerajinan anyaman bambu tradisional yang menghasilkan berbagai produk mulai dari tampah, bakul, tas, hingga hiasan dinding. Karya berkualitas tinggi.',
                'alamat'          => 'RT 07/RW 02, Gang Melati',
                'no_hp'           => '081311110002',
                'instagram'       => '@anyaman_bambu_kragilan',
                'produk_unggulan' => 'Tampah, Bakul, Tas Anyaman',
                'jam_buka'        => 'Senin–Sabtu 08.00 – 17.00',
                'aktif'           => true,
                'sort_order'      => 2,
            ],
            [
                'nama_usaha'      => 'Tani Organik Maju Bersama',
                'pemilik'         => 'Kelompok Tani RW 04',
                'kategori'        => 'pertanian',
                'deskripsi'       => 'Kelompok tani organik yang menghasilkan sayuran dan buah-buahan segar bebas pestisida. Tersedia pengiriman ke rumah untuk warga desa.',
                'alamat'          => 'RT 12/RW 04, Lahan Pertanian Blok C',
                'no_hp'           => '081511110003',
                'produk_unggulan' => 'Sayur Organik, Buah Pepaya, Singkong',
                'jam_buka'        => 'Panen Tiap Senin & Kamis',
                'aktif'           => true,
                'sort_order'      => 3,
            ],
            [
                'nama_usaha'      => 'Toko Sembako & ATK Pak Agus',
                'pemilik'         => 'Agus Wahyudi',
                'kategori'        => 'perdagangan',
                'deskripsi'       => 'Toko kelontong lengkap menyediakan kebutuhan sehari-hari, sembako, alat tulis kantor, dan keperluan rumah tangga dengan harga terjangkau.',
                'alamat'          => 'RT 15/RW 05, Depan Masjid Al-Hidayah',
                'no_hp'           => '082111110004',
                'produk_unggulan' => 'Sembako Lengkap, ATK',
                'jam_buka'        => 'Setiap hari 06.00 – 21.00',
                'aktif'           => true,
                'sort_order'      => 4,
            ],
            [
                'nama_usaha'      => 'Salon Kecantikan Nur Hayati',
                'pemilik'         => 'Nur Hayati',
                'kategori'        => 'jasa',
                'deskripsi'       => 'Salon kecantikan lengkap yang menyediakan layanan potong rambut, creambath, perawatan wajah, dan rias pengantin untuk warga Kragilan.',
                'alamat'          => 'RT 09/RW 03, Jl. Kemangi No. 5',
                'no_hp'           => '085611110005',
                'instagram'       => '@salon_nur_kragilan',
                'produk_unggulan' => 'Potong Rambut, Rias Pengantin',
                'jam_buka'        => 'Selasa–Minggu 09.00 – 18.00',
                'aktif'           => true,
                'sort_order'      => 5,
            ],
            [
                'nama_usaha'      => 'Kue & Snack Ibu Ratna',
                'pemilik'         => 'Ratna Sari',
                'kategori'        => 'kuliner',
                'deskripsi'       => 'Usaha rumahan yang memproduksi berbagai kue tradisional dan modern untuk acara hajatan, ulang tahun, arisan, dan pesanan harian.',
                'alamat'          => 'RT 05/RW 01, Gg. Rambutan No. 3',
                'no_hp'           => '089611110006',
                'instagram'       => '@kueratna_kragilan',
                'produk_unggulan' => 'Kue Lapis, Bolu Kukus, Brownies',
                'jam_buka'        => 'Open Order Setiap Hari',
                'aktif'           => true,
                'sort_order'      => 6,
            ],
        ];

        foreach ($data as $item) {
            Umkm::create($item);
        }
    }
}
