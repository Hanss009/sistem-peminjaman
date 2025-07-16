<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman_asets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('aset_id')->constrained('asets')->onDelete('cascade');
            $table->date('tgl_awal_pinjam');
            $table->date('tgl_akhir_pinjam');
            $table->text('keperluan')->nullable();
            $table->enum('status', ['disetujui', 'tidak_disetujui', 'sedang_digunakan', 'menunggu_approval', 'selesai', 'pending'])->default('menunggu_approval');
            $table->datetime('tgl_kembali');
            $table->string('nama_penerima')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_asets');
    }
};
