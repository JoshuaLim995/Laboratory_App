<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', [
            'user' => $user,
            ]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', [
            'user' => $user,
            ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'department' => 'required',
            'contact' => 'required',
            ]);

        $user->fill($request->all());
        $user->save();

        $request->session()->flash('success', 'User updated successfully!');
        return redirect()->route('profile.index');
    }
}
