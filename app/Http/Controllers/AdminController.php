<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'user' => User::latest()->get()
        ]);
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,gs,pegawai',
            'unit' => 'required|in:masjid,bmt,tkit,sdit,mts,smpit,smait,sekretariat,keuangan,tpa,warung,dapur,direktorat',
            'nip' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoName = null;
        if ($request->hasFile('foto')) {
            $fotoName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('public/foto/', $fotoName);
        }


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'unit' => $request->unit,
            'nip' => $request->nip,
            'foto' => $fotoName,
        ]);


        return redirect()->route('admin.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.index')->with('success', 'Password berhasil diperbarui!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.modal-edit', compact('user'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:admin,gs,pegawai',
            'unit' => 'required|in:masjid,bmt,tkit,sdit,mts,smpit,smait,sekretariat,keuangan,tpa,warung,dapur,direktorat',
            'nip' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::exists('public/foto/' . $user->foto)) {
                Storage::delete('public/foto/' . $user->foto);
            }
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto', $filename);
            $user->foto = $filename;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->unit = $request->unit;
        $user->nip = $request->nip;

        // Password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Data user berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus foto jika ada
        if ($user->foto && Storage::exists('public/foto/' . $user->foto)) {
            Storage::delete('public/foto/' . $user->foto);
        }

        $user->delete();

        return redirect()->route('admin.index')->with('success', 'User berhasil dihapus!');
    }
}
