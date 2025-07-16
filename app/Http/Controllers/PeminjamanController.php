<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kendaraan;
use App\Models\peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PeminjamanController extends Controller
{
    public function index()
    {


        return view('peminjaman_kendaraan.index', [
            'users' => User::all(),
            'kendaraans' => Kendaraan::all(),
            'peminjaman' => peminjaman::latest()->get()
        ]);
    }

    public function create()
    {
        return view('peminjaman_kendaraan.create', [
            'users' => User::all(),
            'kendaraans' => Kendaraan::all(),
            'peminjaman' => peminjaman::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'waktu_awal_pinjam' => 'required|date',
            'waktu_akhir_pinjam' => 'required|date|after:waktu_awal_pinjam',
            'tujuan' => 'required|string|max:255',
            'with_driver' => 'required|in:driver,bawa_sendiri',
            'level_kepentingan' => 'required|in:penting,sangat_penting',
            'keterangan' => 'nullable|string',
            'km_pergi' => 'nullable|numeric|min:0',
            'status' => 'nullable|in:disetujui,tidak_disetujui,sedang_digunakan,selesai,menunggu_approval,pending',
        ]);

        $peminjaman = new Peminjaman();
        $peminjaman->user_id = Auth::id();
        $peminjaman->kendaraan_id = $request->kendaraan_id;
        $peminjaman->waktu_awal_pinjam = $request->waktu_awal_pinjam;
        $peminjaman->waktu_akhir_pinjam = $request->waktu_akhir_pinjam;
        $peminjaman->tujuan = $request->tujuan;
        $peminjaman->with_driver = $request->with_driver;
        $peminjaman->level_kepentingan = $request->level_kepentingan;
        $peminjaman->keterangan = $request->keterangan;
        $peminjaman->km_pergi = $request->km_pergi;
        $peminjaman->status = 'menunggu_approval'; // default status saat pertama kali ajukan

        $peminjaman->save();

        Http::post('http://localhost:3000/send-message', [
            'nomor' => '082382254943',
            'pesan' => "Ada permintaan peminjaman kendaraan baru dari " . Auth::user()->name . ". Silakan cek sistem."
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $peminjaman = peminjaman::findOrFail($id);
        return view('peminjaman_kendaraan.modal-edit', compact('peminjaman'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'waktu_awal_pinjam' => 'required|date',
            'waktu_akhir_pinjam' => 'required|date|after:waktu_awal_pinjam',
            'tujuan' => 'required|string|max:255',
            'with_driver' => 'required|in:driver,bawa_sendiri',
            'level_kepentingan' => 'required|in:penting,sangat_penting',
            'keterangan' => 'nullable|string',
            'km_pergi' => 'nullable|numeric|min:0',
            'status' => 'nullable|in:disetujui,tidak_disetujui,sedang_digunakan,selesai,menunggu_approval,pending',
        ]);

        $peminjaman = peminjaman::findOrfail($id);

        $peminjaman->kendaraan_id = $request->kendaraan_id;
        $peminjaman->waktu_awal_pinjam = $request->waktu_awal_pinjam;
        $peminjaman->waktu_akhir_pinjam = $request->waktu_akhir_pinjam;
        $peminjaman->tujuan = $request->tujuan;
        $peminjaman->with_driver = $request->with_driver;
        $peminjaman->level_kepentingan = $request->level_kepentingan;
        $peminjaman->keterangan = $request->keterangan;
        $peminjaman->km_pergi = $request->km_pergi;

        $peminjaman->save();

        return redirect()->back()->with('success', 'data berhasil diperbarui.');
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['user', 'kendaraan'])->findOrFail($id);
        return view('peminjaman_kendaraan.show', compact('peminjaman'));
    }

    public function adminIndex()
    {
        $peminjaman = Peminjaman::with('user', 'kendaraan')->orderBy('created_at', 'desc')->get();
        return view('admin.pemesanan', compact('peminjaman'));
    }

    public function prosesApproval(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $statusBaru = $request->status ?? 'disetujui';

        $peminjaman->status = $statusBaru;
        $peminjaman->save();

        return response()->json(['success' => true]);
    }



    public function pengembalian()
    {
        $user = Auth::user();

        // Cek apakah yang login admin atau bukan
        if ($user->role === 'admin') {
            // Admin bisa lihat semua data yang disetujui atau sedang digunakan
            $peminjaman = Peminjaman::whereIn('status', ['disetujui', 'sedang_digunakan'])->get();
        } else {
            // User biasa hanya lihat data miliknya sendiri
            $peminjaman = Peminjaman::where('user_id', $user->id)
                ->whereIn('status', ['disetujui', 'sedang_digunakan'])
                ->get();
        }

        return view('peminjaman_kendaraan.index', [
            'peminjaman' => $peminjaman,
            'kendaraans' => Kendaraan::all() // ⬅ tambah ini
        ]);
    }

    public function formPengembalian($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('admin.form-pengembalian', compact('peminjaman'));
    }

    public function prosesPengembalian(Request $request, $id)
    {
        $request->validate([
            'waktu_kembali' => 'required|date',
            'km_kembali' => 'required|numeric',
            'kondisi_setelah' => 'nullable|string',
            'foto_setelah' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        // Handle Upload Foto
        if ($request->hasFile('foto_setelah')) {
            $fotoPath = $request->file('foto_setelah')->store('foto_pengembalian', 'public');
            $peminjaman->foto_setelah = $fotoPath;
        }

        $peminjaman->waktu_kembali = $request->waktu_kembali;
        $peminjaman->km_kembali = $request->km_kembali;
        $peminjaman->kondisi_setelah = $request->kondisi_setelah;
        $peminjaman->status = 'selesai'; // kalau pakai status selesai
        $peminjaman->save();

        // ✅ Kirim WA ke Admin
        Http::post('http://localhost:3000/send-message', [
            'nomor' => '082382254943',
            'pesan' => "User " . $peminjaman->user->name . " telah mengembalikan kendaraan. Silakan cek sistem."
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dikembalikan');
    }

    public function laporan(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $query = Peminjaman::with(['user', 'kendaraan']);

        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('waktu_awal_pinjam', [$tanggalAwal . ' 00:00:00', $tanggalAkhir . ' 23:59:59']);
        }

        $data = $query->orderBy('waktu_awal_pinjam', 'desc')->get();

        return view('laporan.laporan_kendaraan', [
            'data' => $data,
            'tanggal_awal' => $tanggalAwal,
            'tanggal_akhir' => $tanggalAkhir
        ]);
    }

    public function riwayatUser()
    {
        $userId = Auth::id();

        $peminjaman = peminjaman::with('kendaraan')
            ->where('user_id', $userId)
            ->orderBy('waktu_awal_pinjam', 'desc')
            ->get();

        return view('peminjaman_kendaraan.riwayat', compact('peminjaman'));
    }

    public function destroy($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        $pinjam->delete();

        return redirect()->back()->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
