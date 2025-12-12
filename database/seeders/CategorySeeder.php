<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Venda',
                'slug' => 'venda',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Dízimo',
                'slug' => 'Dízimo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
