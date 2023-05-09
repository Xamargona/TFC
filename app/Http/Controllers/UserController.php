<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $users = User::all();
            return view('users.index', compact('users'));
        }
        $users = User::where('role', 'artist')->get();
        return view('users.index', compact('users'));
    }

    public function searchByName(Request $request)
    {
        $username = $request->input('username');
        if (Auth::check() && Auth::user()->role == 'admin') {
            $users = User::where('username', 'LIKE', '%' . $username . '%')->get();
            return view('users.index', compact('users'));
        }
        $users = User::where('username', 'LIKE', '%' . $username . '%')->where('role', 'artist')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('users.show', compact('user'));
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
    public function update(Request $request, User $id)
    {
        $user = User::findOrFail($id);

        // Validar los campos del formulario
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'profile_picture' => ['nullable', 'image', 'max:2048'],
            'bio' => ['nullable', 'string', 'max:255'],
        ]);

        // Actualizar los campos del usuario
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        if ($validatedData['password']) {
            $user->password = Hash::make($validatedData['password']);
        }
        if ($validatedData['profile_picture']) {
            $user->profile_picture = $validatedData['profile_picture']->store('public/profile_pictures');
        }
        $user->bio = $validatedData['bio'];
        $user->save();

        return redirect()->route('users.show', $user->id)->with('success', 'Usuario actualizado correctamente');
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
        $result = User::find($id);
        if ($result) {
            $result->delete();
            return redirect()->route('users.index')->with('success', 'El usuario ha sido eliminado correctamente.');
        } else {
            return redirect()->route('users.index')->with('error', 'No se ha encontrado el usuario a eliminar.');
        }
    }
}
