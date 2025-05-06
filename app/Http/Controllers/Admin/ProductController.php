<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $product = Product::all();
        return view('admin.halamanproduk', compact('product'));
    }

    public function create(){
        return view('admin.produkCreate');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nama_kue' => 'required|string',
            'varian_kue' => 'required|string',
            'jumlah' => 'required|integer',
            'harga' => 'required|integer',
        ]);

        Product::create($validated);

        return redirect('/produk')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('admin.produkEdit', compact('product'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'nama_kue' => 'required|string',
            'varian_kue' => 'required|string',
            'jumlah' => 'required|integer',
            'harga' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);

        return redirect('/produk')->with('success', 'Produk berhasil diubah');
    }

    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/produk')->with('success', 'Produk berhasil dihapus');
    }
}
