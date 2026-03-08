<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            'name' => 'Projeto 01',
            'description' => 'Lorem ipsum',
            'is_active' => 1,
            'team_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
