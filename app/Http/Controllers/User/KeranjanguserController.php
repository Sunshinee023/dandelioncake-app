<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Product; // Menambahkan model Product untuk mengambil data produk
use Illuminate\Support\Facades\Auth;

class KeranjanguserController extends Controller
{
    public function index()
    {
        $items = Keranjang::with('product')->where('pelanggan_id', Auth::id())->get();
        $totalHarga = $items->sum(function($item) {
            return $item->product->harga * $item->jumlah;
        });
        return view('keranjang', compact('items', 'totalHarga')); // tanpa .index
    }

    // Metode create untuk menampilkan form atau menyiapkan data produk
    public function create($id)
    {
        // Menampilkan form atau data produk berdasarkan ID
        $product = Product::findOrFail($id); // Ambil produk berdasarkan ID
        return view('user.add_to_cart', compact('product')); // Mengirim data produk ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1'
        ]);

        // Cek apakah produk sudah ada di keranjang user ini
        $existingCartItem = Keranjang::where('pelanggan_id', Auth::id()) // pastikan kolomnya pelanggan_id sesuai database kamu
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->jumlah += $request->quantity; // kolom jumlah sesuai database
            $existingCartItem->save();
        } else {
            Keranjang::create([
                'pelanggan_id' => Auth::id(),
                'product_id' => $request->product_id,
                'jumlah' => $request->quantity,
            ]);
        }

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }


    public function destroy($id)
    {
        // Mencari item keranjang berdasarkan id dan user_id
        $item = keranjang::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        // Menghapus item dari keranjang
        $item->delete();

        return redirect()->route('user.keranjang.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
