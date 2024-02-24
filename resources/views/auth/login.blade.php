@extends('layouts.app')


@section('content')
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 500px; border-radius: 10px;">
        <div class="card-header bg-secondary text-white" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <h1 class="text-center">Login</h1>
        </div>
        <div class="card-body">
            <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label text-purple">Email:</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{old('email')}}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-purple">Password:</label>
                    <input id="password" required type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Recuerdame') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
