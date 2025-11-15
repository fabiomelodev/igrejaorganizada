<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lessons')->insert([
            [
                'name'        => 'Classe 0101',
                'description' => 'Descrição...',
                'period'      => 'quarter',
                'time'        => 'morning',
                'progress'    => 'course',
                'status'      => 1,
                'church_id'   => 1,
                'school_id'   => 1,
                'teacher_id'  => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Classe 0201',
                'description' => 'Descrição...',
                'period'      => 'quarter',
                'time'        => 'morning',
                'progress'    => 'course',
                'status'      => 1,
                'church_id'   => 2,
                'school_id'   => 2,
                'teacher_id'  => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
