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
                'name' => 'Módulo de Cultos',
                'key' => 'cult_module',
                'type' => 'boolean',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Módulo de Aulas',
                'key' => 'lesson_module',
                'type' => 'boolean',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Módulo de Membros',
                'key' => 'member_module',
                'type' => 'boolean',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Módulo de Modalidades',
                'key' => 'modality_module',
                'type' => 'boolean',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Módulo de Participantes',
                'key' => 'participant_module',
                'type' => 'boolean',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Módulo de Projetos',
                'key' => 'project_module',
                'type' => 'boolean',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Módulo de Escolas',
                'key' => 'school_module',
                'type' => 'boolean',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Limite de Cultos',
                'key' => 'cult_limit',
                'type' => 'limit',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Limite de Aulas',
                'key' => 'lesson_limit',
                'type' => 'limit',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Limite de Membros',
                'key' => 'member_limit',
                'type' => 'limit',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Limite de Modalidades',
                'key' => 'modality_limit',
                'type' => 'limit',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Limite de Participantes',
                'key' => 'participant_limit',
                'type' => 'limit',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Limite de Projetos',
                'key' => 'project_limit',
                'type' => 'limit',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Limite de Escolas',
                'key' => 'school_limit',
                'type' => 'limit',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
