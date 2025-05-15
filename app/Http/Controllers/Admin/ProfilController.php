<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = Pelanggan::all();
        return view('admin.profil', compact('profil'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.profilCreate', compact('users'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'alamat' => 'nullable|string',
        'telepon' => 'nullable|string|max:15',
        'role' => 'required|in:admin,customer',
    ]);

    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('images/profil'), $fileName);
        $validated['gambar'] = $fileName;
    }

    Pelanggan::create($validated);

    return redirect()->route('admin.profil.index')->with('success', 'Profil berhasil ditambahkan');
}

    public function edit($id)
    {
        $profil = Pelanggan::findOrFail($id);
        $users = User::all();
        return view('admin.profilEdit', compact('profil', 'users'));
    }


    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'alamat' => 'nullable|string',
        'telepon' => 'nullable|string|max:15',
        'role' => 'required|in:admin,customer',
    ]);

    $profil = Pelanggan::findOrFail($id);

    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($profil->gambar && file_exists(public_path('images/profil/' . $profil->gambar))) {
            unlink(public_path('images/profil/' . $profil->gambar));
        }

        $fileName = time().'_'.$request->gambar->getClientOriginalName();
        $request->gambar->move(public_path('images/profil'), $fileName);
        $validated['gambar'] = $fileName;
    }

    $profil->update($validated);

    return redirect()->route('admin.profil.index')->with('success', 'Profil berhasil diperbarui');
}

    public function destroy($id)
    {
        $profil = Pelanggan::findOrFail($id);
        $profil->delete();

        return redirect()->route('admin.profil.index')->with('success', 'Profil berhasil dihapus');
    }
}
