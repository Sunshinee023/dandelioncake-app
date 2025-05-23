<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class PembayaranController extends Controller
{
    
    public function index() {
        $pembayaran = Pembayaran::with(['pelanggan.user', 'product', 'transaksi'])->get();
        return view('admin.pembayaran', compact('pembayaran'));
    }

    public function create() {
        return view('admin.pembayaranCreate', [
            'pelanggan' => Pelanggan::with('user')->get(),
            'product' => Product::all(),
            'transaksi' => Transaksi::all(),
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'produk_id' => 'required|exists:product,id',
            'transaksi_id' => 'required|exists:transaksi,id',
            'total_harga' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
            'alamat_pengiriman' => 'required|string',
            'status_pembayaran' => 'required|in:pending,sudah dibayar,belum dibayar',
        ]);
        $validated['tanggal_checkout'] = now();
        Pembayaran::create($validated);

        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan');
    }

    public function edit($id) {
        $pembayaran = Pembayaran::findOrFail($id);
        $pelanggan = Pelanggan::with('user')->get();
        $product = Product::all();
        $transaksi = Transaksi::all();

        return view('admin.pembayaranEdit', compact('pembayaran', 'pelanggan', 'product', 'transaksi'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'produk_id' => 'required|exists:product,id',
            'transaksi_id' => 'required|exists:transaksi,id',
            'total_harga' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
            'alamat_pengiriman' => 'required|string',
            'status_pembayaran' => 'required|in:pending,sudah dibayar,belum dibayar',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($validated);

        return redirect()->route('admin.pembayaran.index')->with('success', 'Data pembayaran berhasil diubah');
    }

    public function destroy($id) {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('admin.pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus');
    }
}
