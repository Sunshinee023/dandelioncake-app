<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com', 
                'password' => Hash::make('admin1234'),
                'created_at' => now(),
                'updated_at' => now(),
                
            ],
            [
                'name' => 'Jaemin',
                'email' => 'jaemin@gmail.com',
                'password' => Hash::make('jaemin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jung Jaehyun',
                'email' => 'jaehyun@gmail.com',
                'password' => Hash::make('jaehyun123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sim Jaeyun',
                'email' => 'jaeyun@gmail.com',
                'password' => Hash::make('jake123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Joong Archen Aydin',
                'email' => 'joong@gmail.com',
                'password' => Hash::make('archen123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
