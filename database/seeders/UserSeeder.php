<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                \App\Models\User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@app.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'store_id' => null,
            ],
            [
                'name' => 'Store A',
                'email' => 'storea@app.com',
                'password' => Hash::make('12345678'),
                'role' => 'staff',
                'store_id' => 1,
            ],
            [
                'name' => 'Store B',
                'email' => 'storeb@app.com',
                'password' => Hash::make('12345678'),
                'role' => 'staff',
                'store_id' => 2,
            ],
        ]);
    }
}
