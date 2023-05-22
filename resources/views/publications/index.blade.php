@extends('layout')

@section('titulo', 'Lista de publicaciones')

@section('contenido')

<h1 class=" fade-in mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">Nuestro contenido</h1>

<section class="w-full flex justify-center ">
    <div class="w-full max-w-screen-2xl flex justify-around flex-wrap ">
        @foreach ( $publications as $publication)
            <div class="bg-topPubli max-w-sm  border border-gray-200 rounded-lg shadow fade-in m-5">
                <a href="{{ route('users.show', $publication->user) }}" class="m-2 flex flex-row ">
                    @if ($publication->user->avatar)
                        <img class="w-11 h-11rounded-full mr-2 ml-2" src="/images/{{$publication->user->avatar) }}"
                            alt="profile picture">
                    @else
                        <img class="w-11 h-11 rounded-full mr-2" src="/app/placeholder.jpg"
                            alt="profile picture">
                    @endif
                    <h5 class=" text-2xl font-medium text-gray-800 leading-10">{{ $publication->user->username }}</h5>
                </a>
                <img class="bg-white" src="/images/{{ $publication->image  }}" alt="publication" />
                <div class="p-5 bg-publi">
                    <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900">{{ $publication->title }}</h5>
                    @if ((Auth::check() && Auth::user()->id == $publication->user_id) || (Auth::check() && Auth::user()->role == 'admin'))
                        <div class="flex justify-around flex-wrap">
                            <a href="{{ route('publications.edit', $publication) }}" class=" m-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Editar publicación</a>
                            <form action="{{ route('publications.destroy', $publication) }}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="m-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-black rounded-lg hover:bg-red-800 hover:text-black focus:ring-4 focus:outline-none focus:ring-red-800 ">Eliminar</button>
                            </form>
                        </div>
                    @endif
                    <p class=" text-right">{{ $publication->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>



@endsection
