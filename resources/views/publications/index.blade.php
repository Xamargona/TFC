@extends('layout')

@section('titulo', 'Lista de publicaciones')

@section('contenido')

<h1 class=" fade-in mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">Nuestro contenido</h1>

<section class="w-full flex justify-center">
    <div class="w-full max-w-screen-2xl flex justify-around flex-wrap">
        @foreach ( $publications as $publication)
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow fade-in m-5">
                <img class="rounded-t-lg" src="/images/{{ $publication->image  }}" alt="publication" />
                <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $publication->title }}</h5>
                    <a href="{{ route('publications.edit', $publication) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Editar publicación
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</section>



@endsection
