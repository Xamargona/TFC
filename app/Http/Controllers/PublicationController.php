<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    public function index(Request $request)
    {

        if($request->has('etiquetas')) {

            $etiquetas = $request->get('etiquetas');

            $publications = Publication::whereHas('tags', function($query) use ($etiquetas) {
                $query->whereIn('tag_id', $etiquetas);
            })->get();

            $tipos = Tag::all()->sortBy('name');
            return view('publications.index', compact('publications', 'tipos'));
        }
        $publications = Publication::all()->sortByDesc('created_at');
        $tipos = Tag::all()->sortBy('name');
        return view('publications.index', compact('publications', 'tipos'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->back();
        } elseif (Auth::user()->role != 'artist') {
            return redirect()->back();
        }

        $tipos = Tag::all()->sortBy('name');
        return view('publications.create', compact('tipos'));
    }

    public function store(Request $request)
    {

        if (!Auth::check()) {
            return redirect()->back();
        } elseif (Auth::user()->role != 'artist') {
            return redirect()->back();
        }
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'title.required' => 'El título es obligatorio.',
            'title.string' => 'El título debe ser un texto.',
            'title.max' => 'El título no puede superar los 255 caracteres.',
            'image.required' => 'La imagen es obligatoria.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg, gif o svg.',
            'image.max' => 'La imagen no puede superar los 2048 kilobytes.',
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
        if ($request->has('etiquetas')) {
            $publication->tags()->detach();
            $tags = $request->input('etiquetas');
            $publication->tags()->attach($tags);
        }

        $user = auth()->user();
        return redirect()->route('users.show', compact('user'))->with('success', 'La publicación ha sido creada correctamente.');
    }

    public function edit(Publication $publication)
    {
        if (!Auth::check()) {
            return redirect()->back();
        } elseif (Auth::user()->role != 'artist') {
            return redirect()->back();
        } elseif ($publication->user_id != Auth::user()->id) {
            return redirect()->back();
        }
        $tipos = Tag::all()->sortBy('name');
        return view('publications.edit', compact('publication', 'tipos'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->back();
        } elseif (Auth::user()->role != 'artist') {
            return redirect()->back();
        }

        $publication = Publication::findOrFail($id);

        if ($publication->user_id != Auth::user()->id) {
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.string' => 'El título debe ser un texto.',
            'title.max' => 'El título no puede superar los 255 caracteres.',
            'image.required' => 'La imagen es obligatoria.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg, gif o svg.',
            'image.max' => 'La imagen no puede superar los 2048 kilobytes.',
        ]);

        if ($request->hasFile('image')) {
            unlink(public_path('images/' . $publication->image));
            $imagen = $request->file('image');
            $ruta = 'images';
            $imagenPublication = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($ruta, $imagenPublication);
            $publication->image = "$imagenPublication";
        } else {
            return redirect()->back()->with('error', 'No se ha podido subir la imagen.');
        }
        $publication->title = $validatedData['title'];

        $publication->save();

        $user = auth()->user();
        return redirect()->route('users.show', compact('user'))->with('success', 'La publicación ha sido actualizada correctamente.');
    }


    public function destroy(Publication $publication)
    {
        if (!Auth::check()) {
            return redirect()->back();
        } elseif (Auth::user()->role != 'artist') {
            return redirect()->back();
        } elseif ($publication->user_id != Auth::user()->id) {
            return redirect()->back();
        }
        if (file_exists(public_path('images/' . $publication->image))) {
            unlink(public_path('images/' . $publication->image));
        }
        $publication->tags()->detach();
        $publication->delete();

        return redirect()->route('publications.index');
    }
}
