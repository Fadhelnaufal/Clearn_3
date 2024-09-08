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
            ['name' => 'Overachiever','image' => 'overachiever.png'],
            ['name' => 'Mastery Expert','image' => 'mastery-expert.png'],
            ['name' => 'Best Performance','image' => 'best-performance.png'],
            ['name' => 'Nonachiever','image' => 'non-achiever.png'],
        ]);
    }
}
