<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder Mahasiswa (User)
        User::updateOrCreate(
            ['email' => 'user@example.com'], // Cegah duplikasi
            [
                'name'   => 'Mahasiswa Demo',
                'nim'    => '2303110000',
                'email'  => 'user@example.com',
                'faculty' => 'FMIPA',
                'major'   => 'Sistem Informasi',
                'password' => Hash::make('password'),
                'role' => 'user'
            ]
        );
    }
}