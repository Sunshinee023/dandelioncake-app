<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showRegister()
{
    return view('auth.register');
}

public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed', // pastikan pakai input `password_confirmation`
    ]);

    // Buat user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'customer', // default role
    ]);

    // Buat juga entry di tabel pelanggan (jika dibutuhkan)
    Pelanggan::create([
        'user_id' => $user->id,
        'role' => 'customer',
    ]);

    // Simpan ke session (langsung login)
    Session::put('user_id', $user->id);
    Session::put('user_name', $user->name);
    Session::put('user_role', $user->role);

    return redirect()->route('auth.login')->with('success', 'Registrasi berhasil. Selamat datang!');
}
    
    // Tampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input email dan password
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek apakah user ditemukan dan password cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login_error' => 'Email atau password salah.'])->withInput();
        }

        // Simpan data user ke session
        Session::put('user_id', $user->id);
        Session::put('user_name', $user->name);
        Session::put('user_role', $user->role);

        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'customer') {
            return redirect()->route('user.dashboard');
        }

        // Default redirect jika role tidak dikenali
        return redirect('/');
    }

    // Logout
    public function logout(Request $request)
    {
        // Hapus semua data session
        Session::flush();

        // Redirect ke halaman login
        return redirect()->route('login');
    }
}
