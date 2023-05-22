@extends('layout')

@section('titulo', 'Editar usuario')

@section('contenido')

    <h1 class=" mt-36 mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">Editando usuario {{ $user->username }}</h1>

    <section class="w-full flex justify-center">
            @if ($user->avatar)
                <img class="object-cover w-full rounded-t-lg h-60 md:h-auto md:w-60 md:rounded-none md:rounded-l-lg" src="{{ ($user->avatar) }}" alt="profile picture">
            @else
                <img class="object-cover w-full rounded-t-lg h-60 md:h-auto md:w-60 md:rounded-none md:rounded-l-lg" src="{{ ('/app/placeholder.jpg') }}" alt="profile picture">
            @endif
        <form class="m-5 w-full max-w-3xl bg-register p-5" method="POST" action="{{ route('users.uploadAvatar') }}"  enctype="multipart/form-data" >
            @csrf
            <div class="relative z-0 w-full mb-6 group">
                <input type="file" name="image" id="image" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="image" class="peer-focus:font-medium absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Selecciona una imagen</label>
            </div>
        </form>
    </section>

    <section class="w-full flex justify-center">
        <form class="m-5 w-full max-w-3xl bg-register p-5" method="POST" action="{{ route('users.update', Auth::user()) }}" >
            @csrf
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="username" id="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="username" class="peer-focus:font-medium absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre de usuario</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="email" name="email" id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="email" class="peer-focus:font-medium absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Correo electrónico</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="password" class="peer-focus:font-medium absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Contraseña</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="password" name="password_confirmation" id="password_confirmation" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="password_confirmation" class="peer-focus:font-medium absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirmar contraseña</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="bio" id="bio" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="bio" class="peer-focus:font-medium absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Biografía</label>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="text-white bg-register-button focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Guardar cambios</button>
            </div>
        </form>
    </section>
@endsection
