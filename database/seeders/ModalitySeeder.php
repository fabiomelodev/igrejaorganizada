<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modalities')->insert([
            'name' => 'Karate 01',
            'description' => 'Lorem ipsum',
            'schedules' => json_encode([
                'day' => 'saturday',
                'schedule' => '08h00'
            ]),
            'max_capacity' => 1,
            'is_active' => 1,
            'team_id' => 2,
            'project_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
