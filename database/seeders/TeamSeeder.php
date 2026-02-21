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
                'slug' => 'geral',
                'is_active' => 1,
                'plan_id' => 1,
                'stripe_id' => 'cus_U1381JB1oB4g02',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Igreja Batista 01',
                'slug' => 'igreja-batista-01',
                'is_active' => 1,
                'plan_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
