<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pelanggan')->insert([
            [
                'nama' => 'Admin',
                'alamat' => 'Jl. Admin No.1',
                'telepon' => '081234567890',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Jaemin',
                'alamat' => 'Jl. Seoul No.10',
                'telepon' => '082233445566',
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Jung Jaehyun',
                'alamat' => 'Jl. Gangnam No.20',
                'telepon' => '081223344556',
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sim Jaeyun',
                'alamat' => 'Jl. Busan No.5',
                'telepon' => '083344556677',
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Joong Archen Aydin',
                'alamat' => 'Jl. Bangkok No.15',
                'telepon' => '081122334455',
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
