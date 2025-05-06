<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\KeranjangSeeder;
use Database\Seeders\TransaksiSeeder;
use Database\Seeders\PembayaranSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([ProductSeeder::class]);
        $this->call([UserSeeder::class]);
        $this->call([PembayaranSeeder::class]);
        $this->call([TransaksiSeeder::class]);
        $this->call([KeranjangSeeder::class]);
        
        
    }
}
