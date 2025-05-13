<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class IsAdmin
{
    public function handle($request, Closure $next)
{
    if (Session::get('user_role') !== 'admin') {
        return redirect('/login')->with('error', 'Unauthorized');
    }

    return $next($request);
}

}
