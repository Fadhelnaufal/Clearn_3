<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_types')->insert([
            ['name' => 'Overachiever','image' => 'MApr.png'],
            ['name' => 'Mastery Expert','image' => 'MAvo.png'],
            ['name' => 'Best Performance','image' => 'PApr.png'],
            ['name' => 'Nonachiever','image' => 'PAvo.png'],
        ]);
    }
}
