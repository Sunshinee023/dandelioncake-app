<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (!Session::has('user_role') || Session::get('user_role') !== 'admin') {
                return redirect()->route('login')->with('error', 'Akses ditolak.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $currentDate = Carbon::now();
        $totalPenjualan = Pembayaran::where('status_pembayaran', 'sudah dibayar')->sum('total_harga');
        
    $kueTerlaris = DB::table('pembayaran')
        ->select('produk_id', DB::raw('COUNT(*) as jumlah_terjual'))
        ->where('status_pembayaran', 'sudah dibayar')
        ->groupBy('produk_id')
        ->orderByDesc('jumlah_terjual')
        ->first();

    if ($kueTerlaris) {
        $kueTerlaris->nama_produk = Product::find($kueTerlaris->produk_id)->nama_kue;
    }

    return view('admin.dashboard', compact('totalPenjualan', 'kueTerlaris'));
}
    
}
