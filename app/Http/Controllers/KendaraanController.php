<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kendaraan.index', [
            'kendaraan' => Kendaraan::latest()->get()

        ]);
    }

    /**
     * Show the form for creating a new resource.
    
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kendaraan' => 'required|string|max:255',
            'plat_nomor' => 'required|string|min:3',
            'jenis_kendaraan' => 'required|in:mobil,sepeda_motor',
            'merk_kendaraan' => 'required|in:daihatsu,toyota,mitsubishi,honda,dll',
            'warna_kendaraan' => 'required|string|min:3',
            'foto_kendaraan' => 'nullable|image|mimes:jpeg,jpg,png,gif,bmp,svg,webp,tif,tiff|max:5120',
            'tgl_berakhir_stnk' => 'required|date',
            'status_kepemilikan' => 'required|in:pribadi,yayasan,sewa',
            'status_kendaraan' => 'required|in:aktif,tidak_aktif,services,rusak',
        ]);

        $fotoName = null;
        if ($request->hasFile('foto_kendaraan')) {
            $fotoName = time() . '_' . $request->file('foto_kendaraan')->getClientOriginalName();
            $request->file('foto_kendaraan')->storeAs('public/foto_kendaraan/', $fotoName);
        }

        Kendaraan::create([
            'nama_kendaraan' => $request->nama_kendaraan,
            'plat_nomor' => $request->plat_nomor,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'merk_kendaraan' => $request->merk_kendaraan,
            'warna_kendaraan' => $request->warna_kendaraan,
            'tgl_berakhir_stnk' => $request->tgl_berakhir_stnk,
            'status_kepemilikan' => $request->status_kepemilikan,
            'status_kendaraan' => $request->status_kendaraan,
            'foto_kendaraan' => $fotoName,
        ]);

        return redirect()->route('kendaraan.index')->with('success', 'kendaraan berhasil ditambahkan!');
    }
    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kendaraan = kendaraan::findOrFail($id);
        return view('kendaraan.modal-edit', compact('kendaraan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kendaraan' => 'required|string|max:255',
            'plat_nomor' => 'required|string|min:3',
            'jenis_kendaraan' => 'required|in:mobil,sepeda_motor',
            'merk_kendaraan' => 'required|in:daihatsu,toyota,mitsubishi,honda,dll',
            'warna_kendaraan' => 'required|string|min:3',
            'foto_kendaraan' => 'nullable|image|mimes:jpeg,jpg,png,gif,bmp,svg,webp,tif,tiff|max:5120',
            'tgl_berakhir_stnk' => 'required|date',
            'status_kepemilikan' => 'required|in:pribadi,yayasan,sewa',
            'status_kendaraan' => 'required|in:aktif,tidak_aktif,services,rusak',
        ]);


        // Ambil data user berdasarkan ID
        $kendaraan = kendaraan::findOrFail($id);

        // Cek dan simpan foto jika diupload
        if ($request->hasFile('foto_kendaraan')) {
            // Hapus foto lama jika ada
            if ($kendaraan->foto_kendaraan && Storage::exists('public/foto_kendaraan/' . $kendaraan->foto_kendaraan)) {
                Storage::delete('public/foto_kendaraan/' . $kendaraan->foto_kendaraan);
            }
            $file = $request->file('foto_kendaraan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_kendaraan', $filename);
            $kendaraan->foto_kendaraan = $filename;
        }

        // Update data aset
        $kendaraan->nama_kendaraan = $request->nama_kendaraan;
        $kendaraan->plat_nomor = $request->plat_nomor;
        $kendaraan->jenis_kendaraan = $request->jenis_kendaraan;
        $kendaraan->merk_kendaraan = $request->merk_kendaraan;
        $kendaraan->warna_kendaraan = $request->warna_kendaraan;
        $kendaraan->tgl_berakhir_stnk = $request->tgl_berakhir_stnk;
        $kendaraan->status_kepemilikan = $request->status_kepemilikan;
        $kendaraan->status_kendaraan = $request->status_kendaraan;
        $kendaraan->save();

        return redirect()->back()->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kendaraan = kendaraan::findOrFail($id);

        
        if ($kendaraan->foto_kendaraan && Storage::exists('public/foto_kendaraan/' . $kendaraan->foto_kendaraan)) {
            Storage::delete('public/foto_kendaraan/' . $kendaraan->foto_kendaraan);
        }

        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'kendaraan berhasil dihapus!');
    }
}
    

