<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChurchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('churches')->insert([
            [
                'name' => 'Igreja 0101',
                'slug' => 'igreja-0101',
                'status' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Igreja-0201',
                'slug' => 'igreja-0201',
                'status' => 1,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
