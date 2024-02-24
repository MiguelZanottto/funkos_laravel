<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index(Request $request){
        $categorias = Categoria::all();
        return view('categorias.index')->with('categorias', $categorias);
    }


}
