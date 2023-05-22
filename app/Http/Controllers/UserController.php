<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('name');

        if ($searchTerm && Auth::check() && Auth::user()->role == 'admin') {
            $users = User::where('username', 'LIKE', "%{$searchTerm}%")->get();
        } else if(Auth::check() && Auth::user()->role == 'admin') {
            $users = User::all();
        } else if($searchTerm && $searchTerm != ''){
            $users = User::where('username', 'LIKE', "%{$searchTerm}%")->where('role', 'artist')->get();
        } else {
            $users = User::where('role', 'artist')->get();
        }
        return view('users.index', compact('users'));
    }


    public function changeRole($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if(Auth::user()->role != 'admin') {
            return redirect()->back();
        }

        $user = User::find($id);
        if ($user->role == 'user') {
            $user->role = 'artist';
        } else {
            $user->role = 'user';
        }
        $user->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $publications = $user->publications()->orderBy('created_at', 'desc')->get();
        return view('users.show', compact('user', 'publications'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (!Auth::check()) {
            return redirect()->route('inicio');
        }else if (Auth::user()->id != $user->id) {
            return redirect()->route('inicio');
        }
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('inicio');
        }else if (Auth::user()->id != $id) {
            return redirect()->route('inicio');
        }

        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
            ],
            'bio' => [
                'nullable',
                'string',
                'max:255',
            ],
        ], [
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.string' => 'El nombre de usuario debe ser una cadena de texto.',
            'username.max' => 'El nombre de usuario no puede superar los 255 caracteres.',
            'username.unique' => 'El nombre de usuario ya está en uso.',
            'email.required' => 'El email es obligatorio.',
            'email.string' => 'El email debe ser una cadena de texto.',
            'email.email' => 'El email debe ser una dirección de correo válida.',
            'email.max' => 'El email no puede superar los 255 caracteres.',
            'email.unique' => 'El email ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'bio.string' => 'La biografía debe ser una cadena de texto.',
            'bio.max' => 'La biografía no puede superar los 255 caracteres.',
        ]);

        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->bio = $validatedData['bio'];
        $user->save();

        return redirect()->route('users.show', $user->id)->with('success', 'Información actualizada correctamente');
    }

    public function uploadAvatar(Request $request)
    {

        if (!Auth::check()) {
            return redirect()->route('inicio');
        }

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,gif|max:2048',
        ]);

        $user = Auth::user();
        if ($request->hasFile('image')) {
            if ($user->avatar != null) {
                unlink(public_path('images/' . $user->avatar));
            }
            $avatar = $request->file('image');
            $ruta = 'images';
            $imagenAvatar = date('YmdHis') . "." . $avatar->getClientOriginalExtension();
            $avatar->move($ruta, $imagenAvatar);
            $user->avatar = "$imagenAvatar";
        } else {
            return redirect()->back()->with('error', 'No se ha podido subir la imagen.');
        }

        $user->save();

        $user = auth()->user();
        return redirect()->route('users.show', compact('user'))->with('success', 'La publicación ha sido creada correctamente.');

        return back();
    }

    public function follow($id) {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if(Auth::user()->id == $id) {
            return redirect()->back();
        }
        $user = Auth::user();
        $user->following()->toggle($id);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ((!Auth::check() && Auth::user()->id != $user->id) || (!Auth::check() && Auth::user()->role != 'admin')) {
            return redirect()->route('inicio');
        }

        if ($user) {
            unlink(public_path('images/' . $user->avatar));
            $user->delete();
            return redirect()->route('users.index')->with('success', 'El usuario ha sido eliminado correctamente.');
        } else {
            return redirect()->route('users.index')->with('error', 'No se ha encontrado el usuario a eliminar.');
        }
    }


}
