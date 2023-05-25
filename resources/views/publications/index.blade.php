@extends('layout')

@section('titulo', 'Lista de publicaciones')

@section('contenido')

<h1 class=" fade-in mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">Nuestro contenido</h1>

<h3 class="text-xl font-bold text-white outline-brown mb-4 fade-in text-center">Filtra por etiquetas</h3>
<form class="flex items-center search-form fade-in flex-col justify-center fade-in" action="" method="GET">
    <div class="relative w-4/6">
             <select name="etiquetas[]" id="etiquetas" multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 ">
            @foreach ($tipos as $tipo)
                <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
            @endforeach
        </select>
    </div>
        <button type="submit" class="m-4 p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 z-30"> Filtrar
        </button>
</form>


<section class="w-full flex justify-center ">
    <div class="w-full max-w-screen-2xl flex justify-around flex-wrap ">
        @foreach ( $publications as $publication)
            <div class="bg-topPubli max-w-sm  border border-gray-200 rounded-lg shadow fade-in m-5">
                <a href="{{ route('users.show', $publication->user) }}" class="m-2 flex flex-row ">
                    @if ($publication->user->avatar)
                        <img class="w-11 h-11 rounded-full mr-2 ml-2" src="/images/{{($publication->user->avatar) }}"
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
                    @if ($publication->tags())
                    <div class="m-auto p-5 flex flex-row flex-wrap text-center justify-around">
                        @foreach ($publication->tags as $tag)
                            <span class="p-2 mb-2 text-center rounded-2xl bg-topPubli text-gray-300 ">{{ $tag->name }}</span>
                        @endforeach
                        </div>
                    @endif
                    <p class=" text-right">{{ $publication->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag('etiquetas')
</script>
@endsection
