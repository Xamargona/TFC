@extends('layout')

@section('titulo', 'Crear evento')

@section('contenido')
<form action="{{ route('publications.store') }}" method="POST">
    @csrf
    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title">
    </div>
    <div>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image">
    </div>
    <div>
        <label for="tags">Tags:</label>
        <select name="tags[]" id="tags" multiple>
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Create Publication</button>
</form>

@endsection
