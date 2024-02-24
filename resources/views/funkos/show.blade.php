@php use App\Models\Funko; @endphp

@extends('main')
@section('title', 'Ver Funko')
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

        .row {
            align-items: center;
        }

        dl.row {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        dt.col-sm-3 {
            font-weight: bold;
            color: #343a40;
        }

        dd.col-sm-9 {
            color: #343a40;
        }

        img.img-fluid {
            max-width: 100%;
            height: auto;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .img-container {
            max-width: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 16px 30px;
            font-size: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
@endsection

@section('content')

        <h1 class="mt-3 mb-3">Detalles del Funko</h1>
        <div class="row">
            <div class="col-md-6">
                <dl class="row">
                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9">{{$funko->id}}</dd>
                    <dt class="col-sm-3">Nombre:</dt>
                    <dd class="col-sm-9">{{$funko->nombre}}</dd>
                    <dt class="col-sm-3">Precio:</dt>
                    <dd class="col-sm-9">{{$funko->precio}}</dd>
                    <dt class="col-sm-3">Cantidad:</dt>
                    <dd class="col-sm-9">{{$funko->cantidad}}</dd>
                    <dt class="col-sm-3">Categoría:</dt>
                    <dd class="col-sm-9">{{$funko->categoria->nombre}}</dd>
                </dl>
            </div>
            <div class="col-md-6 text-center">
                <div class="img-container">
                    @if($funko->imagen != Funko::$IMAGE_DEFAULT)
                    <img class="img-fluid" alt="Imagen del funko"
                         src="{{ asset('storage/' . $funko->imagen) }}" onerror="this.onerror=null; this.src='{{$funko->imagen}}'">
                    @else
                        <img class="img-fluid" alt="Imagen del funko"
                             src="{{Funko::$IMAGE_DEFAULT}}">
                    @endif
                </div>
            </div>
        </div>
        <a class="btn btn-primary" href="{{route('funkos.index')}}">Volver</a>

@endsection
