<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChurchableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('churchables')->insert([
            [
                'church_id' => 1,
                'churchable_id' => 1,
                'churchable_type' => 'App\Models\Member',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'church_id' => 2,
                'churchable_id' => 2,
                'churchable_type' => 'App\Models\Member',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'church_id' => 1,
                'churchable_id' => 1,
                'churchable_type' => 'App\Models\Position',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'church_id' => 2,
                'churchable_id' => 2,
                'churchable_type' => 'App\Models\Position',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
