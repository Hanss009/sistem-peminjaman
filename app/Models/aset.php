<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aset extends Model
{
    use HasFactory;

    protected $fillable = ['nama_aset', 'tipe_aset', 'no_aset', 'status_aset', 'foto_aset'];

    // tambahin relasi ini
    public function peminjaman_aset()
    {
        return $this->hasMany(Peminjaman_aset::class);
    }
}
