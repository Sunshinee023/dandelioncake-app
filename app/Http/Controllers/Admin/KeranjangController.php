<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Product;

class KeranjangController extends Controller
{
    public function index() {
        $keranjang = Keranjang::with(['pelanggan', 'produk'])->get();
        return view('admin.keranjang', compact('keranjang'));
    }

    public function create() {
        $pelanggan = Pelanggan::all();
        $produk = Product::all();
        return view('admin.keranjangCreate', compact('pelanggan', 'produk'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'produk_id' => 'required|exists:product,id',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric',
        ]);

        Keranjang::create($validated);

        return redirect('/keranjang')->with('success', 'Item berhasil ditambahkan ke keranjang');
    }

    public function edit($id) {
        $keranjang = Keranjang::findOrFail($id);
        $pelanggan = Pelanggan::all();
        $produk = Product::all();
        return view('admin.keranjangEdit', compact('keranjang', 'pelanggan', 'produk'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'produk_id' => 'required|exists:product,id',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric',
        ]);

        $keranjang = Keranjang::findOrFail($id);
        $keranjang->update($validated);

        return redirect('/keranjang')->with('success', 'Item keranjang berhasil diubah');
    }

    public function destroy($id) {
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();

        return redirect('/keranjang')->with('success', 'Item berhasil dihapus dari keranjang');
    }
}
