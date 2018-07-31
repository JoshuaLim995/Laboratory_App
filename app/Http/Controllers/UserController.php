<?php

namespace App\Http\Controllers;

use DataTables;
use Session;
use Bouncer;
use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('staff');
        $this->middleware('admin', ['only' => ['edit', 'update', 'delete']]);
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', [
        	'users' => $users,
        	]);
    }

    public function get_datatable()
    {
        $users = User::select([
            'id',
            'name',
            'email',
            'contact',
            ]);

        return DataTables::eloquent($users)
        ->addColumn('role', function ($user) {
            return $user->role('title');
        })
        ->addColumn('action', function ($user) {
            return $this->getActionButtons($user);
        })
        ->toJson();
    }

    public function getActionButtons($user)
    {
        if(Auth::user()->isAdmin() || Auth::user()->isdlmsa())
        {
            return 
            '<div class="action">' .
            '<a href="'. route('user.show', $user) .'" class="btn btn-info">View</a>' . 
            '<a href="'. route('user.edit', $user) .'" class="btn btn-success">Edit</a>' .
            '<a href="'. route('user.delete', $user) .'" class="btn btn-danger"' . ' onclick="if(!confirm(' . "'Are you sure delete this record?'". ')){return false;};"' . '">Delete</a>' .
            '</div>';
        }
        else
        {
            return 
            '<div class="action">' .
            '<a href="'. route('user.show', $user) .'" class="btn btn-info">View</a>' . 
            '</div>';
        }

    }

    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if($user->isdlmsa())
        {
            if(Auth::user()->isdlmsa())
                return view('users.edit', [
                    'roles' => Bouncer::role()->pluck('title', 'name'),
                    'user' => $user,
                    ]);
            else
            {
                Session::flash('warning', 'Access Denied. You do not have the superadmin access');
                return redirect()->route('user.index');
            }
        }
        else
            return view('users.edit', [
                'user' => $user,
                'roles' => Bouncer::role()->pluck('title', 'name')->except('dlmsa'),
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'department' => 'required',
            'contact' => 'required',
            ]);

        $user->fill($request->all());
        $user->save();
        $user->roles()->detach();
        Bouncer::assign($request->type)->to($user);

        $request->session()->flash('success', 'User updated successfully!');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user)
    {
        if(Auth::id() === $user->id)
        {
            Session::flash('warning', 'Warning. Unsafe operation detected.');
            return redirect()->route('user.index');
        }
        else
        {
            if($user->isdlmsa())
            {
                if(Auth::user()->isdlmsa())
                {
                    $user->roles()->detach();
                    $user->delete();
                    Session::flash('success', 'User deleted successfully!');
                    return redirect()->route('user.index');
                }
                else
                {
                    Session::flash('warning', 'Access Denied. You do not have the superadmin access');
                    return redirect()->route('user.index');
                }
            }
            else
            {
                $user->roles()->detach();
                $user->delete();
                Session::flash('success', 'User deleted successfully!');
                return redirect()->route('user.index');
            }
        }
    }

}
