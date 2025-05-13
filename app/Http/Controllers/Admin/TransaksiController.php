<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    public function index()
{
    $transaksi = Transaksi::with(['pelanggan', 'product'])->get();
    foreach ($transaksi as $item) {
        $item->pelanggan_name = $item->pelanggan->user->name; }
    return view('admin.transaksi', compact('transaksi'));
}
 
 
    public function create()
    {
        $pelanggan = Pelanggan::all(); // ganti nama variabel agar sesuai dengan view
        $product = Product::all(); // jangan lupa ambil product juga

        return view('admin.transaksiCreate', compact('profil', 'product'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'produk_id' => 'required|exists:product,id', 
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'total_harga' => 'required|numeric',
            'status' => 'required|in:pending,diproses,dikirim,selesai',
            'tanggal_transaksi' => 'nullable|date',
        ]);

        Transaksi::create($validated);

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $pelanggan = Pelanggan::all();
        return view('admin.transaksiEdit', compact('transaksi', 'pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'produk_id' => 'required|exists:product,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'total_harga' => 'required|numeric',
            'status' => 'required|in:pending,diproses,dikirim,selesai',
            'tanggal_transaksi' => 'nullable|date',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($validated);

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
