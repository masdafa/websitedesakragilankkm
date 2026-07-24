<?php

namespace Tests\Feature;

use App\Models\PengajuanSurat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_requires_login(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/admin/login');
    }

    public function test_admin_dashboard_can_be_viewed_after_login(): void
    {
        $response = $this->withSession(['admin_logged_in' => true, 'admin_name' => 'Admin'])
            ->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Panel Admin');
        $response->assertSee('Pengajuan Surat');
    }

    public function test_admin_can_update_pengajuan_status(): void
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
            ->withoutMiddleware()
            ->post('/admin/pengajuan/' . $pengajuan->id . '/status', ['status' => 'Selesai']);

        $response->assertRedirect();
        $this->assertSame('Selesai', $pengajuan->fresh()->status);
    }
}
