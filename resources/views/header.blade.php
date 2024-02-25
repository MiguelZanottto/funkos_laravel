
<header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="{{route('funkos.index')}}">
            <img alt="Logo" class="d-inline-block align-text-top" height="30" src="{{asset('images/favicon.webp')}}" width="55">
            Funkos Zanotto's
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('funkos.index')}}">Tienda</a>
                </li>
                @if(auth()->check() && auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('categorias.index')}}">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('funkos.create')}}">Agregar Funko</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('categorias.create')}}">Agregar Categoria</a>
                    </li>
                @endif
                <li class="nav-item">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route ('home') }}" class="nav-link">Home</a>
                            @else
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                            @endauth
                        @endif
                </li>
            </ul>
            <span class="navbar-text">
                Usuario: {{auth()->user()->name ?? 'invitado/a'}}
            </span>
        </div>
    </nav>
</header>
