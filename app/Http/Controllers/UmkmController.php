<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    /**
     * Halaman publik UMKM
     */
    public function index(Request $request)
    {
        $kategori = $request->input('kategori', 'semua');
        $search   = $request->input('search', '');

        $query = Umkm::where('aktif', true)->orderBy('sort_order')->orderBy('nama_usaha');

        if ($kategori && $kategori !== 'semua') {
            $query->where('kategori', $kategori);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_usaha', 'like', "%{$search}%")
                  ->orWhere('pemilik', 'like', "%{$search}%")
                  ->orWhere('produk_unggulan', 'like', "%{$search}%");
            });
        }

        $umkms         = $query->get();
        $kategoriList  = Umkm::kategoriList();
        $totalUmkm     = Umkm::where('aktif', true)->count();

        return view('pages.umkm', compact('umkms', 'kategoriList', 'kategori', 'search', 'totalUmkm'));
    }

    public function show($id)
    {
        $umkm = Umkm::where('aktif', true)->findOrFail($id);
        $kategoriList = Umkm::kategoriList();
        
        return view('pages.umkm-show', compact('umkm', 'kategoriList'));
    }

    // ───────────── ADMIN METHODS ─────────────

    protected function ensureAdmin()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $currentSessionId = session()->getId();
        $activeAdmins = \Illuminate\Support\Facades\Cache::get('admin_active_sessions', []);
        
        if (!isset($activeAdmins[$currentSessionId])) {
            session()->forget(['admin_logged_in', 'admin_name']);
            return redirect()->route('admin.login')->withErrors(['login' => 'Sesi Anda telah berakhir karena batas maksimal 2 admin telah tercapai (login dari perangkat lain).']);
        }

        $activeAdmins[$currentSessionId] = time();
        \Illuminate\Support\Facades\Cache::put('admin_active_sessions', $activeAdmins);

        return null;
    }

    public function adminIndex()
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) return $redirect;

        $umkms        = Umkm::orderBy('sort_order')->orderBy('nama_usaha')->get();
        $kategoriList = Umkm::kategoriList();

        return view('admin.umkm.index', compact('umkms', 'kategoriList'));
    }

    public function adminCreate()
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) return $redirect;

        $kategoriList = Umkm::kategoriList();
        return view('admin.umkm.form', compact('kategoriList'));
    }

    public function adminStore(Request $request)
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) return $redirect;

        $validated = $request->validate([
            'nama_usaha'      => 'required|string|max:255',
            'pemilik'         => 'required|string|max:255',
            'kategori'        => 'required|string|max:50',
            'deskripsi'       => 'nullable|string',
            'alamat'          => 'nullable|string',
            'no_hp'           => 'nullable|string|max:20',
            'instagram'       => 'nullable|string|max:100',
            'facebook'        => 'nullable|string|max:100',
            'produk_unggulan' => 'nullable|string|max:255',
            'jam_buka'        => 'nullable|string|max:100',
            'aktif'           => 'nullable|boolean',
            'sort_order'      => 'nullable|integer|min:0',
            'gambar_utama'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gambar_produk.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['aktif']      = $request->has('aktif');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('umkm', 'public');
        }

        if ($request->hasFile('gambar_produk')) {
            $gambar_produk = [];
            foreach ($request->file('gambar_produk') as $file) {
                $gambar_produk[] = $file->store('umkm/produk', 'public');
            }
            $validated['gambar_produk'] = $gambar_produk;
        }

        Umkm::create($validated);

        return redirect()->route('admin.umkm.index')
                         ->with('success', 'UMKM berhasil ditambahkan.');
    }

    public function adminEdit($id)
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) return $redirect;

        $umkm         = Umkm::findOrFail($id);
        $kategoriList = Umkm::kategoriList();

        return view('admin.umkm.form', compact('umkm', 'kategoriList'));
    }

    public function adminUpdate($id, Request $request)
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) return $redirect;

        $umkm = Umkm::findOrFail($id);

        $validated = $request->validate([
            'nama_usaha'      => 'required|string|max:255',
            'pemilik'         => 'required|string|max:255',
            'kategori'        => 'required|string|max:50',
            'deskripsi'       => 'nullable|string',
            'alamat'          => 'nullable|string',
            'no_hp'           => 'nullable|string|max:20',
            'instagram'       => 'nullable|string|max:100',
            'facebook'        => 'nullable|string|max:100',
            'produk_unggulan' => 'nullable|string|max:255',
            'jam_buka'        => 'nullable|string|max:100',
            'aktif'           => 'nullable|boolean',
            'sort_order'      => 'nullable|integer|min:0',
            'gambar_utama'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gambar_produk.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['aktif']      = $request->has('aktif');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('gambar_utama')) {
            if ($umkm->gambar_utama) {
                Storage::disk('public')->delete($umkm->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('umkm', 'public');
        }

        if ($request->hasFile('gambar_produk')) {
            // Delete old product images
            if ($umkm->gambar_produk) {
                foreach ($umkm->gambar_produk as $old_img) {
                    Storage::disk('public')->delete($old_img);
                }
            }
            
            $gambar_produk = [];
            foreach ($request->file('gambar_produk') as $file) {
                $gambar_produk[] = $file->store('umkm/produk', 'public');
            }
            $validated['gambar_produk'] = $gambar_produk;
        }

        $umkm->update($validated);

        return redirect()->route('admin.umkm.index')
                         ->with('success', 'Data UMKM berhasil diperbarui.');
    }

    public function adminDestroy($id)
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) return $redirect;

        $umkm = Umkm::findOrFail($id);
        
        if ($umkm->gambar_utama) {
            Storage::disk('public')->delete($umkm->gambar_utama);
        }
        if ($umkm->gambar_produk) {
            foreach ($umkm->gambar_produk as $old_img) {
                Storage::disk('public')->delete($old_img);
            }
        }
        
        $umkm->delete();

        return redirect()->route('admin.umkm.index')
                         ->with('success', 'UMKM berhasil dihapus.');
    }

    public function adminToggle($id)
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) return $redirect;

        $umkm = Umkm::findOrFail($id);
        $umkm->update(['aktif' => !$umkm->aktif]);

        return redirect()->route('admin.umkm.index')
                         ->with('success', 'Status UMKM berhasil diubah.');
    }
}
