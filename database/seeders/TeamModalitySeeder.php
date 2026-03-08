<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('team_modalities')->insert([
            'team_id' => 2,
            'modality_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
