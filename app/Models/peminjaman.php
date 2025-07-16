<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'user_id',
        'kendaraan_id',
        'waktu_awal_pinjam',
        'waktu_akhir_pinjam',
        'tujuan',
        'with_driver',
        'level_kepentingan',
        'keterangan',
        'waktu_kembali',
        'km_pergi',
        'km_kembali',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
