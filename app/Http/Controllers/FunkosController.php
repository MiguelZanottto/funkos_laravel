<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Funko;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FunkosController extends Controller
{

    public function index(Request $request){
        $funkos = Funko::search($request->search)->orderBy('id', 'asc')->paginate(3);
        return view('funkos.index')->with('funkos', $funkos);
    }

    public function show($id){
        $funko = Funko::find($id);
        return view('funkos.show')->with('funko', $funko);
    }

    public function create(){
        $categorias = Categoria::all();
        return view('funkos.create')->with('categorias', $categorias);
    }

    public function store(Request $request)
    {
        $request->validate([
           'nombre' => 'min:4|max:120|required',
           'precio' => 'required|regex:/^\d{1,13}(\.\d{1,2})?$/',
           'cantidad' => 'required|integer',
           'categoria' => 'required|exists:categorias,id',
        ]);

        try{
            $funko = new Funko($request->all());
            $funko->categoria_id = $request->categoria;
            $funko->save();
            flash('Funko ' . $funko->nombre . ' creado con éxito.')->success()->important();
            return redirect()->route('funkos.index');
        } catch (Exception $e){
            flash('Error al crear el Funko ' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function edit($id){
        $funko = Funko::find($id);
        $categorias = Categoria::all();
        return view('funkos.edit')->with('funko', $funko)->with('categorias', $categorias);
    }


    public function update(Request $request, $id){
        $request->validate([
            'nombre' => 'min:4|max:120|required',
            'precio' => 'required|regex:/^\d{1,13}(\.\d{1,2})?$/',
            'cantidad' => 'required|integer',
            'categoria' => 'required|exists:categorias,id',
        ]);

        try{
            $funko = Funko::find($id);
            $funko->update($request->all());
            $funko->categoria_id = $request->categoria;
            $funko->save();
            flash('Funko ' . $funko->nombre . ' actualizado con exito')->warning()->important();
            return redirect()->route('funkos.index');
        } catch (Exception $e){
            flash('Error al actualizar el Funko ' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function editImage($id){
        $funko = Funko::find($id);
        return view('funkos.image')->with('funko', $funko);
    }

    public function updateImage(Request $request, $id){
        $request->validate([
           'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try{
            $funko = Funko::find($id);

            if($funko->imagen != Funko::$IMAGE_DEFAULT && Storage::exists('public/' . $funko->imagen)){
                Storage::delete('public/' . $funko->imagen);
            }

            $imagen = $request->file('imagen');
            $extension = $imagen->getClientOriginalExtension();
            $fileToSave = Str::uuid() . '.' . $extension;
            $funko->imagen = $imagen->storeAs('funkos', $fileToSave, 'public');
            $funko->save();
            flash('Funko ' . $funko->nombre . ' actualizado con éxito')->warning()->important();
            return redirect()->route('funkos.index');
        } catch (Exception $e){
            flash('Error al actualizar el Funko ' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function destroy($id){
        try{
            $funko = Funko::find($id);
            if($funko->imagen != Funko::$IMAGE_DEFAULT && Storage::exists('public/' . $funko->imagen)){
                Storage::delete('public/' . $funko->imagen);
            }
            $funko->delete();
            flash('Funko ' . $funko->nombre . ' eliminado con éxito')->error()->important();
            return redirect()->route('funkos.index');
        } catch (Exception $e){
            flash('Error al eliminar Funko' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }
}
