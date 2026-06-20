<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

#[Signature('make:admin {email?} {--password=}')]
#[Description('Create an admin user')]
class CreateAdmin extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?? $this->ask('Admin email address?');
        $password = $this->option('password') ?? $this->secret('Admin password?');

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update(['is_admin' => true]);
            $this->info("User {$email} is now an admin.");
            return;
        }

        $name = $this->ask('Admin name?');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true,
        ]);

        $this->info("Admin user {$email} created successfully.");
    }
}
