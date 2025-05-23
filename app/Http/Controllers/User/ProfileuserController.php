<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileuserController extends Controller
{
    // Tampilkan halaman profil
    public function index()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login dulu ya');
        }

        $user = User::with('pelanggan')->find($userId);
        if (!$user) {
            return redirect()->route('login')->with('error', 'User tidak ditemukan');
        }

        return view('user.profile', compact('user'));
    }

    // Tampilkan form edit
    public function edit()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login dulu ya');
        }

        $user = User::with('pelanggan')->find($userId);
        if (!$user) {
            return redirect()->route('login')->with('error', 'User tidak ditemukan');
        }

        return view('user.profileedit', compact('user'));
    }

    // Proses update profil
    public function update(Request $request)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login dulu ya');
        }

        $user = User::findOrFail($userId);

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255|unique:users,email,' . $user->id,
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'alamat'  => 'nullable|string|max:500',
            'telepon' => 'nullable|string|max:20',
        ]);

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Ambil atau buat data pelanggan
        $pelanggan = $user->pelanggan ?: new Pelanggan();
        $pelanggan->user_id = $user->id;

        // Jika upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($pelanggan->gambar && file_exists(public_path('images/profil/' . $pelanggan->gambar))) {
                unlink(public_path('images/profil/' . $pelanggan->gambar));
            }

            // Simpan gambar baru
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/profil'), $filename);

            $pelanggan->gambar = $filename;
        }

        // Update info lainnya
        $pelanggan->alamat = $request->alamat;
        $pelanggan->telepon = $request->telepon;
        $pelanggan->save();

        return redirect()->route('user.profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
