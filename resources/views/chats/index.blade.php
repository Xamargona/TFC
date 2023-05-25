@extends('layout')

@section('titulo', 'Lista de eventos')

@section('contenido')
<h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center fade-in">Chats</h1>
<section class="w-full pr-4 pl-4 pb-4 flex flex-col justify-center ">
        @foreach($chats as $chat)
                @if ($chat->user_id == Auth::id())
                    @php
                        $conversation = App\Models\User::find($chat->recipient_id);
                    @endphp
                @else
                    @php
                        $conversation = App\Models\User::find($chat->user_id);
                    @endphp
                @endif
                    <a href="{{ route('chats.show', $conversation->id) }}">
                        <div class="fade-in flex flex-row justify-center bg-gray-100 border border-gray-200 rounded-lg shadow text-center w-4/5 m-auto max-w-md">
                            @if ($conversation->avatar)
                                <img class="m-3 w-11 h-11 rounded-full" src="/images/{{$conversation->avatar}}"
                                    alt="profile picture">
                            @else
                                <img class="m-3 w-11 h-11 rounded-full" src="/app/placeholder.jpg"
                                    alt="profile picture">
                            @endif
                            <p class="flex flex-col mt-2" >{{ $conversation->username }}
                                <span class="text-black">
                                    <small>{{ $chat->created_at->format('d/m/Y') }}</small>
                                </span>
                            </p>
                        </div>
                    </a><br>
                @endforeach
</section>
@endsection
