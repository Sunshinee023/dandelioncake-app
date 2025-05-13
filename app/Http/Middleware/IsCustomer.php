<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IsCustomer
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('user_role') || Session::get('user_role') !== 'customer') {
            return redirect()->route('login')->with('error', 'Akses ditolak.');
        }

        return $next($request);
    }
}
