<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('features')->insert([
            [
                'name' => 'Classes',
                'key' => 'lesson_module',
                'type' => 'limit',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Culto',
                'key' => 'cult_module',
                'type' => 'boolean',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Escola',
                'key' => 'school_module',
                'type' => 'boolean',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Membros',
                'key' => 'member_module',
                'type' => 'limit',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
