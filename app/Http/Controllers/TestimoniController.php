<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Testimoni;

class TestimoniController extends Controller {
    public function store(Request $request) {
        $validated = $request->validate([
            "nama"    => "required|string|max:100",
            "wilayah" => "nullable|string|max:100",
            "isi"     => "required|string|max:500",
            "bintang" => "required|integer|min:1|max:5",
        ]);
        Testimoni::create([
            "nama"      => $validated["nama"],
            "wilayah"   => $validated["wilayah"] ?? "",
            "isi"       => $validated["isi"],
            "bintang"   => $validated["bintang"],
            "disetujui" => false,
        ]);
        return response()->json(["status" => "success", "message" => "Terima kasih! Testimoni Anda sudah kami terima dan akan ditampilkan setelah diverifikasi."]);
    }
}