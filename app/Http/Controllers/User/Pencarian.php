<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class PencarianController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::where('name', 'like', "%{$keyword}%")->get();

        return view('user.pencarian', compact('products', 'keyword'));
    }
}
