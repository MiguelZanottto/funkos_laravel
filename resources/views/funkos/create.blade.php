@php use App\Models\Funko; @endphp
@extends('main')
@section('title', 'Crear Funko')
@section('style')
    <style>
        body {
            background-image: url('https://ae01.alicdn.com/kf/Sbb30b217c4274bd8b45097cd1e719ec8b.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #ffffff;
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
            padding: 12px 20px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 12px 20px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            background-color: #0056b3;
        }
    </style>
@endsection

@section('content')
    <h1>Crear Funko</h1>

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

    <form action="{{route('funkos.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input class="form-control" id="nombre" name="nombre" type="text"  required>
        </div>
        <div class="form-group">
            <label for="precio">Precio:</label>
            <input class="form-control" id="precio" min="0.0" name="precio" step="0.01" type="number" required
                   value="0">
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input class="form-control" id="cantidad" min="0" name="cantidad" type="number" required value="0">
        </div>
        <div class="form-group">
            <label for="categoria">Categoría:</label>
            <select class="form-control" id="categoria" name="categoria" required>
                <option value="">Seleccione una categoría</option>
               @foreach($categorias as $categoria)
                <option value="{{$categoria->id}}">
                         {{$categoria->nombre}}
                </option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button class="btn btn-primary" type="submit">Crear</button>
            <a class="btn btn-secondary mx-2" href="{{route('funkos.index')}}">Volver</a>
        </div>
    </form>

@endsection
