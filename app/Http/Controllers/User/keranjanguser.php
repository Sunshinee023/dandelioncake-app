<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class KeranjanguserController extends Controller
{
    public function index()
    {
        $items = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('user.keranjang', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id',
            'quantity' => 'required|integer|min:1'
        ]);

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);

        return redirect()->route('user.keranjang.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function destroy($id)
    {
        $item = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $item->delete();

        return redirect()->route('user.keranjang.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
