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
    User::firstOrCreate(
        ['email' => env('ADMIN_EMAIL', 'admin@user.com')],
        [
            'name' => 'Admin User',
            'password' => bcrypt(env('ADMIN_PASSWORD', 'bypassword123')),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]
    );
}
}