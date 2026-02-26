<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert([
            [
                'name' => 'Visitante',
                'is_active' => 1,
                'team_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Pastor 0101',
                'is_active' => 1,
                'team_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Presbitero 0101',
                'is_active' => 1,
                'team_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
