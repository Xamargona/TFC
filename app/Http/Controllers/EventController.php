<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back();
        } elseif (Auth::user()->role != 'admin') {
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $event = new Event();

        if ($request->hasFile('image')) {
            $imagen = $request->file('image');
            $ruta = 'images';
            $imagenevent = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($ruta, $imagenevent);
            $event->image = "$imagenevent";
        } else {
            return redirect()->back()->with('error', 'No se ha podido subir la imagen.');
        }
        $event->title = $validatedData['title'];
        $event->description =  $validatedData['description'];

        $event->save();

        return redirect()->route('events.index')->with('success', 'El evento ha sido creado correctamente.');
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            unlink(public_path('images/' . $event->image));
            $imagen = $request->file('image');
            $ruta = 'images';
            $imagenEvent = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($ruta, $imagenEvent);
            $event->image = "$imagenEvent";
        } else {
            return redirect()->back()->with('error', 'No se ha podido subir la imagen.');
        }
        $event->title = $validatedData['title'];
        $event->description = $validatedData['description'];

        $event->save();

        return redirect()->route('events.index')->with('success', 'El evento ha sido actualizado correctamente.');
    }

    public function destroy(Event $event)
    {
        if (!Auth::check()) {
            return redirect()->back();
        } elseif (Auth::user()->role != 'admin') {
            return redirect()->back();
        }
        unlink(public_path('images/' . $event->image));

        $event->delete();
        return redirect()->route('events.index')->with('success', 'El evento ha sido eliminado correctamente.');
    }

}
