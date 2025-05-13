<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KeranjangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('keranjang')->insert([
            [
                'pelanggan_id' => 5, 
                'produk_id' => 1, 
                'jumlah' => 2,
                'total_harga' => 60000.00, // 2 x 30000
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pelanggan_id' => 2, 
                'produk_id' => 2,
                'jumlah' => 1,
                'total_harga' => 30000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pelanggan_id' => 2, 
                'produk_id' => 3,
                'jumlah' => 3,
                'total_harga' => 180000.00, // 3 x 60000
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pelanggan_id' => 3, 
                'produk_id' => 4,
                'jumlah' => 5,
                'total_harga' => 75000.00, // 5 x 15000
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pelanggan_id' => 3, 
                'produk_id' => 5,
                'jumlah' => 2,
                'total_harga' => 50000.00, // 2 x 25000
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
