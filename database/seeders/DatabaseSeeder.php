<?php

namespace Database\Seeders;

use App\Models\Frequency;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            // ShieldSeeder::class,
            ChurchSeeder::class,
            PositionSeeder::class,
            MemberSeeder::class,
            SchoolSeeder::class,
            LessonSeeder::class,
            // CultSeeder::class
            // LessonStudentSeeder::class,
            // FrequencySeeder::class,
            // FrequencyStudentSeeder::class,
        ]);
    }
}
