@extends('layout')

@section('titulo', 'Lista de eventos')

@section('contenido')

<h1 class=" fade-in mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">Eventos</h1>

<section class="w-full flex justify-center ">
    <div class="w-full max-w-screen-2xl flex justify-around flex-wrap ">
        @foreach ( $events as $event)
            <div class="max-w-sm  border border-gray-200 rounded-lg shadow fade-in m-5">
                <img class="bg-white" src="/images/{{ $event->image  }}" alt="event" />
                <div class="p-5 bg-publi">
                    <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900">{{ $event->title }}</h5>
                    <p class=" text-gray-700 font-semibold mb-2">{{ $event->description }}</p>
                    @if ((Auth::check() && Auth::user()->role == 'admin'))
                    <div class="flex justify-around flex-wrap">
                        <a href="{{ route('events.edit', $event) }}" class=" m-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Editar evento</a>
                    <form action="{{ route('events.destroy', $event) }}" method="POST" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="m-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-black rounded-lg hover:bg-red-800 hover:text-black focus:ring-4 focus:outline-none focus:ring-red-800 ">Eliminar</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>



@endsection
