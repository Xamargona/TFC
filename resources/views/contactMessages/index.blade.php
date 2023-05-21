@extends('layout')

@section('titulo', 'Mensajes')

@section('contenido')

<h1 class=" mt-36 mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">Registro</h1>
<section class="flex w-full p-10 flex-wrap justify-center">

        @forelse ($messages as $message)
            <div class="w-full mb-9 bg-white border border-gray-200 rounded-lg shadow">
                <div class=" p-4 bg-gray-300 rounded-lg md:p-8 " id="about" role="tabpanel"
                    aria-labelledby="about-tab">
                    <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 ">{{ $message->username }} - Leído
                    </h2>
                    <h4 class="mb-3 text-xl font-medium text-gray-500 ">{{ $message->subject }}</h4>
                    <a href="{{ route('contactMessages.show', $message) }}"
                        class="inline-flex items-center font-medium text-blue-600 hover:text-blue-800 ">
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
        @empty
            <p>No hay mensajes disponibles</p>
        @endforelse
        </section>

@endsection

