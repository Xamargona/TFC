@extends('layout')

@section('titulo', 'Registro')

@section('contenido')
    <a href="{{ route('login') }}">Iniciar sesión</a>

    <h1>Registro</h1>

    <form method="POST" action="{{ route('registro') }}">
        @csrf

        <label for="username">Nombre de usuario</label>
        <input type="text" name="username" id="username" value="{{ old('username') }}" required autofocus>

        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required>

        <label for="password_confirmation">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>

        <button type="submit">Registrarse</button>
    </form>
@endsection
