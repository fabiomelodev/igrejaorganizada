<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('frequencies')->insert([
            [
                'date' => '2025-11-05',
                'lesson_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
