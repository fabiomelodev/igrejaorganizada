<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teams')->insert([
            [
                'name' => 'Geral',
                'slug' => 'geral'
            ],

            // [
            //     'name' => 'Igreja 0201',
            //     'slug' => 'igreja-0201'
            // ],
        ]);
    }
}
