<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrgMember extends Model
{
    protected $fillable = [
        'name',
        'position',
        'category',
        'icon',
        'photo',
        'sort_order',
    ];

    public static function defaults()
    {
        return collect([
            new static(['name' => 'Budy Cahyadi, S.Sos', 'position' => 'Pj. Kepala Desa', 'category' => 'kepala', 'icon' => 'fa-user-tie', 'sort_order' => 1]),
            new static(['name' => 'BPD', 'position' => 'Badan Permusyawaratan Desa', 'category' => 'bpd', 'icon' => 'fa-landmark', 'sort_order' => 2]),
            new static(['name' => 'Elzan Haerul Yahya', 'position' => 'Sekretaris Desa', 'category' => 'sekretaris', 'icon' => 'fa-user', 'sort_order' => 3]),
            new static(['name' => 'Suherman', 'position' => 'Kaur Tata Usaha & Umum', 'category' => 'kaur', 'icon' => 'fa-desktop', 'sort_order' => 4]),
            new static(['name' => 'Vanesa Adni', 'position' => 'Kaur Keuangan', 'category' => 'kaur', 'icon' => 'fa-coins', 'sort_order' => 5]),
            new static(['name' => 'Aspari', 'position' => 'Kaur Perencanaan', 'category' => 'kaur', 'icon' => 'fa-chart-bar', 'sort_order' => 6]),
            new static(['name' => 'Ipa Fita Hidayani', 'position' => 'Kasi Pemerintahan', 'category' => 'kasi', 'icon' => 'fa-file-invoice', 'sort_order' => 7]),
            new static(['name' => 'Arif Kurniawan', 'position' => 'Kasi Pelayanan', 'category' => 'kasi', 'icon' => 'fa-concierge-bell', 'sort_order' => 8]),
            new static(['name' => 'M. Fauzi Al Ghifari', 'position' => 'Kasi Kesejahteraan', 'category' => 'kasi', 'icon' => 'fa-hands-helping', 'sort_order' => 9]),
            new static(['name' => 'Kampung / RT / RW', 'position' => 'Tingkat Kampung', 'category' => 'kampung', 'icon' => 'fa-home', 'sort_order' => 10]),
        ]);
    }
}
