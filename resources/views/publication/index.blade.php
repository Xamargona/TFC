@extends('layout')

@section('titulo', 'Lista de eventos')

@section('contenido')

    {{-- Si existe algún tipo de mensaje lo mostramos --}}
    @isset($info)
        <h5 class="mb-3 text-xl font-medium text-gray-500 dark:text-white">{{ $info }}</h5>
    @endisset

    {{-- Mostramos los eventos --}}
    <h1 class="mb-9 text-3xl font-extrabold text-teal-500 dark:text-white md:text-5xl lg:text-6xl text-center mt-7">Eventos
    </h1>
    <section class="flex w-full p-10 flex-wrap justify-center">

        @forelse ($events as $event)

            <div class="w-full mb-9 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                <div class=" p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="about" role="tabpanel"
                    aria-labelledby="about-tab">
                    <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">{{ $event->name }}
                    </h2>
                    <p class="mb-3 text-gray-500 dark:text-gray-400">{{ $event->description }}</p>
                    <h4 class="mb-3 text-xl font-medium text-gray-500 dark:text-white">{{ $event->location }} -
                        {{ $event->date }}</h4>
                    <a href="{{ route('events.show', $event) }}"
                        class="inline-flex items-center font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-700">
                        Más información
                        <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>

                @if (Auth::check())
                    <ul
                        class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
                        @if ($event->users->contains(Auth::user()->id))
                            <li class="mr-2">
                                <form action="{{ route('events.remove', $event) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        type="submit">Borrarse</button>
                                @else
                                    <form action="{{ route('events.add', $event) }}" method="POST">
                                        @csrf
                                        <button
                                            class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                            type="submit">Apuntarse</button>
                        @endif
                        </form>
                        </li>
                        @if (Auth::user()->role == 'admin')
                            <li class="mr-2">
                                <a class="inline-block p-4 text-blue-600 rounded-tl-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500"
                                    href="{{ route('events.edit', $event) }}">Editar</a>
                            </li>
                            <li class="mr-2">
                                <form action="{{ route('events.destroy', $event) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="inline-block p-4 text-blue-600 rounded-tl-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500"
                                        type="submit">Eliminar</button>
                                </form>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>

        @empty
            <p>No hay eventos disponibles</p>
        @endforelse
    </section>
@endsection
