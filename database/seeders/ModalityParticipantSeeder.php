<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalityParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modality_participants')->insert([
            'modality_id' => 1,
            'participant_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
