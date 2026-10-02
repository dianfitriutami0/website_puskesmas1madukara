<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL') ?: 'admin@puskesmas.test';
        $password = env('ADMIN_PASSWORD') ?: 'password123';

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin Puskesmas',
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]
        );
    }
}