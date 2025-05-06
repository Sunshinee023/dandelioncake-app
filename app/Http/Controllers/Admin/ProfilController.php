<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

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
            'nama' => 'required|string',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'role' => 'required|in:admin,customer',
        ]);

        Pelanggan::create($validated);

        return redirect('/profil')->with('success', 'Profil berhasil ditambahkan');
    }

    public function edit($id)
    {
        $profil = Pelanggan::findOrFail($id);
        return view('admin.profilEdit', compact('profil'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'role' => 'required|in:admin,customer',
        ]);

        $profil = Pelanggan::findOrFail($id);
        $profil->update($validated);

        return redirect('/profil')->with('success', 'Profil berhasil diperbarui');
    }

    public function destroy($id)
    {
        $profil = Pelanggan::findOrFail($id);
        $profil->delete();

        return redirect('/profil')->with('success', 'Profil berhasil dihapus');
    }
}
