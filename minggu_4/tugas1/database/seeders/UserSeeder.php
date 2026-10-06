<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'budi',
            'password' => Hash::make('rahasia123'),
            'nama_lengkap' => 'Budi Santoso',
        ]);

        User::create([
            'username' => 'andi',
            'password' => Hash::make('password123'),
            'nama_lengkap' => 'Andi Pratama',
        ]);
    }
}