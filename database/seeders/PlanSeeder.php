<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'name' => 'Plano Gratuito',
                'slug' => 'plano-gratuito',
                'price' => '0.00',
                'stripe_price_id' => 'price_1ScXN1L07b0hdFUEHitJwbK5',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Plano Completo',
                'slug' => 'plano-completo',
                'price' => '99.90',
                'stripe_price_id' => 'price_1T31B7L07b0hdFUEOYedFwUV',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
