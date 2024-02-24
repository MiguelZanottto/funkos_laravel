<?php

namespace Database\Seeders;

use App\Models\Funko;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FunkosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('funkos')->insert([
            [
                'nombre' => 'Cristiano Ronaldo',
                'precio' => 99.99,
                'cantidad' => 50,
                'imagen' => 'https://files.cults3d.com/uploaders/14409669/illustration-file/6f9e9aab-b0d0-4a86-a01f-2078a099758e/744.jpg',
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Vinicius Junior',
                'precio' => 14.99,
                'cantidad' => 75,
                'imagen' => 'https://cdn.wallapop.com/images/10420/fr/p6/__/c10420p953516829/i3589150702.jpg?pictureSize=W640',
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Mbappe',
                'precio' => 49.99,
                'cantidad' => 33,
                'imagen' => 'https://i5.walmartimages.com.mx/mg/gm/1p/images/product-images/img_large/00088969842796l.jpg?odnHeight=612&odnWidth=612&odnBg=FFFFFF',
                'categoria_id' => 3,
            ],
            [
                'nombre' => 'Erling Haarland',
                'precio' => 19.99,
                'cantidad' => 22,
                'imagen' => 'https://acdn.mitiendanube.com/stores/002/294/590/products/haaland-133a46116d6c05085a16992940795851-1024-1024.jpeg',
                'categoria_id' => 4,
            ],
            [
                'nombre' => 'Neymar',
                'precio' => 13.99,
                'cantidad' => 15,
                'imagen' => 'https://cdn.idealo.com/folder/Product/200814/3/200814367/s11_produktbild_gross/funko-pop-football-paris-saint-germain-neymar.jpg',
                'categoria_id' => 3,
            ],
            [
                'nombre' => 'Messi',
                'precio' => 19.99,
                'cantidad' => 40,
                'imagen' => 'https://files.cults3d.com/uploaders/14001561/illustration-file/a29a992e-00ac-4ae4-a731-57a161e1ca89/publicidadmessi.jpg',
                'categoria_id' => 3,
            ],
        ]);
    }
}

