<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            UserSeeder::class,
            TeamSeeder::class,
            TeamUserSeeder::class,
            // PositionSeeder::class,
            // MemberSeeder::class,
            // SchoolSeeder::class,
            // LessonSeeder::class,
            // CultSeeder::class
            // LessonStudentSeeder::class,
            // FrequencySeeder::class,
            // FrequencyStudentSeeder::class,
        ]);
    }
}
