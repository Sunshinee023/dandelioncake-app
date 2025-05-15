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
        // Validasi input
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_kue' => 'required|string',
            'varian_kue' => 'required|string',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
        ]);

        // Proses upload gambar
        $file = $request->file('gambar');
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('images/products'), $fileName);

        // Simpan data produk ke database
        Product::create([
            'nama_kue' => $request->nama_kue,
            'varian_kue' => $request->varian_kue,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'gambar' => $fileName, // pastikan kolom db bernama "gambar"
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('admin.produkEdit', compact('product'));
    }

   public function update(Request $request, $id) {
    $product = Product::findOrFail($id);

    $request->validate([
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'nama_kue' => 'required|string|max:255',
        'varian_kue' => 'required|string|max:255',
        'stok' => 'required|integer',
        'harga' => 'required|numeric',
    ]);

    $data = $request->only(['nama_kue', 'varian_kue', 'stok', 'harga']);

    if ($request->hasFile('gambar')) {
        if ($product->gambar && file_exists(public_path('images/products/' . $product->gambar))) {
            unlink(public_path('images/products/' . $product->gambar));
        }

        $fileName = time().'_'.$request->gambar->getClientOriginalName();
        $request->gambar->move(public_path('images/products'), $fileName);
        $data['gambar'] = $fileName;
    }

    $product->update($data);

    return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diupdate');
}

    public function destroy($id) {
        $product = Product::findOrFail($id);

        // Hapus gambar lama jika ada
        if ($product->gambar && file_exists(public_path('images/products/' . $product->gambar))) {
            unlink(public_path('images/products/' . $product->gambar));
        }

        $product->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
