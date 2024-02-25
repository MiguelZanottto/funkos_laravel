<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index(Request $request){
        $categorias = Categoria::buscar($request->buscar)->orderBy('id','asc')->paginate(5);
        return view('categorias.index')->with('categorias', $categorias);
    }

    public function create(){
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'min:3|max:120|required|unique:categorias,nombre',
        ]);

        try{
            $categoria = new Categoria();
            $categoria->nombre = strtoupper($request->nombre);
            $categoria->save();
            flash('Categoria ' . $categoria->nombre . ' creado con éxito.')->success()->important();
            return redirect()->route('categorias.index');
        } catch (Exception $e){
            flash('Ya existe otra categoria con ese mismo nombre')->error()->important();
            return redirect()->back();
        }
    }

    public function edit($id){
        try{
            $categoria = Categoria::find($id);
            if($categoria && $id != 5){
                return view('categorias.edit')->with('categoria', $categoria);
            } else {
                flash('Ruta invalida')->error()->important();
                return redirect()->route('categorias.index');
            }
        } catch (Exception $e){
            flash('Ruta invalida')->error()->important();
            return redirect()->route('categorias.index');
        }
    }


    public function update(Request $request, $id){
        $request->validate([
            'nombre' => 'min:4|max:120|required|unique:categorias,nombre,' . $id,
        ]);

        try{
            $categoria = Categoria::find($id);
            $categoria->nombre = strtoupper($request->nombre);
            $categoria->save();
            flash('Categoria ' . $categoria->nombre . ' actualizado con exito')->warning()->important();
            return redirect()->route('categorias.index');
        } catch (Exception $e){
            flash('Ya existe otra categoria con ese mismo nombre')->error()->important();
            return redirect()->back();
        }
    }

    public function destroy($id){
        if($id != 5) {
        try{
            $categoria = Categoria::find($id);

            $categoria->actualizarFunkosSinCategoria($id);

            $categoria->delete();
            flash('Categoria ' . $categoria->nombre . ' eliminada con éxito')->error()->important();
            return redirect()->route('categorias.index');
        } catch (Exception $e){
            flash('Error al eliminar Categoria' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
        } else {
            flash('Ruta invalida')->error()->important();
            return redirect()->back();
        }
    }
}
