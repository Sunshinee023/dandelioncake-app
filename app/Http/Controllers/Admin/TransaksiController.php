<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Pembayaran;

class TransaksiController extends Controller
{
    public function index()
{
    $transaksi = Transaksi::with(['pelanggan', 'pembayaran', 'product'])->get();
    return view('admin.transaksi', compact('transaksi'));
}
 

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $pembayaran = Pembayaran::all();
        return view('admin.transaksiCreate', compact('pelanggan', 'pembayaran'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'pembayaran_id' => 'required|exists:pembayaran,id',
            'total_harga' => 'required|numeric',
            'status' => 'required|in:pending,diproses,dikirim,selesai',
            'tanggal_transaksi' => 'nullable|date',
        ]);

        Transaksi::create($validated);

        return redirect('/transaksi')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $pelanggan = Pelanggan::all();
        $pembayaran = Pembayaran::all();
        return view('admin.transaksiEdit', compact('transaksi', 'pelanggan', 'pembayaran'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'pembayaran_id' => 'required|exists:pembayaran,id',
            'total_harga' => 'required|numeric',
            'status' => 'required|in:pending,diproses,dikirim,selesai',
            'tanggal_transaksi' => 'nullable|date',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($validated);

        return redirect('/transaksi')->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect('/transaksi')->with('success', 'Transaksi berhasil dihapus');
    }
}
