<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Umkm extends Model
{
    protected $fillable = [
        'nama_usaha',
        'pemilik',
        'kategori',
        'deskripsi',
        'alamat',
        'no_hp',
        'instagram',
        'facebook',
        'produk_unggulan',
        'gambar_utama',
        'gambar_produk',
        'jam_buka',
        'aktif',
        'sort_order',
    ];

    protected $casts = [
        'aktif'         => 'boolean',
        'gambar_produk' => 'array',
    ];

    /**
     * URL gambar utama (atau placeholder jika kosong)
     */
    public function getGambarUtamaUrlAttribute(): string
    {
        if ($this->gambar_utama && Storage::disk('public')->exists($this->gambar_utama)) {
            return Storage::url($this->gambar_utama);
        }
        return '';
    }

    /**
     * Array URL gambar produk
     */
    public function getGambarProdukUrlsAttribute(): array
    {
        if (empty($this->gambar_produk)) {
            return [];
        }
        return collect($this->gambar_produk)
            ->filter(fn($p) => Storage::disk('public')->exists($p))
            ->map(fn($p) => Storage::url($p))
            ->values()
            ->toArray();
    }

    public static function kategoriList(): array
    {
        return [
            'kuliner'     => ['label' => 'Kuliner',    'icon' => 'fa-utensils',  'color' => '#f59e0b'],
            'kerajinan'   => ['label' => 'Kerajinan',  'icon' => 'fa-hands',     'color' => '#8b5cf6'],
            'pertanian'   => ['label' => 'Pertanian',  'icon' => 'fa-seedling',  'color' => '#10b981'],
            'perdagangan' => ['label' => 'Perdagangan','icon' => 'fa-store',     'color' => '#3b82f6'],
            'jasa'        => ['label' => 'Jasa',       'icon' => 'fa-briefcase', 'color' => '#ec4899'],
            'lainnya'     => ['label' => 'Lainnya',    'icon' => 'fa-ellipsis-h','color' => '#6b7280'],
        ];
    }
}
