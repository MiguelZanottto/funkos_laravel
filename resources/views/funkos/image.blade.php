@php use App\Models\Funko; @endphp

@extends('main')

@section('title', 'Editar Imagen de Funko')

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

    dl {
    margin-bottom: 30px;
    }

    dt {
    font-weight: bold;
    color: #343a40;
    }

    dd {
    font-size: 24px;
    color: black;
    font-weight: bold
    }

    .img-container {
    text-align: center;
    }

    .img-container img {
    max-width: 300px;
    max-height: 300px;
    border-radius: 5px;
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
    padding: 20px 30px;
    font-size: 20px;
    transition: background-color 0.3s ease;
    }

    input{
        color: black;
    }

    .btn-secondary {
    background-color: #6c757d;
    border: none;
    padding: 20px 30px;
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
    <h1 class="mt-3 mb-3">Actualizar Imagen Funko</h1>

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


    <div class="row">
        <div class="col-md-6">
            <dl class="row">
                <dt class="col-sm-4">ID:</dt>
                <dd class="col-sm-8">{{$funko->id}}</dd>
                <dt class="col-sm-4">Nombre:</dt>
                <dd class="col-sm-8">{{$funko->nombre}}</dd>
            </dl>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <div class="img-container">
                    @if($funko->imagen != Funko::$IMAGE_DEFAULT)
                    <img alt="Funko Image" class="img-fluid" src="{{asset('storage/' . $funko->imagen)}}" onerror="this.onerror=null; this.src='{{$funko->imagen}}'">
                    @else
                        <img alt="Funko Image" class="img-fluid" src="{{Funko::$IMAGE_DEFAULT}}">
                    @endif
                </div>
            </div>

            <form action="{{route("funkos.updateImage", $funko->id)}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="imagen">Nueva Imagen:</label>
                    <input accept="image/*" class="form-control-file" id="imagen" name="imagen" required type="file">
                    <small class="text-danger"></small>
                </div>
                <div class="text-left">
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                    <a class="btn btn-secondary mx-2" href="{{route('funkos.index')}}">Volver</a>
                </div>
            </form>
        </div>
    </div>
@endsection
