<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;  // <--- ini penting

class ProfileuserController extends Controller
{
    public function index()
{
    $userId = session('user_id'); // ambil user_id dari session
    if (!$userId) {
        return redirect()->route('login')->with('error', 'Silakan login dulu ya');
    }
    $user = User::with('pelanggan')->find($userId);
    if (!$user) {
        return redirect()->route('login')->with('error', 'User tidak ditemukan');
    }
    return view('user.profile', compact('user'));
}

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

public function update(Request $request)
{
    $userId = session('user_id');
    if (!$userId) {
        return redirect()->route('login')->with('error', 'Silakan login dulu ya');
    }

    $user = User::findOrFail($userId);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'alamat' => 'nullable|string|max:500',
        'telepon' => 'nullable|string|max:20',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();

    $pelanggan = $user->pelanggan ?: new Pelanggan();
    $pelanggan->user_id = $user->id;

    if ($request->hasFile('gambar')) {
        if ($pelanggan->gambar && Storage::exists('public/images/profil/' . $pelanggan->gambar)) {
            Storage::delete('public/images/profil/' . $pelanggan->gambar);
        }

        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/images/profil', $filename);
        $pelanggan->gambar = $filename;
    }

    $pelanggan->alamat = $request->alamat;
    $pelanggan->telepon = $request->telepon;
    $pelanggan->save();

    return redirect()->route('user.profile.index')->with('success', 'Profil berhasil diperbarui.');
}


    }
