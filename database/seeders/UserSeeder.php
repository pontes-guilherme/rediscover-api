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
        \App\Models\User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@rediscover.com',
            'password' => Hash::make('qwer1234'),
        ]);
    }
}
