<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrNew(['email' => 'admin@framehaus.test']);

        $user->forceFill([
            'name' => 'Admin Framehaus',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'is_admin' => true,
        ])->save();
    }
}