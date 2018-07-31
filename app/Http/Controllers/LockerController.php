<?php

namespace App\Http\Controllers;

use Auth;
use App\Locker;
use App\RentLocker;
use DataTables;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Session;


class LockerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('locker.index');
    }

    public function get_datatable()
    {
        $lockers = Locker::select([
            'id',
            'locker_no',
            'floor_no',
            'type',
            'availablity',
            ]);

        return  DataTables::of($lockers)
        ->addColumn('floor_no', function ($locker) {
            return Locker::$floors[$locker->floor_no];
        })
        ->addColumn('type', function ($locker) {
            return Locker::$type[$locker->type];
        })
        ->addColumn('availablity', function ($locker) {
            return Locker::$availablity[$locker->availablity];
        })
        ->addColumn('action', function ($locker) {
            return $this->getActionButtons($locker);            
        })
        ->toJson();
    }

    public function getActionButtons($locker)
    {
        if(Auth::user()->isAdmin() || Auth::user()->isdlmsa())
        {
            return 
            '<div class="action">' .
            '<a href="'. route('locker.show', $locker) .'" class="btn btn-info">View</a>' . 
            '<a href="'. route('locker.edit', $locker) .'" class="btn btn-success">Edit</a>' .
            '<a href="'. route('locker.delete', $locker) .'" class="btn btn-danger"' . ' onclick="if(!confirm(' . "'Are you sure delete this record?'". ')){return false;};"' . '">Delete</a>' .
            '</div>';
        }
        else
        {
            return 
            '<div class="action">' .
            '<a href="'. route('locker.show', $locker) .'" class="btn btn-info">View</a>' . 
            '</div>';
        }
    }

    public function create()
    {
        return view('locker.create');
    }

    public function store(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'locker_no' => 'required',
            'type' => 'required',
            'floor_no' => 'required',
            ]);

        if($validator->fails()){
            $request->session()->flash('error', 'Please fill in the required information');
            return redirect()->route('locker.create')->withErrors($validator);
        }

        $locker = new Locker;
        $locker->fill($request->all());
        $locker->availablity = 1;
        $locker->save();

        return redirect()->route('locker.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\locker  $locker
     * @return \Illuminate\Http\Response
     */
    public function show(Locker $locker)
    {
        $rentLockers = RentLocker::where('locker_id', $locker->id)->limit(1)->get();
        if(count($rentLockers) > 0)
            $rentLocker = $rentLockers[0];
        else
            $rentLocker = null;

        return view('locker.show', [
            'locker' => $locker,
            'rentLocker' => $rentLocker,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\locker  $locker
     * @return \Illuminate\Http\Response
     */
    public function edit(Locker $locker)
    {
        return view('locker.edit', [
            'locker' => $locker,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\locker  $locker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Locker $locker)
    {
        $validator = Validator::make($request->all(), [
            'locker_no' => 'required',
            'type' => 'required',
            'floor_no' => 'required',
            ]);

        if($validator->fails()){
            $request->session()->flash('error', 'Please fill in the required information');
            return redirect()->route('locker.edit')->withErrors($validator);
        }

        $locker->fill($request->all());
        $locker->save();

        return redirect()->route('locker.index');
    }

    public function delete(Locker $locker)
    {
        $locker->delete();
        Session::flash('success', 'Locker deleted successfully!');
        return redirect()->route('locker.index');
    }
}
