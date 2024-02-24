<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'miguel',
                'email' => 'miguelzanotto@admin.es',
                'password' => bcrypt('Mi25540443'),
                'role' => 'admin',
            ],
            [
                'name' => 'usuario',
                'email' => 'usuario@user.es',
                'password' => bcrypt('Mi25540443'),
                'role' => 'user',
            ],
        ]);
    }
}
