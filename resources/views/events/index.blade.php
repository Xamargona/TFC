@extends('layout')

@section('titulo', 'Lista de eventos')

@section('contenido')
    <h1>Próximos eventos</h1>
    <ul>
        @foreach ($events as $event)
            <li>
                {{ $event->image ? $event->image : 'Placeholder' }}
                {{ $event->title }}
                {{ $event->description }}
                @if (Auth::check() && Auth::user()->role == 'admin')
                    <a href="{{ route('events.edit', $event) }}">Editar evento</a>
                    <form method="POST" action="{{ route('events.destroy', $event) }}">
                        @csrf @method('DELETE')
                        <button type="submit">Eliminar evento</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
@endsection
