<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'       => 'Fabio Melo',
                'email'      => 'fabiomelodev@gmail.com',
                'password'   => bcrypt('homolog123'),
                'status'     => 1,
                'church_id'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name'       => 'Usuário 0101',
                'email'      => 'usuario0101@gmail.com',
                'password'   => bcrypt('homolog123'),
                'status'     => 1,
                'church_id'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name'       => 'Usuário 0102',
                'email'      => 'usuario0102@gmail.com',
                'password'   => bcrypt('homolog123'),
                'status'     => 1,
                'church_id'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name'       => 'Usuário 0201',
                'email'      => 'usuario0201@gmail.com',
                'password'   => bcrypt('homolog123'),
                'status'     => 1,
                'church_id'  => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name'       => 'Usuário 0202',
                'email'      => 'usuario0202@gmail.com',
                'password'   => bcrypt('homolog123'),
                'status'     => 1,
                'church_id'  => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
