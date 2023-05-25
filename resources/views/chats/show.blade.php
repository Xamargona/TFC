@extends('layout')

@section('contenido')

<h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">Chats</h1>
<section class="w-full pr-4 pl-4 pb-4 flex flex-col justify-center overflow-auto max-h-52">
    @if (count($chats) > 2)
        <span class=" mt-28"></span>
    @endif
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
                        <div class=" flex flex-row justify-center bg-gray-100 border border-gray-200 rounded-lg shadow text-center w-4/5 m-auto max-w-md">
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
<hr>
<section class="w-full p-4 flex flex-col justify-center">
    <div class="flex flex-col justify-center">
    <h1 class="mt-1 mb-4 text-4xl font-extrabold leading-none tracking-tight text-amber-950 outline-white md:text-5xl lg:text-6x text-center">{{ $user->username }}</h1>
    <div class="messages" id="message-container">
        @if (count($messages) != 0)
            @foreach($messages as $message)
                <div class="message @if($message->user_id == Auth::id()) sent @else received @endif">
                    <p>{{ $message->message }}</p>
                    <small class="text-black">{{ $message->created_at->format('d/m/Y H:i') }}</small>
                </div>
            @endforeach
        @endif
    </div>
    <form method="POST" action="{{ route('chats.sendMessage') }}">
        @csrf
        <input type="hidden" name="recipient_id" value="{{ $user->id }}">
        <div class="flex items-center pr-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700">
            <textarea id="message" name="message" type="message" rows="1" class=" resize-none h-111 block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Your message..." required></textarea>
                <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                <span class="sr-only">Send message</span>
            </button>
        </div>
    </form>
</div>
</section>
    <script>
        var messageContainer = document.getElementById('message-container');
        messageContainer.scrollTop = messageContainer.scrollHeight;
    </script>
@endsection
