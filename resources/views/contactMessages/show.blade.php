@extends('layout')

@section('titulo', 'Vista evento')

@section('contenido')
    <section class="flex w-full p-10 flex-wrap justify-center">

        <div class="w-full mb-9 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class=" p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="about" role="tabpanel"
                aria-labelledby="about-tab">
                <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">{{ $message->username }}
                </h2>
                <h4 class="mb-3 text-xl font-medium text-gray-500 dark:text-white">Asunto: {{ $message->subject }}</h4>
                <p class="mb-3 text-gray-500 dark:text-gray-400">{{ $message->text }}</p>

                <form action="{{ route('messages.destroy', $message) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button
                        class="inline-block p-4 text-blue-600 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500"
                        type="submit">Eliminar mensaje</button>
                </form>
            </div>
        </div>
    </section>
@endsection
