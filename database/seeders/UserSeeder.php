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
        // SELLER ID 1
        User::create([
            'name' => 'Toko abc',
            'email' => 'abc@gmail.com',
            'password' => Hash::make('12345'),
            'email_verified_at' => now(),
            'role' => 'seller',
            'is_open' => 1
        ]);

        // SELLER ID 2
        User::create([
            'name' => 'Toko xyz',
            'email' => 'xyz@gmail.com',
            'password' => Hash::make('12345'),
            'email_verified_at' => now(),
            'role' => 'seller',
            'is_open' => 0
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345'),
            'email_verified_at' => now(),
            'role' => 'admin',
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

        User::create([
            'name' => 'Junhaikal',
            'email' => 'junha@gmail.com',
            'password' => Hash::make('12345'),
            'email_verified_at' => now(),
            'role' => 'buyer',
        ]);
        User::create([
            'name' => 'Nadya',
            'email' => 'nadya@gmail.com',
            'password' => Hash::make('12345'),
            'email_verified_at' => now(),
            'role' => 'buyer',
        ]);
    }
}
