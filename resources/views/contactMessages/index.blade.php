@extends('layout')

@section('titulo', 'Mensajes')

@section('contenido')

<h1 class="mb-9 text-3xl font-extrabold text-teal-500 dark:text-white md:text-5xl lg:text-6xl text-center mt-7">Mensajes</h1>
<section class="flex w-full p-10 flex-wrap justify-center">

        @forelse ($messages as $message)
            @if ($message->readed == 1)
            <div class="w-full mb-9 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class=" p-4 bg-gray-300 rounded-lg md:p-8 dark:bg-gray-800" id="about" role="tabpanel"
                    aria-labelledby="about-tab">
                    <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">{{ $message->name }} - Leído
                    </h2>
                    <h4 class="mb-3 text-xl font-medium text-gray-500 dark:text-white">{{ $message->subject }}</h4>
                    <a href="{{ route('messages.show', $message) }}"
                        class="inline-flex items-center font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-700">
                        Ver mensaje
                        <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @else
            <div class="w-full mb-9 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class=" p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="about" role="tabpanel"
                    aria-labelledby="about-tab">
                    <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">{{ $message->name }}
                    </h2>
                    <h4 class="mb-3 text-xl font-medium text-gray-500 dark:text-white">{{ $message->subject }}</h4>
                    <a href="{{ route('messages.show', $message) }}"
                        class="inline-flex items-center font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-700">
                        Ver mensaje
                        <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endif
        @empty
            <p>No hay mensajes disponibles</p>
        @endforelse
        </section>

@endsection

