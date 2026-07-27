<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    protected $fillable = [
        'profile_title',
        'profile_subtitle',
        'vision',
        'mission',
        'service_page_subtitle',
        'contact_address',
        'contact_phone',
        'contact_whatsapp',
        'contact_email',
        'service_hours',
    ];

    public static function defaults()
    {
        return new static([
            'profile_title' => 'Desa Kragilan',
            'profile_subtitle' => 'Website layanan pembuatan surat dan informasi',
            'vision' => '"Terwujudnya Desa Kragilan yang Maju, Mandiri, dan Sejahtera Berbasis Potensi Lokal dengan Tata Kelola Pemerintahan yang Bersih dan Transparan"',
            'mission' => "Meningkatkan kualitas pelayanan administrasi kepada masyarakat\nMengembangkan potensi ekonomi lokal dan UMKM desa\nMeningkatkan kualitas infrastruktur dan fasilitas umum\nMemberdayakan masyarakat melalui pendidikan dan pelatihan\nMewujudkan tata kelola pemerintahan yang transparan dan akuntabel",
            'service_page_subtitle' => 'Temukan jenis surat yang Anda butuhkan dan ajukan secara online',
            'contact_address' => 'Jl. Raya Kragilan No. 01, Desa Kragilan, Kecamatan Kragilan, Kabupaten Serang, Provinsi Banten',
            'contact_phone' => '(0254) 123-4567',
            'contact_whatsapp' => '0821-1234-5678',
            'contact_email' => 'desa@kragilan.go.id',
            'service_hours' => "Senin – Kamis: 08.00 – 14.00 WIB\nJumat: 08.00 – 11.00 WIB\nSabtu – Minggu: Tutup",
        ]);
    }
}
