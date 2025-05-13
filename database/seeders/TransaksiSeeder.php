<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('transaksi')->insert([
            [
                'pelanggan_id' => 2,
                'produk_id' => 1, // Sesuaikan dengan ID produk yang ada di tabel product
                'tanggal_transaksi' => now()->subDays(5),
                'total_harga' => 120000,
                'status' => 'selesai', // Status yang valid
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pelanggan_id' => 2,
                'produk_id' => 2, // Sesuaikan dengan ID produk yang ada di tabel product
                'tanggal_transaksi' => now()->subDays(10),
                'total_harga' => 250000,
                'status' => 'dikirim', // Status yang valid
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pelanggan_id' => 3,
                'produk_id' => 3, // Sesuaikan dengan ID produk yang ada di tabel product
                'tanggal_transaksi' => now()->subDays(15),
                'total_harga' => 175000,
                'status' => 'pending', // Status yang valid
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
