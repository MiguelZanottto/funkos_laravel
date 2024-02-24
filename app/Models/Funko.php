<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funko extends Model
{
    public static string $IMAGE_DEFAULT = 'https://static.vecteezy.com/system/resources/previews/005/337/799/non_2x/icon-image-not-found-free-vector.jpg';
    protected $table = 'funkos';

    protected $hidden = [
        'isDeleted',
    ];

    protected $casts = [
        'isDeleted' => 'boolean',
    ];

    protected $fillable = [
        'nombre',
        'precio',
        'cantidad',
        'imagen',
        'categoria_id',
        'isDeleted'
    ];

    public function scopeSearch($query, $search){
        return $query->whereRaw('LOWER(nombre) LIKE ?', ["%" . strtolower($search) . "%"]);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
