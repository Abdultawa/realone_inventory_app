<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    // Create or fetch a user
    $user = User::first() ?? User::factory()->create();

    Store::insert([
        [
            'name' => 'Store A',
            'description' => 'Main Office',
            'user_id' => $user->id,
        ],
        [
            'name' => 'Store B',
            'description' => 'Branch Office',
            'user_id' => $user->id,
        ],
    ]);
}

}
