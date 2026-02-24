<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::factory(8)->create();

        // DB::table('members')->insert([
        //     [
        //         'name' => 'Membro 0101',
        //         'email' => 'membro0101@gmail.com',
        //         'phone' => '123-456-7890',
        //         'birthdate' => '1990-01-01',
        //         'address' => '123 Main St',
        //         'gender' => 'masculine',
        //         'status' => 1,
        //         'team_id' => 2,
        //         'position_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     [
        //         'name' => 'Membro 0102',
        //         'email' => 'membro0102@gmail.com',
        //         'phone' => '123-456-7890',
        //         'birthdate' => '1990-01-01',
        //         'address' => '123 Main St',
        //         'gender' => 'masculine',
        //         'status' => 1,
        //         'team_id' => 2,
        //         'position_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     [
        //         'name' => 'Membro 0201',
        //         'email' => 'membro0201@gmail.com',
        //         'phone' => '987-654-3210',
        //         'birthdate' => '1992-02-02',
        //         'address' => '456 Elm St',
        //         'gender' => 'feminine',
        //         'status' => 1,
        //         'team_id' => 2,
        //         'position_id' => 2,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);
    }
}
