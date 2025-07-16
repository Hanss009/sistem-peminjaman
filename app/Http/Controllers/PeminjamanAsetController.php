<?php

namespace App\Http\Controllers;

use App\Models\aset;
use App\Models\User;
use App\Models\peminjaman;
use Illuminate\Http\Request;
use App\Models\peminjaman_aset;
use Illuminate\Support\Facades\Auth;

class PeminjamanAsetController extends Controller
{
    public function index()
    {

        return view('peminjaman_aset.index', [
            'users' => User::all(),
            'asets' => aset::all(),
            'peminjaman_aset' => peminjaman_aset::latest()->get()
        ]);
    }

    public function create()
    {
        return view('peminjaman_aset.create', [
            'users' => User::all(),
            'asets' => aset::all(),
            'peminjaman_aset' => peminjaman_aset::latest()->get()
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'aset_id' => 'required|exists:asets,id',
            'tgl_awal_pinjam' => 'required|date',
            'tgl_akhir_pinjam' => 'required|date|after:tgl_awal_pinjam',
            'keperluan' => 'required|string|max:255',
            'status' => 'nullable|in:disetujui,tidak_disetujui,sedang_digunakan,selesai,menunggu_approval,pending',
            'nama_penerima' => 'required|string|max:255',
            'catatan' => 'nullable|string',
        ]);

        $peminjaman_aset = new peminjaman_aset();
        $peminjaman_aset->user_id = Auth::id();
        $peminjaman_aset->aset_id = $request->aset_id;
        $peminjaman_aset->tgl_awal_pinjam = $request->tgl_awal_pinjam;
        $peminjaman_aset->tgl_akhir_pinjam = $request->tgl_akhir_pinjam;
        $peminjaman_aset->keperluan = $request->keperluan;
        $peminjaman_aset->status = 'menunggu_approval';
        $peminjaman_aset->nama_penerima = $request->nama_penerima;
        $peminjaman_aset->catatan = $request->catatan;

        $peminjaman_aset->save();

        return redirect()->route('peminjaman_aset.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'aset_id' => 'required|exists:asets,id',
            'tgl_awal_pinjam' => 'required|date',
            'tgl_akhir_pinjam' => 'required|date|after:tgl_awal_pinjam',
            'keperluan' => 'required|string|max:255',
            'status' => 'nullable|in:disetujui,tidak_disetujui,sedang_digunakan,selesai,menunggu_approval,pending',
            'nama_penerima' => 'required|string|max:255',
            'catatan' => 'nullable|string',
        ]);
        $peminjaman_aset = peminjaman_aset::findOrFail($id);

        $peminjaman_aset->aset_id = $request->aset_id;
        $peminjaman_aset->tgl_awal_pinjam = $request->tgl_awal_pinjam;
        $peminjaman_aset->tgl_akhir_pinjam = $request->tgl_akhir_pinjam;
        $peminjaman_aset->keperluan = $request->keperluan;
        $peminjaman_aset->status = 'menunggu_approval';
        $peminjaman_aset->nama_penerima = $request->nama_penerima;
        $peminjaman_aset->catatan = $request->catatan;

        $peminjaman_aset->save();

        return redirect()->back()->with('success', 'data berhasil diperbarui.');
    }

    public function adminIndexAset()
    {
        $peminjaman_aset = peminjaman_aset::with('user', 'aset')->orderBy('created_at', 'desc')->get();
        return view('admin.pemesanan_aset', compact('peminjaman_aset'));
    }

    public function prosesApproval(Request $request, $id)
    {
        $peminjaman_aset = Peminjaman_aset::findOrFail($id);

        $statusBaru = $request->status ?? 'disetujui';

        $peminjaman_aset->status = $statusBaru;
        $peminjaman_aset->save();

        return response()->json(['success' => true]);
    }


    public function pengembalian_aset()
    {
        $user = Auth::user();

        // Cek apakah yang login admin atau bukan
        if ($user->role === 'admin') {
            // Admin bisa lihat semua data yang disetujui atau sedang digunakan
            $peminjaman_aset = peminjaman_aset::whereIn('status', ['disetujui', 'sedang_digunakan'])->get();
        } else {
            // User biasa hanya lihat data miliknya sendiri
            $peminjaman_aset = peminjaman_aset::where('user_id', $user->id)
                ->whereIn('status', ['disetujui', 'sedang_digunakan'])
                ->get();
        }

        return view('admin.pengembalian_aset', compact('peminjaman_aset'));
    }

    public function formPengembalian($id)
    {
        $peminjaman_aset = Peminjaman_aset::findOrFail($id);
        return view('admin.form-pengembalian_aset', compact('peminjaman_aset'));
    }

    public function prosesPengembalian(Request $request, $id)
    {
        $request->validate([
            'tgl_kembali' => 'required|date',
            'kondisi_setelah' => 'nullable|string',
            'foto_setelah' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $peminjaman_aset = Peminjaman_aset::findOrFail($id);

        // Handle Upload Foto
        if ($request->hasFile('foto_setelah')) {
            $fotoPath = $request->file('foto_setelah')->store('foto_pengembalian', 'public');
            $peminjaman_aset->foto_setelah = $fotoPath;
        }

        $peminjaman_aset->tgl_kembali = $request->tgl_kembali;
        $peminjaman_aset->kondisi_setelah = $request->kondisi_setelah;
        $peminjaman_aset->status = 'selesai'; // kalau pakai status selesai
        $peminjaman_aset->save();

        return redirect()->route('peminjaman_aset.index')->with('success', 'Peminjaman berhasil dikembalikan');
    }

    public function laporan(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $query = peminjaman_aset::with(['user', 'aset']);

        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('tgl_awal_pinjam', [$tanggalAwal . ' 00:00:00', $tanggalAkhir . ' 23:59:59']);
        }

        $data = $query->orderBy('tgl_awal_pinjam', 'desc')->get();

        return view('laporan.laporan_aset', [
            'data' => $data,
            'tanggal_awal' => $tanggalAwal,
            'tanggal_akhir' => $tanggalAkhir
        ]);
    }

    public function riwayatUser()
    {
        $userId = Auth::id();

        $peminjaman_aset = peminjaman_aset::with('aset')
            ->where('user_id', $userId)
            ->orderBy('tgl_awal_pinjam', 'desc')
            ->get();

        return view('peminjaman_aset.riwayat', compact('peminjaman_aset'));
    }

    public function destroy($id)
    {

        $pinjam = peminjaman_aset::findOrFail($id);
        $pinjam->delete();


        return redirect()->back()->with('success', ' Peminjaman berhasil dihapus');
    }
}
