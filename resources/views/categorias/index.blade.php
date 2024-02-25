@php use App\Models\Funko; @endphp

@extends('main')

@section('title', 'Categorias')

@section('content')
    <h1>Listado de Categoria</h1>

    <form action="{{ route('categorias.index') }}" class="mb-3" method="get">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control" id="buscar" name="buscar" placeholder="Buscar categoria por nombre" aria-label="Buscar" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </div>
    </form>

    @if(count($categorias) > 1)
        <table class="table">
            <thead>
            <tr>
                <th scope="col" class="text-center">Nombre</th>
                @if(auth()->check() && auth()->user()->role == 'admin')
                    <th scope="col" class="text-center">Acciones</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($categorias as $categoria)
                @if($categoria->id != 5)
                   <tr>
                       <td class="text-center">{{$categoria->nombre}}</td>
                       @if(auth()->check() && auth()->user()->role == 'admin')
                           <td class="text-center">
                               <div class="btn-group" role="group" aria-label="Acciones">
                                   <a class="btn btn-secondary" href="{{ route('categorias.edit', $categoria->id) }}">Editar</a>
                                   <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display: inline;">
                                       @csrf
                                       @method('DELETE')
                                       <button class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoria?');">
                                           Eliminar
                                       </button>
                                   </form>
                               </div>
                           </td>
                       @endif
                   </tr>
                @endif
            @endforeach
            </tbody>
        </table>
            @else
                <p class='lead'><em>No se ha encontrado datos de categorias.</em></p>
            @endif

            <div class="pagination-container">
                {{ $categorias->links('pagination::bootstrap-4') }}
            </div>
            @if(auth()->check() && auth()->user()->role == 'admin')
                <div class="text-center">
                    <a class="btn btn-success" href={{ route('categorias.create') }}>Nueva Categoria</a>
                </div>
    @endif

@endsection
