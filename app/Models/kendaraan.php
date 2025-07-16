<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kendaraan', 'plat_nomor', 'jenis_kendaraan', 'merk_kendaraan', 'warna_kendaraan', 'tgl_berakhir_stnk', 'status_kepemilikan', 'foto_kendaraan'];

    // tambahin relasi ini
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
