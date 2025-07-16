<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman_aset extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'aset_id',
        'tgl_awal_pinjam',
        'tgl_akhir_pinjam',
        'keperluan',
        'status',
        'tgl_kembali',
        'nama_penerima',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aset()
    {
        return $this->belongsTo(aset::class);
    }
}
