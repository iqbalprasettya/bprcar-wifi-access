<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@bprcar.local',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@bprcar.local');
        $this->command->info('Password: admin123');
    }
}
