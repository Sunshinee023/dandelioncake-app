<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KeranjangController extends Controller
{

    public function index()
    {

        $keranjang = Keranjang::with(['pelanggan', 'product'])->get();
        foreach ($keranjang as $item) {
            $item->pelanggan_name = $item->pelanggan->user->name; }
        return view('admin.keranjang', compact('keranjang'));
    }

    public function create()
    {

        $pelanggan = Pelanggan::all();
        $product = Product::all();
        return view('admin.keranjangCreate', compact('pelanggan', 'product'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'produk_id' => 'required|exists:product,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric',
        ]);

        Keranjang::create($validated);

        return redirect()->route('admin.keranjang.index')
                         ->with('success', 'Item berhasil ditambahkan ke keranjang');
    }

    public function edit($id)
    {

        $keranjang = Keranjang::findOrFail($id);
        $pelanggan = Pelanggan::all();
        $product = Product::all();
        return view('admin.keranjangEdit', compact('keranjang', 'pelanggan', 'product'));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'produk_id' => 'required|exists:product,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric',
        ]);

        $keranjang = Keranjang::findOrFail($id);
        $keranjang->update($validated);

        return redirect()->route('admin.keranjang.index')
                         ->with('success', 'Item keranjang berhasil diubah');
    }

    public function destroy($id)
    {

        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();

        return redirect()->route('admin.keranjang.index')
                         ->with('success', 'Item berhasil dihapus dari keranjang');
    }
}
