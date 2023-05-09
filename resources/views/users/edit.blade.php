@extends('layout')

@section('titulo', 'Editar usuario')

@section('contenido')

<form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label for="username">Nombre de usuario</label>
        <input id="username" type="text" name="username" value="{{ old('username', $user->username) }}" required autofocus>
        @error('username')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="email">Correo electrónico</label>
        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password">Contraseña</label>
        <input id="password" type="password" name="password">
        @error('password')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">Confirmar contraseña</label>
        <input id="password_confirmation" type="password" name="password_confirmation">
    </div>

    <div>
        <label for="profile_picture">Imagen de perfil</label>
        <input id="profile_picture" type="file" name="profile_picture">
        @error('profile_picture')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="bio">Biografía</label>
        <textarea id="bio" name="bio">{{ old('bio', $user->bio) }}</textarea>
        @error('bio')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <button type="submit">Actualizar</button>
</form>

@endsection
