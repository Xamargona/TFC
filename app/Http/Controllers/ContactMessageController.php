<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!auth()->check()) {
            return redirect()->route('inicio');
        }

        if (auth()->check()) {
            if (auth()->user()->role == 'admin') {
                $messages = ContactMessage::orderBy('created_at', 'desc')->get();
            } else {
                return redirect()->route('inicio');
            }
        }

        return view('contactMessages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contactMessages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        $message = new ContactMessage();
        $message->username = $validatedData['username'];
        $message->email = $validatedData['email'];
        $message->subject = $validatedData['subject'];
        $message->text = $validatedData['text'];
        $message->save();

        return redirect()->route('inicio');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ContactMessage $message)
    {
        if ($message->readed == 0) {
            $message->readed = 1;
            $message->save();
        }
        return view('contactMessages.show');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('contactMessages.index')->with('success', 'Mensaje eliminado correctamente');
    }
}
