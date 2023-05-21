@extends('layout')

@section('titulo', 'Contacto')

@section('contenido')

<h1 class=" mt-36 mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">Contáctanos</h1>


<section class="w-full flex justify-center">
    <form class="m-5 w-full max-w-3xl bg-register p-5" method="POST" action="{{ route('contactMessages.store') }}" >
        @csrf
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="username" id="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required
            @if (Auth::check())
                value="{{ Auth::user()->username }}"
            @else
                value="{{ old('username') }}"
            @endif
            >
            <label for="username" class="peer-focus:font-medium absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre de usuario</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="email" name="email" id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required
            @if (Auth::check())
                value="{{ Auth::user()->email }}"
            @else
                value="{{ old('email') }}"
            @endif
            >
            <label for="email" class="peer-focus:font-medium absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Correo electrónico</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <label for="subject" class="peer-focus:font-medium absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Asunto</label>
            <select id="subject" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer" name="subject">
                <option value="Problemas publicaciones">Problemas con las publicaciones</option>
                <option value="Promoción a artista">Quiero trabajar con vosotros</option>
                <option value="Problemas LogIn">Problemas con el inicio de sesión</option>
                <option value="Otro">Otro</option>
            </select>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="text" id="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required value="{{ old('text') }}" >
            <label for="text" class="peer-focus:font-medium absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Descripción</label>
        </div>
        <div class="flex justify-around flex-wrap">
            <button type="submit" class="text-white bg-register-button focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Enviar</button>
        </div>

      </form>
</section>

@endsection
