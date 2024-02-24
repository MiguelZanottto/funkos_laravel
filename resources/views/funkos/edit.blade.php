@php use App\Models\Funko; @endphp
@extends('main')
@section('title', 'Actualizar Funko')
@section('style')
    <style>
        body {
            background-image: url('https://ae01.alicdn.com/kf/Sbb30b217c4274bd8b45097cd1e719ec8b.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #ffffff;
            margin: 0;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
            color: #343a40;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 16px 30px;
            font-size: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 16px 30px;
            font-size: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            background-color: #0056b3;
        }
    </style>

@endsection
@section('content')
    <h1 class="mt-3 mb-3">Actualizar Funko</h1>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br/>
    @endif


    <form action="{{route('funkos.update', $funko->id)}}" method="post">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input class="form-control" id="nombre" name="nombre" type="text" required value="{{$funko->nombre}}">
        </div>
        <div class="form-group">
            <label for="precio">Precio:</label>
            <input class="form-control" id="precio" name="precio" min="0.0" step="0.01" required type="number" value="{{$funko->precio}}">
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input class="form-control" id="cantidad" name="cantidad" min="0" required type="number" value="{{$funko->cantidad}}">
        </div>

        <div class="form-group">
            <label for="categoria">Categoría:</label>
            <select class="form-control" id="categoria" name="categoria" required>
                <option>Seleccione una categoría</option>
               @foreach($categorias as $categoria)
                <option @if($funko->categoria->id == $categoria->id) selected @endif value="{{$categoria->id}}">
                    {{ $categoria->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button class="btn btn-primary" type="submit">Actualizar</button>
            <a class="btn btn-secondary mx-2" href="{{route('funkos.index')}}">Volver</a>
        </div>
    </form>
@endsection
