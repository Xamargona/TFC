@extends('layout')

@section('titulo', 'Crear mensaje - Contacto')

@section('contenido')
<h1 class="mb-9 text-3xl font-extrabold text-teal-500 dark:text-white md:text-5xl lg:text-6xl text-center mt-7">Contacta con nosotros</h1>
    <section class="w-full flex flex-col justify-center m-a p-3.5">
        <div class=" w-96 self-center">

        <form action="{{ route('messages.store') }}" method="post" class="w-96">
            @csrf

            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input type="name" name="name" id="name"
            @if (Auth::check())
                value="{{Auth::user()->name}}"
            @else
                value="{{old('name')}}"
            @endif
                class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @if ($errors->has('name'))
                <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
            @endif

            <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Asunto</label>
            <input type="subject" name="subject" id="subject" value="{{old('subject')}}"
                class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @if ($errors->has('subject'))
                <p class="text-red-500 text-xs italic">{{ $errors->first('subject') }}</p>
            @endif

            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mensaje</label>
            <textarea name="text" id="text" cols="30" rows="10"
                class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{old('text')}}</textarea>
            @if ($errors->has('text'))
                <p class="text-red-500 text-xs italic">{{ $errors->first('text') }}</p>
            @endif

            <input type="submit" value="Guardar"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        </form>
        </div>
    </section>

@endsection
