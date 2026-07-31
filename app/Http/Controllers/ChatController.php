<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
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

    public function showConversation($id)
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) {
            return $redirect;
        }

        $pengajuan = PengajuanSurat::with('chats')->findOrFail($id);
        $pengajuan->kode_pengajuan = 'DKG-' . date('Y', strtotime($pengajuan->created_at)) . '-' . str_pad($pengajuan->id, 4, '0', STR_PAD_LEFT);

        $pengajuan->chats()->where('sender', 'user')->where('read_by_admin', false)->update(['read_by_admin' => true]);

        return view('admin.chat', compact('pengajuan'));
    }

    public function storeMessage($id, Request $request)
    {
        $redirect = $this->ensureAdmin();
        if ($redirect) {
            return $redirect;
        }

        $request->validate(['message' => 'required|string|max:1000']);

        $pengajuan = PengajuanSurat::findOrFail($id);

        ChatMessage::create([
            'pengajuan_surat_id' => $pengajuan->id,
            'sender' => 'admin',
            'message' => $request->message,
        ]);

        return redirect()->route('admin.chat.show', $pengajuan->id);
    }
}
