@extends('layout')

@section('titulo', 'Muestra de usuario')

@section('contenido')
    <section class="w-full flex justify-center m-a">
        <div class="self-center w-2/5 bg-slate-50 text-center rounded-xl mt-44">
            <div class="flex flex-col items-center pb-2 mt-5">
                <img class="w-24 h-24 mb-3 rounded-full " src="{{ url('/imagenes/profile placeholder.jpg') }}"
                    alt="User profile image" />
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->name }}</h5>
            </div>
            @if ($user->birthday)
                <p class="mb-4">{{ $user->birthday }}</p>
            @endif
            <div class="flex justify-around mb-5">
                @if ($user->twitter)
                    <span class="flex flex-row justify-center w-36"><a href="https://twitter.com/{{ $user->twitter }}"><img
                                src="{{ url('/imagenes/tw2.png') }}" class="w-6 mr-2" alt="logo Twitter"></a><a
                            href="https://twitter.com/{{ $user->twitter }}"
                            class=" text-cyan-400">{{ $user->twitter }}</a></span>
                @endif
                @if ($user->instagram)
                    <span class="flex flex-row justify-center w-36"><a
                            href="https://instagram.com/{{ $user->instagram }}"><img src="{{ url('/imagenes/insta2.png') }}"
                                class="w-6 mr-2" alt="logo instagram"></a><a
                            href="https://instagram.com/{{ $user->instagram }}"
                            class=" text-pink-500">{{ $user->instagram }}</a></span>
                @endif
                @if ($user->twitch)
                    <span class="flex flex-row justify-center w-36"><a href="https://twitch.com/{{ $user->twitch }}"><img
                                src="{{ url('/imagenes/twitch2.png') }}" class="w-6 mr-2" alt="logo twitch"></a><a
                            href="https://twitch.com/{{ $user->twitch }}"
                            class=" text-purple-400">{{ $user->twitch }}</a></span>
                @endif
            </div>
            @if (Auth::check())
                @if (Auth::user()->id == $user->id)
                    <a href="{{ route('users.edit', $user) }}"
                        class="mb-5 w-106 inline-flex items-center mt-1 px-4 py-1 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Editar
                        perfil</a>
                @endif
            @endif
        </div>
    </section>
@endsection
