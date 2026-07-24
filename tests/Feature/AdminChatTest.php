<?php

namespace Tests\Feature;

use App\Models\ChatMessage;
use App\Models\PengajuanSurat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminChatTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_chat_for_pengajuan(): void
    {
        $pengajuan = PengajuanSurat::create([
            'jenis_surat' => 'SKTM',
            'keperluan' => 'Keperluan uji',
            'nama_lengkap' => 'Budi',
            'nik' => '3201010101010001',
            'tempat_lahir' => 'Serang',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'alamat' => 'Jl. Ujicoba',
            'no_hp' => '081234567890',
            'pekerjaan' => 'Pegawai',
            'status' => 'Pending',
        ]);

        ChatMessage::create([
            'pengajuan_surat_id' => $pengajuan->id,
            'sender' => 'user',
            'message' => 'Halo, saya ingin menanyakan status surat saya.',
        ]);

        $response = $this->withSession(['admin_logged_in' => true, 'admin_name' => 'Admin'])
            ->get('/admin/pengajuan/' . $pengajuan->id . '/chat');

        $response->assertStatus(200);
        $response->assertSee('Riwayat Chat WhatsApp');
        $response->assertSee('Halo, saya ingin menanyakan status surat saya.');
    }

    public function test_admin_can_send_chat_message(): void
    {
        $pengajuan = PengajuanSurat::create([
            'jenis_surat' => 'SKTM',
            'keperluan' => 'Keperluan uji',
            'nama_lengkap' => 'Budi',
            'nik' => '3201010101010001',
            'tempat_lahir' => 'Serang',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'alamat' => 'Jl. Ujicoba',
            'no_hp' => '081234567890',
            'pekerjaan' => 'Pegawai',
            'status' => 'Pending',
        ]);

        $response = $this->withSession(['admin_logged_in' => true, 'admin_name' => 'Admin'])
            ->post('/admin/pengajuan/' . $pengajuan->id . '/chat', ['message' => 'Pesan admin diuji']);

        $response->assertRedirect();
        $this->assertDatabaseHas('chat_messages', [
            'pengajuan_surat_id' => $pengajuan->id,
            'sender' => 'admin',
            'message' => 'Pesan admin diuji',
        ]);
    }
}
