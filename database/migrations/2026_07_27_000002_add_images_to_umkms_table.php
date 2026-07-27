<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->string('gambar_utama')->nullable()->after('produk_unggulan');
            $table->text('gambar_produk')->nullable()->after('gambar_utama'); // JSON array paths
        });
    }

    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->dropColumn(['gambar_utama', 'gambar_produk']);
        });
    }
};
