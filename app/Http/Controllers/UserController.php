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

    public function search(Request $request)
    {
        $username = $request->input('username');
        if (Auth::check() && Auth::user()->role == 'admin') {
            $users = User::where('username', 'LIKE', '%' . $username . '%')->get();
            return view('users.index', compact('users'));
        }
        $users = User::where('username', 'LIKE', '%' . $username . '%')->where('role', 'artist')->get();
        return view('users.index', compact('users'));
    }

    public function changeRole($id)
    {
        $user = User::findOrFail($id);

        if (Auth::check() && Auth::user()->role == 'admin') {
            if ($user->role == 'artist') {
                $user->role = 'user';
            } else {
                $user->role = 'artist';
            }

            $user->save();

            return redirect()->back()->with('success', 'User role from '.$user->username.' updated successfully to '.$user->role);
        }

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
        $user = User::findOrFail($id);
        $followers = UserArtist::where('artist_id', $id)->with('followers')->get();
        return view('users.show', compact('user', 'followers'));
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
        if (!Auth::check()) {
            return redirect()->route('inicio');
        }else if (Auth::user()->id != $id->id) {
            return redirect()->route('inicio');
        }

        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'bio' => ['nullable', 'string', 'max:255'],
        ]);

        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        if ($validatedData['password']) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->bio = $validatedData['bio'];
        $user->save();

        return redirect()->route('users.show', $user->id)->with('success', 'Información actualizada correctamente');
    }

    public function uploadAvatar(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('inicio');
        }else if (Auth::user()->id != $request->user()->id) {
            return redirect()->route('inicio');
        }

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::find($request->user()->id);

        if ($request->hasFile('avatar')) {
            $avatarName = $request->user()->id.'_avatar'.time().'.'.$request->avatar->extension();
            $request->avatar->storeAs('app/public/profile_pictures/', $avatarName);

            if ($user->avatar) {
                Storage::delete('app/public/profile_pictures/' . $user->avatar);
            }

            $user->avatar = $avatarName;
            $user->save();
        }

        return back();
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
