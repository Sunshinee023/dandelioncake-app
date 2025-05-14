<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class halamanutamaController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('user.halaman_utama', compact('products'));
    }
}
