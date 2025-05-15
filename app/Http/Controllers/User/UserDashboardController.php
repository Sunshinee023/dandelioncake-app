<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Product; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('user_role') || Session::get('user_role') !== 'customer') {
                return redirect()->route('login')->with('error', 'Akses ditolak.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $currentDate = Carbon::now();
    $product = Product::paginate(8); // Menggunakan pagination
    return view('user.dashboard', compact('currentDate', 'product'));
    }
}
