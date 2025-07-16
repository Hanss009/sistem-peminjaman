<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kendaraan_id')->constrained('kendaraans')->onDelete('cascade');
            $table->datetime('waktu_awal_pinjam');
            $table->datetime('waktu_akhir_pinjam');
            $table->text('tujuan');
            $table->enum('with_driver', ['driver', 'bawa_sendiri']);
            $table->enum('level_kepentingan', ['penting', 'sangat_penting'])->default('penting');
            $table->text('keterangan');
            $table->datetime('waktu_kembali');
            $table->string('km_pergi');
            $table->string('km_kembali');
            $table->enum('status', ['disetujui', 'tidak_disetujui', 'sedang_digunakan', 'selesai', 'menunggu_approval', 'pending'])->default('menunggu_approval');
            $table->timestamps(); // optional, tapi disarankan
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
