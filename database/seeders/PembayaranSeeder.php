<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PembayaranSeeder extends Seeder
{
    public function run(): void
{
    $transaksi = DB::table('transaksi')->get();
    $produk = DB::table('product')->get();
    $pelanggan = DB::table('pelanggan')->get();

    DB::table('pembayaran')->insert([
        [
            'pelanggan_id' => $pelanggan[0]->id,
            'produk_id' => $produk[0]->id,
            'transaksi_id' => $transaksi[0]->id,
            'total_harga' => 120000.00,
            'metode_pembayaran' => 'Transfer Bank',
            'alamat_pengiriman' => 'Jl. Merdeka No.1',
            'status_pembayaran' => 'sudah dibayar',
            'tanggal_checkout' => now()->subDays(5),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'pelanggan_id' => $pelanggan[2]->id,
            'produk_id' => $produk[1]->id,
            'transaksi_id' => $transaksi[1]->id,
            'total_harga' => 250000.00,
            'metode_pembayaran' => 'COD',
            'alamat_pengiriman' => 'Jl. Pahlawan No.2',
            'status_pembayaran' => 'sudah dibayar', // Hindari 'dikirim' jika bukan status valid
            'tanggal_checkout' => now()->subDays(10),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'pelanggan_id' => $pelanggan[2]->id,
            'produk_id' => $produk[2]->id,
            'transaksi_id' => $transaksi[2]->id,
            'total_harga' => 175000.00,
            'metode_pembayaran' => 'E-Wallet',
            'alamat_pengiriman' => 'Jl. Kenanga No.3',
            'status_pembayaran' => 'pending',
            'tanggal_checkout' => now()->subDays(15),
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
}
}
