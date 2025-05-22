<?php

namespace App\Http\Controllers\User;

use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PembayaranuserController extends Controller
{
    public function index()
{
    $userId = session('user_id');
    if (!$userId) {
        return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $pelanggan = Pelanggan::with('user')->where('user_id', $userId)->firstOrFail();

    // Ambil transaksi yang belum dibayar (status transaksi belum selesai atau pembayaran belum ada)
    $transaksi = \App\Models\Transaksi::with('product')
        ->where('pelanggan_id', $pelanggan->id)
        ->where('status', 'pending') // atau kondisi lain yang menandakan transaksi belum dibayar
        ->get();

    // Kalau kamu mau tampilin pembayaran juga (yang sudah dibuat), bisa ambil disini
    $pembayaran = Pembayaran::with(['product'])
        ->where('pelanggan_id', $pelanggan->id)
        ->get();

    return view('user.pembayaran', compact('pelanggan', 'transaksi', 'pembayaran'));
}


    public function bayar(Request $request, $id)
{
    $request->validate([
        'metode_pembayaran' => 'required',
        'detail_metode' => 'nullable|string|max:255',
    ]);

    $userId = $request->session()->get('user_id');

    if (!$userId) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }

    $transaksi = Transaksi::with(['pelanggan', 'product'])->findOrFail($id);

    if ($transaksi->pelanggan->user_id !== $userId) {
        abort(403, 'Unauthorized action.');
    }

    // Cek apakah transaksi sudah dibayar
    $sudahDibayar = Pembayaran::where('transaksi_id', $transaksi->id)->exists();
    if ($sudahDibayar) {
        return redirect()->back()->with('error', 'Transaksi ini sudah dibayar.');
    }

    // Buat data pembayaran baru
    $pembayaran = new Pembayaran();
    $pembayaran->pelanggan_id = $transaksi->pelanggan_id;
    $pembayaran->produk_id = $transaksi->produk_id;
    $pembayaran->transaksi_id = $transaksi->id;
    $pembayaran->total_harga = $transaksi->total_harga;
    $pembayaran->metode_pembayaran = $request->metode_pembayaran;
    $pembayaran->alamat_pengiriman = $transaksi->pelanggan->alamat ?? 'Alamat tidak tersedia';
    $pembayaran->status_pembayaran = 'sudah dibayar';

    $pembayaran->save();

    // Update status transaksi jadi 'diproses'
    $transaksi->status = 'diproses';
    $transaksi->save();

    return redirect()->route('user.pembayaran.index')->with('success', 'Pembayaran berhasil!');
}


}
