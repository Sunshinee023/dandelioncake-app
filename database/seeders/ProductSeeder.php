<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product')->insert([
            'nama_kue'  => 'cheesecuit',
            'varian_kue' => 'strawberry',
            'jumlah' => 28,
            'harga' => 30000
        ]);
        DB::table('product')->insert([
            'nama_kue'  => 'cheesecuit',
            'varian_kue' => 'coklat',
            'jumlah' => 15,
            'harga' => 30000
        ]);
        DB::table('product')->insert([
            'nama_kue'  => 'brownies',
            'varian_kue' => 'coklat',
            'jumlah' => 10,
            'harga' => 60000
        ]);
        DB::table('product')->insert([
            'nama_kue'  => 'cookies',
            'varian_kue' => 'lava cream',
            'jumlah' => 50,
            'harga' => 15000
        ]);
        DB::table('product')->insert([
            'nama_kue'  => 'cup cake',
            'varian_kue' => 'matcha',
            'jumlah' => 30,
            'harga' => 25000
        ]);
    }
}
