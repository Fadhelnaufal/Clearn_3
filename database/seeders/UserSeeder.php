<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Create users
       $admin = User::create([
        'name' => 'Admin',
        'email' => 'admin@edmon.com',
        'password' => Hash::make('admin'),
    ]);

    $guru = User::create([
        'name' => 'Guru',
        'email' => 'guru@gmail.com',
        'password' => Hash::make('guru123'),
    ]);

    $siswa = User::create([
        'name' => 'Siswa',
        'email' => 'siswa@gmail.com',
        'password' => Hash::make('siswa123'),
    ]);

    // Assign roles
    $admin->assignRole('admin');
    $guru->assignRole('guru');
    $siswa->assignRole('siswa');
    }
}
