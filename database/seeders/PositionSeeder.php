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
                'name'       => 'Pastor 0101',
                'status'     => 1,
                'team_id'    => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name'       => 'Pastor 0201',
                'status'     => 1,
                'team_id'    => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
