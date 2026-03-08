<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('participants')->insert([
            'name' => 'João 01',
            'email' => 'joao01@gmail.com',
            'phone' => '11999999999',
            'birthdate' => '2000-01-01',
            'is_internal' => 0,
            'is_active' => 1,
            'health_observations' => null,
            'health_reports' => null,
            'member_id' => null,
            'responsible_id' => null,
            'team_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
