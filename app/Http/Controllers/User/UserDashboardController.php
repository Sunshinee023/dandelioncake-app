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

    public function index(Request $request)
{
    $currentDate = Carbon::now();

    $query = $request->input('q'); // ambil keyword dari search bar

    if ($query) {
        $product = Product::where('nama_kue', 'like', "%{$query}%")
            ->orWhere('varian_kue', 'like', "%{$query}%")
            ->paginate(8);
    } else {
        $product = Product::paginate(8);
    }

    return view('user.dashboard', compact('currentDate', 'product', 'query'));
}

}
