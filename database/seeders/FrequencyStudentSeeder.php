<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrequencyStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('frequency_students')->insert(
            [
                [
                    'frequency_id' => 1,
                    'member_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'frequency_id' => 1,
                    'member_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }
}
