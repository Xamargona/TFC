@extends('layout')

@section('titulo', 'Editar publicación')

@section('contenido')

<h1 class=" mt-36 mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">Editando publicación</h1>
<div class="flex justify-center">
    <div class="bg-topPubli max-w-sm rounded-t-lg border border-gray-200 rounded-lg shadow fade-in m-5">
        <img class="bg-white rounded-t-lg" src="/images/{{ $publication->image  }}" alt="publication" />
        <div class="p-5 bg-publi">
            <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900">{{ $publication->title }}</h5>
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
</div>

<section class="w-full flex justify-center">
    <form class="m-5 w-full max-w-3xl bg-register p-5" method="POST" action="{{ route('publications.update', $publication->id) }}"  enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="title" id="title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required value="{{ $publication->title}}"/>
            <label for="title" class="peer-focus:font-medium absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Título de la publicación</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="file" name="image" id="image" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="image" class="peer-focus:font-medium absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Selecciona una imagen para la publicación</label>
        </div>
        <div class="relative z-0 w-full mb-6 group pt-4">
            <label for="etiquetas" class="peer-focus:font-medium absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Añade etiquetas a tu publicación</label>
            <select name="etiquetas[]" id="etiquetas" multiple>
                @foreach ($tipos as $tipo)
                    @if ($publication->tags->contains($tipo->id))
                        <option value="{{ $tipo->id }}" selected>{{ $tipo->name }}</option>
                    @else
                    <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="flex justify-center">
            <button type="submit" class="text-white bg-register-button focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Publicar</button>
        </div>
    </form>
</section>
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag('etiquetas')
</script>
@endsection
