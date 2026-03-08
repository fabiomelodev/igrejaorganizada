<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('team_projects')->insert([
            'team_id' => 2,
            'project_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
