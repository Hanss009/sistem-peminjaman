<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Peminjaman_aset;
use App\Models\Kendaraan;
use App\Models\Aset;

class DashboardController extends Controller
{
  public function index()
  {

    // Summary
    $totalPeminjamanKendaraan = Peminjaman::count();
    $totalDisetujuiKendaraan   = Peminjaman::where('status', 'disetujui')->count();
    $totalKembaliKendaraan     = Peminjaman::where('status', 'selesai')->count();
    $totalDitolakKendaraan     = Peminjaman::where('status', 'tidak_disetujui')->count();

    $totalPeminjamanAset = Peminjaman_aset::count();
    $totalDisetujuiAset   = Peminjaman_aset::where('status', 'disetujui')->count();
    $totalKembaliAset     = Peminjaman_aset::where('status', 'selesai')->count();
    $totalDitolakAset     = Peminjaman_aset::where('status', 'tidak_disetujui')->count();

    // Kendaraan
    $kendaraanSedangDipakai = Kendaraan::whereHas('peminjaman', function ($q) {
      $q->whereIn('status', ['disetujui', 'sedang_digunakan']);
    })->get();

    $kendaraanTersedia = Kendaraan::whereDoesntHave('peminjaman', function ($q) {
      $q->whereIn('status', ['disetujui', 'sedang_digunakan']);
    })->get();

    // Aset
    $asetSedangDipakai = Aset::whereHas('peminjaman_aset', function ($q) {
      $q->whereIn('status', ['disetujui', 'sedang_digunakan']);
    })->get();

    $asetTersedia = Aset::whereDoesntHave('peminjaman_aset', function ($q) {
      $q->whereIn('status', ['disetujui', 'sedang_digunakan']);
    })->get();

    return view('dashboard', compact(
      'totalPeminjamanKendaraan',
      'totalDisetujuiKendaraan',
      'totalKembaliKendaraan',
      'totalDitolakKendaraan',
      'totalPeminjamanAset',
      'totalDisetujuiAset',
      'totalKembaliAset',
      'totalDitolakAset',
      'kendaraanSedangDipakai',
      'kendaraanTersedia',
      'asetSedangDipakai',
      'asetTersedia'

    ));
  }
}
