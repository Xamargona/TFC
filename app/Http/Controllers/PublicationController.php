<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Tag;

class PublicationController extends Controller
{
    public function index(Request $request)
    {

        $publications = Publication::all();

        return view('publications.index', compact('publications'));
    }

    public function create()
    {
        return view('publications.create');
    }

    public function store(Request $request)
    {
        // Validar los datos recibidos del formulario
        if (!Auth::check() || Auth::user()->role = 'user') {
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $publication = new Publication();
        $publication->title = $validatedData['title'];
        $publication->user_id = auth()->user()->id;

        if ($request->hasFile('image')) {
            $imagen = $request->file('image');
            $ruta = 'images';
            $imagenPublication = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($ruta, $imagenPublication);
            $publication->image = "$imagenPublication";
        }

        $publication->save();

        $user = auth()->user();
        return redirect()->route('users.show', compact('user'))->with('success', 'La publicación ha sido creada correctamente.');
    }

    public function edit(Publication $publication)
    {
        return view('publications.edit', compact('publication'));
    }

    public function update(Request $request, Publication $publication)
    {

    }

    public function destroy(Publication $publication)
    {
        $publication->delete();

        return redirect()->route('publications.index');
    }
}
