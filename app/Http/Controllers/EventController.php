<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->back();
        } elseif (Auth::user()->role != 'admin') {
            return redirect()->back();
        }
        return view('events.create');
    }

    public function store()
    {
        if (!Auth::check()) {
            return redirect()->back();
        } elseif (Auth::user()->role != 'admin') {
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $publication = new Publication();

        if ($request->hasFile('image')) {
            $imagen = $request->file('image');
            $ruta = 'images';
            $imagenPublication = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($ruta, $imagenPublication);
            $publication->image = "$imagenPublication";
        } else {
            return redirect()->back()->with('error', 'No se ha podido subir la imagen.');
        }
        $publication->title = $validatedData['title'];
        $publication->user_id = auth()->user()->id;

        $publication->save();

        $user = auth()->user();
        return redirect()->route('users.show', compact('user'))->with('success', 'La publicación ha sido creada correctamente.');

    }

}
