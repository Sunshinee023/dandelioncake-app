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

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login_error' => 'Email atau password salah.'])->withInput();
        }

        Session::put('user_id', $user->id);
        Session::put('user_name', $user->name);
        Session::put('user_role', $user->role);

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'customer') {
            return redirect()->route('user.dashboard');
        }

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Session::flush();

        return redirect()->route('login');
    }
}
