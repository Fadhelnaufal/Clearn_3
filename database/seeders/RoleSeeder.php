<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'admin','guard_name' => 'web',],
            ['name' => 'guru','guard_name' => 'web',],
            ['name' => 'siswa','guard_name' => 'web',],
            ['name' => 'guest','guard_name' => 'web',]
        ]
    );
    }
}
