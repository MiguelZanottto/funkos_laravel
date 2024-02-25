@php use App\Models\Funko; @endphp

@extends('main')

@section('title', 'Tienda Funkos')

@section('content')
    <h1>Listado de Funkos</h1>

    <form action="{{ route('funkos.index') }}" class="mb-3" method="get">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control" id="search" name="search" placeholder="Buscar funko por nombre" aria-label="Buscar" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </div>
    </form>

    @if (count($funkos) > 0)
        <div class="container">
            <div class="row">
        @foreach ($funkos as $funko)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($funko->imagen != Funko::$IMAGE_DEFAULT)
                    <img class="card-img-top" alt="Imagen del funko" height="50" src="{{ asset('storage/' . $funko->imagen) }}"  onerror="this.onerror=null; this.src='{{$funko->imagen}}'"
                    style="height: 270px; object-fit: cover;">
                @else
                    <img class="card-img-top" alt="Imagen por defecto" height="50" src="{{ Funko::$IMAGE_DEFAULT }}"
                         style="height: 270px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title text-center" style="font-size: 1.5rem; font-weight: bold;">{{ $funko->nombre }}</h5>
                    <p class="card-text text-center" style="font-size: 1rem;">
                        <strong>ID:</strong> {{ $funko->id }} <br>
                        <strong>Precio:</strong> {{ $funko->precio }} <br>
                        <strong>Cantidad:</strong> {{ $funko->cantidad }}
                    </p>
                    <div class="text-center">
                        <div class="btn-group" role="group" aria-label="Acciones">
                            <a class="btn btn-primary" href="{{ route('funkos.show', $funko->id) }}">Detalles</a>
                            @if(auth()->check() && auth()->user()->role == 'admin')
                                <a class="btn btn-secondary" href="{{ route('funkos.edit', $funko->id) }}">Editar</a>
                                <a class="btn btn-info" href="{{ route('funkos.editImage', $funko->id) }}">Imagen</a>
                                <form action="{{ route('funkos.destroy', $funko->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este funko?');">
                                        Eliminar
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
            </div>
    @else
        <p class='lead'><em>No se ha encontrado datos de funkos.</em></p>
    @endif

    <div class="pagination-container">
        {{ $funkos->links('pagination::bootstrap-4') }}
    </div>
            @if(auth()->check() && auth()->user()->role == 'admin')
     <div class="text-center">
         <a class="btn btn-success" href={{ route('funkos.create') }}>Nuevo Funko</a>
     </div>
    @endif

@endsection
