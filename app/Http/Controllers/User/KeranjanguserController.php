<?php
namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;  // <-- Import di sini, di atas

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
            $item->total_harga = $item->jumlah * $harga;  // update total_harga
            $item->save();
        } else {
            Keranjang::create([
                'pelanggan_id' => $userId,
                'produk_id' => $productId,
                'jumlah' => $jumlah,
                'total_harga' => $totalHarga,   // pastikan total_harga diisi
            ]);
        }

        return redirect()->route('user.keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function hapusTerpilih(Request $request)
{
    $userId = Session::get('user_id');

    if (!$userId) {
        return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $selectedItems = $request->input('selected_items', []);

    if (empty($selectedItems)) {
        return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
    }

    Keranjang::where('pelanggan_id', $userId)
        ->whereIn('id', $selectedItems)
        ->delete();

    return redirect()->route('user.keranjang.index')->with('success', 'Data terpilih berhasil dihapus.');
}

}