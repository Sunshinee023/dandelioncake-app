<?php
namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; 

class KeranjanguserController extends Controller
{
    public function index()
    {
        $userId = Session::get('user_id');  

        if (!$userId) {
            return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $keranjang = Keranjang::with('product')
            ->where('pelanggan_id', $userId)   
            ->get();

        return view('user.keranjang', compact('keranjang'));
    }
    
        public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $userId = Session::get('user_id');

        if (!$userId) {
            return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $productId = $request->product_id;
        $jumlah = $request->jumlah;

        // Ambil harga produk
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }
        $harga = $product->harga;

        $item = Keranjang::where('pelanggan_id', $userId)
                ->where('produk_id', $productId)
                ->first();

        $totalHarga = $harga * $jumlah;

        if ($item) {
            $item->jumlah += $jumlah;
            $item->total_harga = $item->jumlah * $harga; 
            $item->save();
        } else {
            Keranjang::create([
                'pelanggan_id' => $userId,
                'produk_id' => $productId,
                'jumlah' => $jumlah,
                'total_harga' => $totalHarga,  
            ]);
        }

        return redirect()->route('user.keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function hapusTerpilih(Request $request)
{
    $userId = session('user_id');
    if (!$userId) {
        return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $pelanggan = Pelanggan::where('user_id', $userId)->first();
    if (!$pelanggan) {
        return redirect()->route('user.keranjang.index')->with('error', 'Pelanggan tidak ditemukan.');
    }

    $produkIds = $request->input('produk_id', []);

    if (empty($produkIds)) {
        return redirect()->back()->with('error', 'Tidak ada produk yang dipilih.');
    }

    Keranjang::where('pelanggan_id', $pelanggan->id)
        ->whereIn('produk_id', $produkIds)
        ->delete();

    return redirect()->route('user.keranjang.index')->with('success', 'Produk terpilih berhasil dihapus.');
}

}