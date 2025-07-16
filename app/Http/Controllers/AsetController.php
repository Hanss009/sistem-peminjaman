<?php

namespace App\Http\Controllers;

use App\Models\aset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AsetController extends Controller
{
    public function index()
    {
        return view('aset.index', [
            'aset' => aset::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_aset' => 'required|string|max:255',
            'tipe_aset' => 'required|in:properti,elektronik_it,inventaris',
            'no_aset' => 'required|string|min:3',
            'status_aset' => 'required|in:aktif,tidak_aktif,services',
            'foto_aset' => 'nullable|image|mimes:jpeg,jpg,png,gif,bmp,svg,webp,tif,tiff|max:5120',

        ]);

        $fotoName = null;
        if ($request->hasFile('foto_aset')) {
            $fotoName = time() . '_' . $request->file('foto_aset')->getClientOriginalName();
            $request->file('foto_aset')->storeAs('public/foto_aset/', $fotoName);
        }

        aset::create([
            'nama_aset' => $request->nama_aset,
            'tipe_aset' => $request->tipe_aset,
            'no_aset' => $request->no_aset,
            'status_aset' => $request->status_aset,
            'foto_aset' => $fotoName,
        ]);

        return redirect()->route('aset.index')->with('success', 'aset berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $aset = aset::findOrFail($id);
        return view('aset.modal-edit', compact('aset'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_aset' => 'required|string|max:255',
            'tipe_aset' => 'required|in:properti,elektronik_it,inventaris',
            'no_aset' => 'required|string|min:3',
            'status_aset' => 'required|in:aktif,tidak_aktif,services',
            'foto_aset' => 'nullable|image|mimes:jpeg,jpg,png,gif,bmp,svg,webp,tif,tiff|max:5120',
        ]);


        // Ambil data user berdasarkan ID
        $aset = aset::findOrFail($id);

        // Cek dan simpan foto jika diupload
        if ($request->hasFile('foto_aset')) {
            // Hapus foto lama jika ada
            if ($aset->foto_aset && Storage::exists('public/foto_aset/' . $aset->foto_aset)) {
                Storage::delete('public/foto_aset/' . $aset->foto_aset);
            }
            $file = $request->file('foto_aset');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_aset', $filename);
            $aset->foto_aset = $filename;
        }

        // Update data aset
        $aset->nama_aset = $request->nama_aset;
        $aset->tipe_aset = $request->tipe_aset;
        $aset->no_aset = $request->no_aset;
        $aset->status_aset = $request->status_aset;
        $aset->save();

        return redirect()->back()->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $aset = aset::findOrFail($id);

        if ($aset->foto_aset && Storage::exists('public/foto_aset/' . $aset->foto_aset)) {
            Storage::delete('public/foto_aset/' . $aset->foto_aset);
        }

        $aset->delete();

        return redirect()->route('aset.index')->with('success', 'Aset berhasil dihapus!');
    }
}
