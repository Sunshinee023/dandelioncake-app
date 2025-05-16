<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;  // <--- ini penting
use App\Models\User;
use App\Models\Pelanggan;

class ProfileuserController extends Controller
{
    public function index()
{
     $userId = Session::get('user_id');

    if (!$userId) {
        return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $user = User::find($userId);
    $pelanggan = $user ? $user->pelanggan : null;

    return view('user.profile', compact('user', 'pelanggan'));
}


    public function update(Request $request)
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan;

        $validatedUser = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $validatedPelanggan = $request->validate([
            // Tambahkan validasi jika ada field pelanggan yang ingin diperbarui
            // contoh: 'alamat' => 'nullable|string|max:255',
        ]);

        // Update data user
        $user->name = $validatedUser['name'];
        $user->email = $validatedUser['email'];

        if (!empty($validatedUser['password'])) {
            $user->password = Hash::make($validatedUser['password']);
        }

        $user->save();

        // Update data pelanggan jika ada
        if ($pelanggan && !empty($validatedPelanggan)) {
            $pelanggan->fill($validatedPelanggan);
            $pelanggan->save();
        }

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
