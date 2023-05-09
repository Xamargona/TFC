@extends('layout')

@section('titulo', 'Login')

@section('contenido')
    <a href="{{ route('registro') }}">Regístrate</a>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email">Correo electrónico o nombre de usuario</label>

                    <div>
                        <input placeholder="Correo electrónico o nombre de usuario" id="email" type="text" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                </div>

                <div>
                    <label for="password">Contraseña</label>

                    <div>
                        <input placeholder="Contraseña" id="password" type="password" name="password" required autocomplete="current-password">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                Recordar sesión
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <div>
                        <button type="submit">
                            Iniciar sesión
                        </button>
                    </div>
                </div>
            </form>
@endsection
