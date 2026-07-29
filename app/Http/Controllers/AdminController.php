<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\OrgMember;
use App\Models\PengajuanSurat;
use App\Models\SiteInfo;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    protected function ensureAdmin()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return null;
    }

    public function loginForm()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $expectedEmail = env('ADMIN_EMAIL', 'admin@desa.kragilan');
        $expectedPassword = env('ADMIN_PASSWORD', 'admin12345');

        if ($request->email === $expectedEmail && $request->password === $expectedPassword) {
            session([
                'admin_logged_in' => true,
                'admin_name' => 'Admin Desa Kragilan',
            ]);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['login' => 'Email atau password admin tidak sesuai.'])->withInput();
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_name']);

        return redirect()->route('admin.login');
    }

    public function index()
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) {
            return $redirect;
        }

        $stats = [
            'total_pengajuan' => PengajuanSurat::count(),
            'pending' => PengajuanSurat::where('status', 'Pending')->count(),
            'proses' => PengajuanSurat::where('status', 'Proses')->count(),
            'selesai' => PengajuanSurat::where('status', 'Selesai')->count(),
            'testimoni_pending' => Testimoni::where('disetujui', false)->count(),
            'testimoni_approved' => Testimoni::where('disetujui', true)->count(),
            'unread_chat' => ChatMessage::where('sender', 'user')->where('read_by_admin', false)->count(),
        ];

        $pengajuans = PengajuanSurat::latest()->take(8)->get()->map(function ($item) {
            $item->kode_pengajuan = 'DKG-' . date('Y', strtotime($item->created_at)) . '-' . str_pad($item->id, 4, '0', STR_PAD_LEFT);
            return $item;
        });

        $testimonis = Testimoni::latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'pengajuans', 'testimonis'));
    }

    public function submissions(Request $request)
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) {
            return $redirect;
        }

        // ── Polling AJAX: hanya kembalikan jumlah data ──
        if ($request->has('count_only') || $request->ajax()) {
            return response()->json([
                'count'   => PengajuanSurat::count(),
                'pending' => PengajuanSurat::where('status', 'Pending')->count(),
            ]);
        }

        $pengajuans = PengajuanSurat::with(['latestChat', 'unreadChats'])
            ->get()
            ->map(function ($item) {
                $item->kode_pengajuan = 'DKG-' . date('Y', strtotime($item->created_at)) . '-' . str_pad($item->id, 4, '0', STR_PAD_LEFT);
                return $item;
            })
            ->sortByDesc(fn ($item) => $item->latestChat?->created_at ?? $item->created_at)
            ->values();

        return view('admin.submissions', compact('pengajuans'));
    }

    public function updateStatus($id, Request $request)
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) {
            return $redirect;
        }

        $request->validate(['status' => 'required|in:Pending,Proses,Selesai,Ditolak']);

        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->update(['status' => $request->status]);

        return redirect()->route('admin.submissions')->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    public function testimonials()
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) {
            return $redirect;
        }

        $testimonis = Testimoni::latest()->get();

        return view('admin.testimonials', compact('testimonis'));
    }

    public function toggleTestimoni($id)
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) {
            return $redirect;
        }

        $testimoni = Testimoni::findOrFail($id);
        $testimoni->update(['disetujui' => ! $testimoni->disetujui]);

        return redirect()->route('admin.testimonials')->with('success', 'Status testimoni berhasil diperbarui.');
    }

    public function siteSettings()
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) {
            return $redirect;
        }

        if (Schema::hasTable('site_infos')) {
            $siteInfo = SiteInfo::first() ?? SiteInfo::defaults();
        } else {
            $siteInfo = SiteInfo::defaults();
        }

        if (Schema::hasTable('org_members')) {
            $orgMembers = OrgMember::orderBy('sort_order')->get();
        } else {
            $orgMembers = collect();
        }

        return view('admin.site-settings', compact('siteInfo', 'orgMembers'));
    }

    public function updateSiteSettings(Request $request)
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) {
            return $redirect;
        }

        if (! Schema::hasTable('site_infos')) {
            return redirect()->route('admin.site.settings')->with('error', 'Tabel site_infos belum ada. Jalankan php artisan migrate terlebih dahulu.');
        }

        $validated = $request->validate([
            'profile_title' => 'required|string|max:255',
            'profile_subtitle' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'service_page_subtitle' => 'nullable|string',
            'contact_address' => 'nullable|string',
            'contact_phone' => 'nullable|string|max:50',
            'contact_whatsapp' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email|max:255',
            'service_hours' => 'nullable|string',
        ]);

        $siteInfo = SiteInfo::first();
        if (! $siteInfo) {
            SiteInfo::create($validated);
        } else {
            $siteInfo->update($validated);
        }

        return redirect()->route('admin.site.settings')->with('success', 'Pengaturan situs berhasil disimpan.');
    }

    public function storeOrgMember(Request $request)
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) {
            return $redirect;
        }

        if (! Schema::hasTable('org_members')) {
            return redirect()->route('admin.site.settings')->with('error', 'Tabel org_members belum ada. Jalankan php artisan migrate terlebih dahulu.');
        }

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'category'   => 'required|string|max:50',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('org-photos', 'public');
            $validated['photo'] = $path;
        }
        unset($validated['icon']);

        OrgMember::create($validated);

        return redirect()->route('admin.site.settings')->with('success', 'Anggota organisasi berhasil ditambahkan.');
    }

    public function updateOrgMember($id, Request $request)
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) {
            return $redirect;
        }

        if (! Schema::hasTable('org_members')) {
            return redirect()->route('admin.site.settings')->with('error', 'Tabel org_members belum ada. Jalankan php artisan migrate terlebih dahulu.');
        }

        $member = OrgMember::findOrFail($id);
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'category'   => 'required|string|max:50',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($member->photo && \Storage::disk('public')->exists($member->photo)) {
                \Storage::disk('public')->delete($member->photo);
            }
            $validated['photo'] = $request->file('photo')->store('org-photos', 'public');
        } else {
            unset($validated['photo']); // jangan overwrite dengan null
        }

        $member->update($validated);

        return redirect()->route('admin.site.settings')->with('success', 'Anggota organisasi berhasil diperbarui.');
    }

    public function deleteOrgMember($id)
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) {
            return $redirect;
        }

        if (! Schema::hasTable('org_members')) {
            return redirect()->route('admin.site.settings')->with('error', 'Tabel org_members belum ada. Jalankan php artisan migrate terlebih dahulu.');
        }

        $member = OrgMember::findOrFail($id);
        $member->delete();

        return redirect()->route('admin.site.settings')->with('success', 'Anggota organisasi berhasil dihapus.');
    }
}

