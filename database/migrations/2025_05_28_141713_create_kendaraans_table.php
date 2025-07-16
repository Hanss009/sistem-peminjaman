<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kendaraan');
            $table->string('plat_nomor');
            $table->enum('jenis_kendaraan',['mobil','sepeda_motor']);
            $table->enum('merk_kendaraan',['daihatsu','toyota','mitsubishi','honda','dll'])->default('dll');
            $table->string('warna_kendaraan');
            $table->string('foto_kendaraan')->nullable();
            $table->date('tgl_berakhir_stnk');
            $table->enum('status_kepemilikan',['pribadi','yayasan','sewa']);
            $table->enum('status_kendaraan',['aktif','tidak_aktif','services','rusak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
