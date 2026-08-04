<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_surat',
        'keperluan',
        'nama_lengkap',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_perkawinan',
        'alamat',
        'rt',
        'rw',
        'nomor_surat_pengantar',
        'tinggal_di',
        'no_hp',
        'pekerjaan',
        'status',
    ];

    public function chats()
    {
        return $this->hasMany(ChatMessage::class, 'pengajuan_surat_id');
    }

    public function latestChat()
    {
        return $this->hasOne(ChatMessage::class, 'pengajuan_surat_id')->latestOfMany();
    }

    public function unreadChats()
    {
        return $this->hasMany(ChatMessage::class, 'pengajuan_surat_id')
            ->where('sender', 'user')
            ->where('read_by_admin', false);
    }
}
