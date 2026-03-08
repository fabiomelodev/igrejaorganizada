<?php

namespace Database\Seeders;

use App\Models\PlanFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plan_features')->insert([
            [
                'plan_id' => 1,
                'feature_id' => 1,
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 1,
                'feature_id' => 2,
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 1,
                'feature_id' => 3,
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 1,
                'feature_id' => 4,
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 1,
                'feature_id' => 5,
                'value' => '5',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 1,
                'feature_id' => 6,
                'value' => '-1',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 1,
                'feature_id' => 7,
                'value' => '3',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 1,
                'feature_id' => 8,
                'value' => '10',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 2,
                'feature_id' => 1,
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 2,
                'feature_id' => 2,
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 2,
                'feature_id' => 3,
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 2,
                'feature_id' => 4,
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 2,
                'feature_id' => 5,
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 2,
                'feature_id' => 6,
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 2,
                'feature_id' => 7,
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 2,
                'feature_id' => 8,
                'value' => '10',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 2,
                'feature_id' => 9,
                'value' => '10',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 2,
                'feature_id' => 10,
                'value' => '10',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 2,
                'feature_id' => 11,
                'value' => '10',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 2,
                'feature_id' => 12,
                'value' => '10',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 2,
                'feature_id' => 13,
                'value' => '10',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'plan_id' => 2,
                'feature_id' => 14,
                'value' => '10',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
