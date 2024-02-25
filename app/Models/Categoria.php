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

    public function actualizarFunkosSinCategoria($id)
    {
        $funkos = Funko::where('categoria_id', $id)->get();

        if ($funkos->count() > 0) {
            foreach ($funkos as $funko) {
                $funko->categoria_id = 5;
                $funko->save();
            }
        }
    }

    public static function getNames(){
        return self::pluck('nombre');
    }

    public function scopeBuscar($query, $buscar){
        return $query->whereRaw('LOWER(nombre) LIKE ?', ["%" . strtolower($buscar) . "%"]);
    }

    public function funkos()
    {
        return $this->hasMany(Funko::class);
    }
}
