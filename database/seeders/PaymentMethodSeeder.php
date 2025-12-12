<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            [
                'name' => 'Dinheiro',
                'slug' => 'dinheiro',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Pix',
                'slug' => 'pix',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Débito',
                'slug' => 'debito',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Crédito',
                'slug' => 'credito',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Transferência',
                'slug' => 'transferencia',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
