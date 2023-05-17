@extends('layout')

@section('titulo', 'Muestra de usuario')

@section('contenido')

    <section class=" flex justify-center p-5">
        <div class="flex flex-col items-center bg-gray-100 border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl fade-in">
            @if ($user->avatar)
                <img class="object-cover w-full rounded-t-lg h-60 md:h-auto md:w-60 md:rounded-none md:rounded-l-lg" src="{{ ($user->avatar) }}" alt="profile picture">
            @else
                <img class="object-cover w-full rounded-t-lg h-60 md:h-auto md:w-60 md:rounded-none md:rounded-l-lg" src="{{ ('/app/placeholder.jpg') }}" alt="profile picture">
            @endif
            <div class="flex flex-col justify-between p-5 leading-normal">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $user->username }}</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $user->email }}</p>
                @if ($user->role == 'artist')
                    <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">Seguidores <span class=" font-semibold">{{ $user->followers()->count() }}</span></p>
                @endif
                <p>{{ $user->bio }}</p>
            </div>
        </div>
    </section>
    @if ( Auth::check() && $user->role == 'artist' && $user->id != auth()->user()->id)
    <div class="flex w-full justify-center mt-5 mb-8 fade-in">
        @if (Auth::user()->following->contains($user->id))
            <form action="{{ route('follow', $user->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-follow-button rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-200">Dejar de seguir</button>
            </form>
        @else
            <form action="{{ route('follow', $user->id) }}">
                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-follow-button rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-200">Seguir</button>
            </form>
        @endif
        <span class="pl-10"></span>
        <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200">Escríbeme</a>
    </div>
    @endif




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
