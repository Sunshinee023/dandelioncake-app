<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class TransaksiuserController extends Controller
{
    // Method untuk beli sekarang (produk tunggal)
    public function beliSekarang($id)
    {
        $product = Product::findOrFail($id);
        return view('user.pembayaran', compact('product'));
    }

    // Method untuk checkout dari keranjang
    public function checkoutDariKeranjang()
    {
        $keranjang = Keranjang::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('user.pembayaran', compact('keranjang'));
    }

    // Method untuk melakukan pembayaran dari keranjang
    public function bayarDariKeranjang(Request $request)
    {
        // Proses pembayaran untuk semua item di keranjang
        foreach ($request->keranjang_id as $id) {
            $item = Keranjang::findOrFail($id);
            
            // Simulasi transaksi untuk setiap item
            Transaksi::create([
                'user_id' => auth()->id(),
                'product_id' => $item->product_id,
                'jumlah' => $item->jumlah,
                'total' => $item->product->harga * $item->jumlah,
                'status' => 'selesai', // status pembayaran
            ]);
            
            // Hapus item dari keranjang setelah pembayaran berhasil
            $item->delete();
        }

        // Set pesan sukses
        Session::flash('success', 'Pembayaran berhasil!');

        // Redirect ke halaman keranjang setelah pembayaran
        return redirect()->route('keranjang.index');
    }

    // Method untuk melakukan pembayaran satu produk
    public function bayarSekarang(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        
        // Simulasi transaksi untuk produk tunggal
        Transaksi::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'jumlah' => $request->jumlah,
            'total' => $product->harga * $request->jumlah,
            'status' => 'selesai', // status pembayaran
        ]);

        // Set pesan sukses
        Session::flash('success', 'Pembayaran berhasil!');

        // Redirect ke halaman keranjang setelah pembayaran
        return redirect()->route('keranjang.index');
    }
}
