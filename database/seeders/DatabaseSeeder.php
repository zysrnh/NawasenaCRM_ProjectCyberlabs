<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        User::updateOrCreate(
            ['email' => 'admin@nawasena.com'],
            [
                'name' => 'Admin Nawasena',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );

        // Create 5 unique accounts
        for ($i = 1; $i <= 5; $i++) {
            User::updateOrCreate(
                ['email' => 'user' . $i . '@nawasena.com'],
                [
                    'name' => 'User ' . $i,
                    'password' => bcrypt('password' . $i),
                    'is_admin' => false,
                ]
            );
        }
    }
}
