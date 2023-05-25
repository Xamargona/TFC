@extends('layout')

@section('titulo', 'Lista de artistas')

@section('contenido')

    <form class="flex items-center search-form fade-in" action="" method="GET">
        <label for="name" class="sr-only">Search</label>
        <div class="relative w-4/5">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 " placeholder="Search">
        </div>
        <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <span class="sr-only">Search</span>
        </button>
    </form>

    <h1 class=" fade-in mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">Nuestros artistas</h1>
    <section class="w-full flex justify-center">
        <div class="w-full max-w-screen-2xl flex justify-around flex-wrap">
            @foreach ($users as $user)
                <div class=" w-full max-w-sm bg-profilecard border rounded-lg shadow m-5 fade-in">
                    <div class="flex justify-end px-4 pt-5">
                        @if ((Auth::check() && Auth::user()->role == 'admin' && $user->role != 'admin'))
                        <button id="dropdownButton{{ $user->id }}" data-dropdown-toggle="dropdown{{ $user->id }}" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                            <span class="sr-only">Open dropdown</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdown{{ $user->id }}" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                            <ul class="py-2" aria-labelledby="dropdownButton{{ $user->id }}">
                                <form action="{{ route('changeRole', $user->id) }}">
                                    @csrf
                                    @if ($user->role == 'artist')
                                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Cambiar rol a USER</button>
                                    @else
                                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Cambiar rol a ARTIST</button>
                                    @endif
                                </form>
                                <form action="{{ route('users.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Eliminar usuario</button>
                                </form>
                            </ul>
                        </div>
                        @endif
                    </div>

                    <div class="flex flex-col items-center pb-10">
                        @if ($user->avatar)
                            <img class="w-32 h-32 mt-5 rounded-full" src="/images/{{($user->avatar) }}" alt="Profile picture">
                        @else
                            <img class="w-32 h-32 mt-5 rounded-full" src="{{ ('/app/placeholder.jpg') }}" alt="Profile picture">
                        @endif
                        <h5 class="mb-1 text-xl font-medium text-gray-800 ">{{ $user->username }}</h5>
                        <span class="text-sm text-white ">{{ $user->email }}</span>
                        <div class="flex mt-4 space-x-3 md:mt-6">
                            <a href="{{ route('users.show', $user) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-follow-button rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300">Ver perfil</a>
                            <a href="{{ route('chats.show', $user->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200">Escríbeme</a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </section>
@endsection
