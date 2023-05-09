@extends('layout')

@section('titulo', 'Editar evento')

@section('contenido')
    <section class="w-full flex flex-col justify-center m-a p-3.5">

        <h1 class="mb-9 text-3xl font-extrabold text-teal-500 dark:text-white md:text-5xl lg:text-6xl text-center mt-7">
            Editar evento {{ $event->name }}</h1>

        <div class=" w-96 self-center">
            <form action="{{ route('events.update', ['event' => $event->id]) }}" method="post" class=" w-96">
                @csrf
                @method('put')

                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del
                    evento</label>
                <input type="text" name="name" id="name"
                    class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ $event->name }}">
                @if ($errors->has('name'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
                @endif

                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                <textarea name="description" id="description" cols="30" rows="10"
                    class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $event->description }}</textarea>
                @if ($errors->has('description'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('description') }}</p>
                @endif

                <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lugar</label>
                <input type="text" name="location" id="location"
                    class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ $event->location }}">
                @if ($errors->has('location'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('location') }}</p>
                @endif

                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha</label>
                <input type="date" name="date" id="date"
                    class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ $event->date }}">
                @if ($errors->has('date'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('date') }}</p>
                @endif

                <label for="hour" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora</label>
                <input type="time" name="hour" id="hour"
                    class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ $event->hour }}">
                @if ($errors->has('hour'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('hour') }}</p>
                @endif

                <label for="visible" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Visible</label>
                <select name="visible" id="visible"
                    class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1" @if ($event->visible == 1) selected @endif>Visible</option>
                    <option value="0" @if ($event->visible == 0) selected @endif>No visible</option>
                </select>

                <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tags</label>
                <input type="text" name="tags" id="tags"
                    class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ $event->tags }}">
                @if ($errors->has('tags'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('tags') }}</p>
                @endif

                <input type="submit" value="Guardar"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            </form>
        </div>
    </section>
@endsection
