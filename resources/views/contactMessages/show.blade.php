@extends('layout')

@section('titulo', 'Vista evento')

@section('contenido')

    <h1 class=" mt-36 mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">Incidencia</h1>
    <section class="flex w-full p-10 flex-wrap justify-center">
            <div class=" w-full bg-publi p-5 m-5 flex justify-center flex-col">
                <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900">{{ $message->username }}: {{ $message->email }}</h5>
                <p class=" text-black font-semibold mb-2">{{ $message->subject }}</p>
                <p class=" text-gray-700  font-semibold mb-2">{{ $message->description }}</p>
                <p class=" text-gray-700  font-semibold mb-2">{{ $message->created_at }}</p>
                <form action="{{ route('contactMessages.destroy', $message->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button
                        class="inline-block  text-blue-600 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500"
                        type="submit">Eliminar incidencia</button>
                </form>
            </div>
    </section>
@endsection
