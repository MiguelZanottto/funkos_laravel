<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
    ];

    public static function getNameById($id){
        $categoria = self::find($id);
        return $categoria ? $categoria->nombre : null;
    }

    public static function getIdByName($name){
        $categoria = self::where('nombre', $name)->first();
        return $categoria ? $categoria->id : null;
    }

    public static function getNames(){
        return self::pluck('nombre');
    }

    public function funkos()
    {
        return $this->hasMany(Funko::class);
    }
}
