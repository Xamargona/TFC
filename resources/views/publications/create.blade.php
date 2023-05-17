@extends('layout')

@section('titulo', 'Crear publicación')

@section('contenido')
<form method="POST" action="{{ route('publications.store') }}" enctype="multipart/form-data" class="bg-white">
    @csrf

    <div>
        <label for="title">Título:</label>
        <input type="text" name="title" id="title" required>
    </div>
<br>
    <div>
        <label for="image">Imagen:</label>
        <input type="file" name="image" id="image" required>
    </div>
<br>


    <button type="submit">Guardar</button>
</form>


@endsection
