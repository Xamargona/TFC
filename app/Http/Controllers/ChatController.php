<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{

    public function index()
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::user()->id;
        $chats = Message::where('user_id', $userId)
        ->orWhere('recipient_id', $userId)
        ->orderBy('created_at', 'desc')
        ->get()
        ->unique(function ($message) use ($userId) {
            return $message->user_id === $userId ? $message->recipient_id : $message->user_id;
        })
        ->groupBy(function ($message) use ($userId) {
            return $message->user_id === $userId ? $message->recipient_id : $message->user_id;
        })
        ->map(function ($messages) {
            return $messages->sortByDesc('created_at')->first();
        });

        return view('chats.index', compact('chats'));
    }



    public function show($userId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!User::find($userId)) {
            return redirect()->route('chats.index');
        }

        if ($userId == Auth::id()) {
            return redirect()->route('chats.index');
        }

        if (Auth::user()->role == 'user' && User::find($userId)->role == 'user' || Auth::user()->role == 'user' && User::find($userId)->role == 'admin') {
            return redirect()->back();
        }

        $myid = Auth::user()->id;
        $chats = Message::where('user_id', $myid)
        ->orWhere('recipient_id', $myid)
        ->orderBy('created_at', 'desc')
        ->get()
        ->unique(function ($message) use ($myid) {
            return $message->user_id === $myid ? $message->recipient_id : $message->user_id;
        })
        ->groupBy(function ($message) use ($myid) {
            return $message->user_id === $myid ? $message->recipient_id : $message->user_id;
        })
        ->map(function ($messages) {
            return $messages->sortByDesc('created_at')->first();
        });

        $messages = Message::where(function ($query) use ($userId, $myid) {
            $query->where('user_id', $myid)->where('recipient_id', $userId);
        })->orWhere(function ($query) use ($userId, $myid) {
            $query->where('user_id', $userId)->where('recipient_id', $myid);
        })->get();

        $user = User::find($userId);

        return view('chats.show', compact('chats', 'messages', 'user'));
    }

    public function sendMessage(Request $request)
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!User::find($request->recipient_id)) {
            return redirect()->route('chats.index');
        }

        if ($request->recipient_id == Auth::id()) {
            return redirect()->route('chats.index');
        }

        if (Auth::user()->role == 'user' && User::find($request->recipient_id)->role == 'user' || Auth::user()->role == 'user' && User::find($request->recipient_id)->role == 'admin') {
            return redirect()->back();
        }

        $message = new Message();
        $message->user_id = Auth::id();
        $message->recipient_id = $request->recipient_id;
        $message->message = $request->message;
        $message->save();

        return redirect()->back();
    }
}
