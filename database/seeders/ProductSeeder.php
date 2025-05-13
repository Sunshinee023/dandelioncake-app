<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product')->insert([
            'gambar' => 'https://cdn.pixabay.com/photo/2019/09/05/13/53/sweets-4454098_1280.jpg', // Link gambar untuk produk
            'nama_kue' => 'cheesecuit',
            'varian_kue' => 'strawberry',
            'stok' => 28,
            'harga' => 30000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product')->insert([
            'gambar' => 'https://cdn.pixabay.com/photo/2019/09/05/13/53/sweets-4454098_1280.jpg', // Link gambar untuk produk
            'nama_kue' => 'cheesecuit',
            'varian_kue' => 'coklat',
            'stok' => 15,
            'harga' => 30000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product')->insert([
            'gambar' => 'https://example.com/images/brownies-coklat.jpg', // Link gambar untuk produk
            'nama_kue' => 'brownies',
            'varian_kue' => 'coklat',
            'stok' => 10,
            'harga' => 60000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product')->insert([
            'gambar' => 'https://example.com/images/cookies-lava-cream.jpg', // Link gambar untuk produk
            'nama_kue' => 'cookies',
            'varian_kue' => 'lava cream',
            'stok' => 50,
            'harga' => 15000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product')->insert([
            'gambar' => 'https://example.com/images/cup-cake-matcha.jpg', // Link gambar untuk produk
            'nama_kue' => 'cup cake',
            'varian_kue' => 'matcha',
            'stok' => 30,
            'harga' => 25000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
