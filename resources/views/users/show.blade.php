@extends('layout')

@section('titulo', 'Muestra de usuario')

@section('contenido')
    <section>
        <div class="flex justify around flex-wrap">
            @if ($user->avatar)
                <img class="rounded-full w-96 h-96" src="{{ asset('storage/' . $user->avatar) }}" alt="profile picture">
            @else
                <img class="rounded-full w-96 h-96"  src="{{ asset('public/images/placeholder.png') }}" alt="profile picture">
            @endif
            <div>
                <p>Seguidores {{ $user->followers }}</p>
            </div>
        </div>
    </section>
@endsection
