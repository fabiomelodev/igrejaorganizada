<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            TeamSeeder::class,
            TeamUserSeeder::class,
            PlanSeeder::class,
            FeatureSeeder::class,
            PlanFeatureSeeder::class,
            PositionSeeder::class,
            MemberSeeder::class,
            TeamMemberSeeder::class
            // PaymentMethodSeeder::class,
            // CategorySeeder::class
            // SchoolSeeder::class,
            // LessonSeeder::class,
            // CultSeeder::class
            // LessonStudentSeeder::class,
            // FrequencySeeder::class,
            // FrequencyStudentSeeder::class,
        ]);

    }
}
