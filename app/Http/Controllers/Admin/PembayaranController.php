<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pelanggan;

class PembayaranController extends Controller
{
    public function index() {
        $pembayaran = Pembayaran::with('pelanggan')->get();
        return view('admin.pembayaran', compact('pembayaran'));
    }

    public function create() {
        return view('admin.pembayaranCreate', [
            'pelanggan' => Pelanggan::all(),
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'total_harga' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
            'alamat_pengiriman' => 'required|string',
            'status' => 'required|in:pending,diproses,dikirim,selesai',
        ]);

        Pembayaran::create($validated);

        return redirect('/pembayaran')->with('success', 'Pembayaran berhasil ditambahkan');
    }

    public function edit($id) {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('admin.pembayaranEdit', [
            'pembayaran' => $pembayaran,
            'pelanggan' => Pelanggan::all(),
        ]);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'total_harga' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
            'alamat_pengiriman' => 'required|string',
            'status' => 'required|in:pending,diproses,dikirim,selesai',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($validated);

        return redirect('/pembayaran')->with('success', 'Data pembayaran berhasil diubah');
    }

    public function destroy($id) {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect('/pembayaran')->with('success', 'Data pembayaran berhasil dihapus');
    }
}
