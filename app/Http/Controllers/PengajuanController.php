<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use App\Models\Testimoni;

class PengajuanController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::where('disetujui', true)->latest()->take(1)->get();
        $defaultTestimonis = collect([
            ['nama'=>'Ibu Sari Dewi','wilayah'=>'Warga RT 03 / RW 01','isi'=>'Sekarang ngurus surat domisili jauh lebih gampang. Persyaratannya sudah bisa dicek di website dulu, jadi pas datang langsung selesai dalam 1 hari. Pelayanannya ramah!','bintang'=>5],
        ]);
        if ($testimonis->isEmpty()) { $testimonis = $defaultTestimonis; }
        return view('home', compact('testimonis'));
    }

    public function pelayanan()
    {
        return view('pages.pelayanan');
    }

    public function profil()
    {
        return view('pages.profil');
    }

    public function persyaratan()
    {
        return view('pages.persyaratan');
    }

    public function pengajuan()
    {
        return view('pages.pengajuan');
    }

    public function cekStatus()
    {
        return view('pages.cek-status');
    }

    public function searchStatus(Request $request)
    {
        $query = $request->input('query');
        $results = null;

        if ($query) {
            $results = PengajuanSurat::where('nik', $query)
                ->orWhere('id', ltrim(str_replace('DKG-' . date('Y') . '-', '', strtoupper($query)), '0') ?: 0)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($item) {
                    $item->kode_pengajuan = 'DKG-' . date('Y', strtotime($item->created_at)) . '-' . str_pad($item->id, 4, '0', STR_PAD_LEFT);
                    return $item;
                });
        }

        return view('pages.cek-status', compact('results', 'query'));
    }

    public function cetak($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        
        if ($pengajuan->status !== 'Selesai') {
            abort(403, 'Surat belum selesai diproses.');
        }

        $romans = ['','I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];

        return view('pages.cetak-surat', compact('pengajuan', 'romans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenisSurat'   => 'required',
            'keperluan'    => 'required',
            'namaLengkap'  => 'required',
            'nik'          => 'required|numeric|digits:16',
            'tempatLahir'  => 'required',
            'tanggalLahir' => 'required|date',
            'jenisKelamin' => 'required|in:Laki-laki,Perempuan',
            'agama'        => 'required',
            'statusPerkawinan' => 'required',
            'alamat'       => 'required',
            'rt'           => 'required|max:5',
            'rw'           => 'required|max:5',
            'nomorSuratPengantar' => 'required|max:50',
            'tinggalDi'    => 'nullable|max:100',
            'noHP'         => 'required',
            'pekerjaan'    => 'required',
        ]);

        // ─── SECURITY: Validasi NIK wilayah Kecamatan Kragilan ───
        // NIK 16 digit: [2 Prov][2 Kab/Kota][2 Kecamatan][...]
        // 36 = Banten | 04 = Kab. Serang | 11 = Kec. Kragilan → "360411"
        $kodeWilayahKragilan = '360411';
        $nikInput = $validated['nik'];
        if (substr($nikInput, 0, 6) !== $kodeWilayahKragilan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Pengajuan ditolak. NIK tidak terdaftar di Kecamatan Kragilan, Kabupaten Serang, Banten. Layanan ini hanya untuk warga ber-KTP Kec. Kragilan.'
            ], 403);
        }
        // ─── END SECURITY ───


        try {
            $pengajuan = PengajuanSurat::create([
                'jenis_surat'   => $validated['jenisSurat'],
                'keperluan'     => $validated['keperluan'],
                'nama_lengkap'  => $validated['namaLengkap'],
                'nik'           => $validated['nik'],
                'tempat_lahir'  => $validated['tempatLahir'],
                'tanggal_lahir' => $validated['tanggalLahir'],
                'jenis_kelamin' => $validated['jenisKelamin'],
                'agama'         => $validated['agama'],
                'status_perkawinan' => $validated['statusPerkawinan'],
                'alamat'        => $validated['alamat'],
                'rt'            => $validated['rt'],
                'rw'            => $validated['rw'],
                'nomor_surat_pengantar' => $validated['nomorSuratPengantar'],
                'tinggal_di'    => $validated['tinggalDi'],
                'no_hp'         => $validated['noHP'],
                'pekerjaan'     => $validated['pekerjaan'] ?? '-',
            ]);

            $kode_pengajuan = 'DKG-' . date('Y') . '-' . str_pad($pengajuan->id, 4, '0', STR_PAD_LEFT);

            return response()->json([
                'status'         => 'success',
                'message'        => 'Pengajuan berhasil disimpan.',
                'kode_pengajuan' => $kode_pengajuan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }
}
