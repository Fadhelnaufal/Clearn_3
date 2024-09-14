<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        'name' => 'tes1',
        'email' => 'test1@gmail.com',
        'password' => Hash::make('test1'),
        ]);

        User::create([
        'name' => 'tes2',
        'email' => 'test2@gmail.com',
        'password' => Hash::make('test2'),
        ]);

        User::create([
        'name' => 'tes3',
        'email' => 'test3@gmail.com',
        'password' => Hash::make('test3'),
        ]);
    }
}
