<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model {
    protected $fillable = ["nama","wilayah","isi","bintang","disetujui"];
    protected $casts = ["disetujui" => "boolean"];
}