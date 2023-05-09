@extends('layout')

@section('titulo', 'Lista de artistas')

@section('contenido')
    <h1>Lista de artistas</h1>
    <ul>
        @foreach ($users as $user)
            <li>
                <a href="{{ route('users.show', $user) }}">
                    {{ $user->profile_picture ? $user->profile_picture : 'Placeholder' }}
                    {{ $user->username }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection
