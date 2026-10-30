<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '081234567890',
            'role' => 'Admin',
        ]);

        User::factory()->create([
            'name' => 'Penyewa Satu',
            'email' => 'penyewa@example.com',
            'phone' => '081298765432',
            'role' => 'Penyewa',
            'password' => Hash::make('password'),
        ]);
    }
}