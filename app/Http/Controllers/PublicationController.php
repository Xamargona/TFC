<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $publications = Publication::with('tags');

        if ($request->has('tags')) {
            $tags = explode(',', $request->input('tags'));
            $publications->whereHas('tags', function ($query) use ($tags) {
                $query->whereIn('name', $tags);
            });
        }

        $publications = $publications->get();

        return view('publications.index', compact('publications'));
    }

    public function create()
    {
        $tags = Tag::all();
        $users = User::all();

        return view('publications.create', compact('tags', 'users'));
    }

    public function store(Request $request)
    {
        $publication = new Publication($request->only(['title', 'image']));
        $publication->user_id = $request->input('user_id');
        $publication->save();

        $publication->tags()->sync($request->input('tags', []));

        return redirect()->route('publications.index');
    }

    public function edit(Publication $publication)
    {
        $tags = Tag::all();
        $users = User::all();

        return view('publications.edit', compact('publication', 'tags', 'users'));
    }

    public function update(Request $request, Publication $publication)
    {
        $publication->update($request->only(['title', 'image', 'user_id']));

        $publication->tags()->sync($request->input('tags', []));

        return redirect()->route('publications.index');
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();

        return redirect()->route('publications.index');
    }
}
