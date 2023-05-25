@extends('layout')

@section('titulo', 'Gestión de reservas')

@section('contenido')


<section class="flex flex-col lg:flex-row justify-center lg:justify-around">
    <div class=" flex justify-center flex-col m-auto p-5">
        <h4 class=" mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center ">Reservas de {{ Auth::user()->username }}</h4>
        @foreach ($bookings as $booking)
            @if ($booking->user_id == Auth::user()->id)
                <div class="flex flex-row p-5 justify-center bg-profilecard m-3 ">
                    <p class=" font-semibold mr-4">
                        Reserva de {{ $booking->user->username }} el día {{ $booking->date }} de
                        @if ($booking->session == 0)
                            9:00 a 13:00
                        @elseif ($booking->session == 1)
                            15:00 a 18:00
                        @else
                            9:00 a 13:00
                        @endif
                    </p>
                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                        class="inline-block  text-blue-600 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500"
                        type="submit">Eliminar reserva</button>
                    </form>
                </div>
            @endif
        @endforeach
    </div>

    <article class="flex flex-col-reverse sm:flex-col w-full max-w-4xl">
        <div class="m-auto flex flex-col justify-center">
            <h4 class=" mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">Todas las reservas</h4>
            <div class="flex justify-center h-fit max-h-96 flex-col overflow-y w-full m-a">
                @if (count($bookings) > 3)
                    <span class="mt-10"></span>
                @endif
                @foreach ($bookings as $booking)
                <div class="flex flex-row p-5 justify-center bg-profilecard m-3 ">
                    <p class="font-semibold mr-4">
                            Reserva de {{ $booking->user->username }} el día {{ $booking->date}} de
                            @if ($booking->session == 0)
                                9:00 a 13:00
                            @elseif ($booking->session == 1)
                                15:00 a 18:00
                            @else
                                9:00 a 13:00
                            @endif
                        </p>
                    </div>
            @endforeach
            </div>
        </div>
        <div>
            <h1 class="  mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">Realizar reserva</h1>
            <div class="w-full flex justify-center">

            <form action="{{ route('bookings.store') }}" class="m-5 w-fit max-w-2xl bg-register p-5 justify-center" method="POST">
                @csrf
                    <div class="flex items-center">
                        <input id="default-radio-1" type="radio" value="0" name="session" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                        <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 ">Turno de mañana</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <small>9:00 a 13:00</small>
                    </div>
                    <div class="flex items-center">
                        <input checked id="default-radio-2" type="radio" value="1" name="session" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                        <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900">Turno de tarde</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <small>15:00 a 18:00</small>
                    </div>
                    <div class="flex items-center">
                        <input type="date" name="date" class="mt-1" required>
                    </div>
                    <div class="flex items-center justify-center mt-5">
                        <button type="submit" class="text-white bg-register-button focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Reservar</button>
                    </div>
            </form>
            </div>
        </div>
    </article>
</section>

@endsection
