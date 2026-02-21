<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('team_members')->insert([
            [
                'team_id' => 2,
                'member_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'team_id' => 2,
                'member_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'team_id' => 2,
                'member_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
