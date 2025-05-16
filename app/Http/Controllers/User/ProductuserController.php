<?
namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductuserController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12);
        return view('home', compact('product'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::query()
            ->where('nama_kue', 'like', "%{$keyword}%")
            ->orWhere('varian_kue', 'like', "%{$keyword}%")
            ->paginate(12);

        return view('home', compact('products', 'keyword'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('produk.show', compact('product'));
    }
}
