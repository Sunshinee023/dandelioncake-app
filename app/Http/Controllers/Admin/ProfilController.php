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
        return view('admin.profilCreate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:user,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:15',
            'role' => 'required|in:admin,customer',
        ]);

        Pelanggan::create($validated);
        return redirect()->route('admin.profil.index')->with('success', 'Profil berhasil ditambahkan');
    }

    public function edit($id)
    {
        $profil = Pelanggan::findOrFail($id);
        return view('admin.profilEdit', compact('profil'));
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
