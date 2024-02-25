<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['nombre' => 'REAL MADRID'],
            ['nombre' => 'BARCELONA'],
            ['nombre' => 'PSG'],
            ['nombre' => 'MANCHESTER CITY'],
            ['nombre' => 'SIN CATEGORIA']
        ]);
    }
}
