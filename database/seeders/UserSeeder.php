<?php

namespace Database\Seeders;

use App\Models\User;
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
        $userSuperAdmin = User::create([
            'name' => 'Fabio Melo',
            'email' => 'fabiomelodev@gmail.com',
            'password' => bcrypt('homolog123'),
            'status' => 1,
            'team_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if (!$userSuperAdmin->hasRole('super_admin')) {
            $userSuperAdmin->assignRole('super_admin');
        }

        $user = User::create([
            'name' => 'João Batista 01',
            'email' => 'joaobatista01@gmail.com',
            'password' => bcrypt('homolog123'),
            'status' => 1,
            'team_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if (!$user->hasRole('Administrador')) {
            $user->assignRole('Administrador');
        }
    }
}
