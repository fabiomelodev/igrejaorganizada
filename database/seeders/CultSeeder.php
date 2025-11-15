<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cults')->insert([
            [
                'name' => 'Culto de quarta',
                'week' => 'wednesday',
                'start_time' => '19:00',
                'end_time' => '21:00',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Culto de domingo',
                'week' => 'sunday',
                'start_time' => '19:00',
                'end_time' => '21:00',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
