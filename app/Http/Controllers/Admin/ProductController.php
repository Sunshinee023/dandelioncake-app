<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            'gambar' => 'nullable|url',
            'nama_kue' => 'required|string',
            'varian_kue' => 'required|string',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
        ]);

        Product::create($validated);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('admin.produkEdit', compact('product'));
    }

    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $data = $request->only(['gambar', 'nama_kue', 'varian_kue', 'stok', 'harga']);

    $product->update($data);

    return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diupdate');
}


    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
