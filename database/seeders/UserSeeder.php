<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Toko ABC',
            'email' => 'abc@gmail.com',
            'password' => Hash::make('12345'),
            'email_verified_at' => now(),
            'role' => 'seller',
        ]);

        User::create([
            'name' => 'vio salman',
            'email' => 'vio@gmail.com',
            'password' => Hash::make('12345'),
            'email_verified_at' => now(),
            'role' => 'buyer',
        ]);

        User::create([
            'name' => 'rayhan ardani',
            'email' => 'rayhan@gmail.com',
            'password' => Hash::make('12345'),
            'email_verified_at' => now(),
            'role' => 'buyer',
        ]);
    }
}
