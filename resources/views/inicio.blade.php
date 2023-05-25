@extends('layout')

@section('titulo', 'Inicio')

@section('contenido')
<section class="w-full flex flex-col lg:flex-row justify-center p-5 lg:p-16 ">
    <div class=" m-auto w-fit bg-white rounded-3xl opacity-90 lg:h-fit  lg:w-max ">
        <img src="/app/mainLogo.png" alt="logo">
    </div>
    <div class="w-full m-auto p-5 flex-col bg-slate-700 rounded-3xl opacity-90 mt-5 lg:ml-5 lg:mt-0">
        <h1 class=" font-semibold text-4xl text-white">BIENVENIDOS A LA WEB DEL ESTUDIO </h1>
        <h1 class=" text-7xl font-extrabold"><span class=" text-red-700 ">Kuro</span> <span class=" text-purple-700 "> Ink</span></h1>
        <div class=" font-medium">
            <p>Si te gustaría concertar una cita con nosotros o necesitas consejos sobre el cuidado de tattos o piercings o estás dudando en que será lo siguiente que pondrás en tu piel, solo regístrate y contacta con tu artista favorito. Si quieres ver alguna de nuestras obras o inspirarte no dudes en acceder al apartado multimedia para estar al tanto de todo lo que hacemos.
            </p>
        </div>
    </div>

</section>
@endsection
