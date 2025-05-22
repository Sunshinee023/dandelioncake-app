<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class TransaksiuserController extends Controller
{
    // Menampilkan halaman daftar transaksi yang masih berstatus 'pending'
    public function index()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $pelanggan = Pelanggan::with('user')->where('user_id', $userId)->firstOrFail();

        $transaksi = Transaksi::with('product')
            ->where('pelanggan_id', $pelanggan->id)
            ->where('status', 'pending')
            ->get();

        $totalHarga = $transaksi->sum('total_harga');

        return view('user.transaksi', compact('pelanggan', 'transaksi', 'totalHarga'));
    }

    public function store(Request $request)
{
    $userId = session('user_id');
    if (!$userId) {
        return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $pelanggan = Pelanggan::where('user_id', $userId)->firstOrFail();

    $selectedItems = $request->input('produk_id', []);
    $jumlahItems = $request->input('jumlah', []);

    if (empty($selectedItems)) {
        return redirect()->route('user.keranjang.index')->with('error', 'Silakan pilih produk terlebih dahulu.');
    }

    foreach ($selectedItems as $index => $produkId) {
        $jumlah = isset($jumlahItems[$index]) ? intval($jumlahItems[$index]) : 1;
        $product = Product::findOrFail($produkId);

        Transaksi::create([
            'pelanggan_id' => $pelanggan->id,
            'produk_id' => $produkId,
            'tanggal_transaksi' => now(),
            'total_harga' => $jumlah * $product->harga,
            'status' => 'pending',
        ]);
    }

    return redirect()->route('user.transaksi.index')->with('success', 'Transaksi berhasil disimpan. Silakan lanjutkan pembayaran.');
}

public function beli(Request $request)
{
    $userId = session('user_id');
    $pelanggan = Pelanggan::where('user_id', $userId)->firstOrFail();

    $produk = Product::findOrFail($request->produk_id);

    $transaksi = Transaksi::create([
        'pelanggan_id' => $pelanggan->id,
        'produk_id' => $produk->id,
        'tanggal_transaksi' => now(),
        'total_harga' => $produk->harga * $request->jumlah,
        'status' => 'pending',
    ]);

    return redirect()->route('user.pembayaran.index')->with('success', 'Silakan lanjutkan ke pembayaran.');
}


}
