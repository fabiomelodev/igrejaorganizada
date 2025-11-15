<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChurchAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('church_admins')->insert([
            [
                'church_id' => 1,
                'user_id' => 2,
            ],

            [
                'church_id' => 1,
                'user_id' => 3,
            ],
        ]);
    }
}
