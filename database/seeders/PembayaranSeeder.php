<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pembayaran')->insert([
            [
                'pelanggan_id' => 1,
                'total_harga' => 120000,
                'metode_pembayaran' => 'Transfer Bank',
                'alamat_pengiriman' => 'Jl. Merdeka No.1',
                'status' => 'selesai',
                'tanggal_checkout' => Carbon::now()->subDays(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pelanggan_id' => 2,
                'total_harga' => 250000,
                'metode_pembayaran' => 'COD',
                'alamat_pengiriman' => 'Jl. Pahlawan No.2',
                'status' => 'dikirim',
                'tanggal_checkout' => Carbon::now()->subDays(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pelanggan_id' => 3,
                'total_harga' => 175000,
                'metode_pembayaran' => 'E-Wallet',
                'alamat_pengiriman' => 'Jl. Kenanga No.3',
                'status' => 'pending',
                'tanggal_checkout' => Carbon::now()->subDays(15),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
