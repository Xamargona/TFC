@extends('layout')

@section('titulo', 'Login')

@section('contenido')

<h1 class=" mt-36 mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">Iniciar sesión</h1>


    <section class="w-full flex flex-col justify-center m-a p-3.5">
        <section class="w-full flex justify-center ">

        <form action="{{ route('login') }}" method="post" class="m-5 w-full max-w-3xl bg-register p-5">
            @csrf
            <div class="mb-6">
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de usuario o correo electrónico</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                <input type="password" name="password" id="password" required  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
            </div>
        <div>
            <div class="flex justify-around flex-wrap">

            <input type="submit" value="Iniciar sesión" class="text-white bg-register-button focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">
            <a href="{{ route('registro') }}" class="text-sm py-2.5 text-center font-medium hover:text-blue-700">¿Aún no tienes una cuenta? Regístrate</a>
            </div>
        </form>
        </div>
    </section>
@endsection
