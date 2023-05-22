@extends('layout')

@section('titulo', 'Mensajes')

@section('contenido')

<h1 class=" mt-36 mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">Incidencias</h1>
    <section class="flex w-full p-10 flex-wrap justify-center">
        @forelse ($messages as $message)
            <div class=" w-2/4 bg-publi p-5 m-5 flex flex-wrap justify-center flex-col text-center">
                <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900">{{ $message->username }}</h5>
                <hr class="mb-2">
                <p class=" text-black font-semibold mb-2">{{ $message->subject }}</p>
                <p class=" text-gray-700  font-semibold mb-2">{{ $message->created_at }}</p>
                <a href="{{ route('contactMessages.show', $message->id) }}" class="text-black font-bold hover:text-white">Ver mensaje:
                @if ($message->readed == 0)
                    (No leído)
                @else
                    (Leído)
                @endif
                </a>
            </div>
        @empty
            <p>No hay mensajes disponibles</p>
        @endforelse
    </section>
@endsection

