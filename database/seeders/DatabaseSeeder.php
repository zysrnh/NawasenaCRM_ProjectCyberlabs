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
        // Create 5 Admin accounts with UNIQUE passwords
        $admins = [
            ['name' => 'Admin Nawasena 1', 'email' => 'admin1@nawasena.com', 'password' => '4Dm1nN4w4s3n4!1..'],
            ['name' => 'Admin Nawasena 2', 'email' => 'admin2@nawasena.com', 'password' => '4Dm1nN4w4s3n4!2..'],
            ['name' => 'Admin Nawasena 3', 'email' => 'admin3@nawasena.com', 'password' => '4Dm1nN4w4s3n4!3..'],
            ['name' => 'Admin Nawasena 4', 'email' => 'admin4@nawasena.com', 'password' => '4Dm1nN4w4s3n4!4..'],
            ['name' => 'Admin Nawasena 5', 'email' => 'admin5@nawasena.com', 'password' => '4Dm1nN4w4s3n4!5..'],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'password' => bcrypt($admin['password']),
                    'is_admin' => true,
                ]
            );
        }

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
