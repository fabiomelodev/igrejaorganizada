<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schools')->insert([
            [
                'name'        => 'Escola 0101',
                'description' => 'Descrição 0101',
                'status'      => 1,
                'church_id'   => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            [
                'name'        => 'Escola 0201',
                'description' => 'Descrição 0201',
                'status'      => 1,
                'church_id'   => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
