<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('admin123'),
        'role' => 'admin',
    ]);

    User::create([
        'name' => 'Maliki',
        'email' => 'maliki@gmail.com',
        'password' => Hash::make('maliki123'),
        'role' => 'user',
    ]);
    }
}
