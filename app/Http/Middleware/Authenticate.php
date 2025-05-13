<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Periksa apakah ada sesi 'user'
        if (!Session::has('user')) {
            // Jika tidak ada sesi, arahkan ke halaman login
            return route('login');
        }

        // Jika ada sesi, biarkan permintaan diteruskan
        return null;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna sudah terautentikasi
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Harap login terlebih dahulu.');
        }

        // Jika sudah terautentikasi, lanjutkan permintaan
        return $next($request);
    }
}
