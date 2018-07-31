<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Locker;
use App\RentLocker;
use Auth;
use Carbon\Carbon;
use Session;

class RentLockerController extends Controller
{
	public function index()
	{
		return view('locker.rent_locker');
	}

	public function checkActiveLocker()
	{		
		$now = Carbon::now()->toDateString();
		$userLocker = Auth::user()->rent_locker;

		if($userLocker === null)
		{
			return true;
		}
		elseif($userLocker->date_to > $now)
		{
			Session::flash('warning', 'One student can only rent one locker at a time.');
			return false;
		}
		else
		{
			$this->setLockerAvail($userLocker->locker_id);
			$userLocker->delete();
			return true;
		}
	}

	public function setLockerAvail($id)
	{
		$locker = Locker::find($id);
		$locker->update(['availablity' => 1]);
	}


	public function store(Request $request)
	{
		$request->validate([
			'purpose' => 'required',
			'type' => 'required',
			'date_from' => 'required',
			'date_to' => 'required',
			'floor' => 'required',
			],
			[
			'floor.required' => 'Please choose floor level.'
			]);

		if(!$this->checkActiveLocker())
		{
			return redirect()->route('rentLocker.index');
		}

		$locker_array = Locker::where('floor_no', $request->floor)->where('availablity', 1)->where('type', $request->type)->get();

		if(count($locker_array) > 0){
			$locker = $locker_array[0];

            // echo 'Locker ' . $locker->locker_no . ' is ' . Common::$status[$locker->status];

			$rent_locker = new RentLocker;
			$rent_locker->user_id = Auth::id();
			$rent_locker->purpose = $request->purpose;
			$rent_locker->date_from = Carbon::parse($request->date_from);
			$rent_locker->date_to = Carbon::parse($request->date_to);


			$locker->update(['availablity' => 0]);
            // echo Common::$status[$locker[0]->status];
            // echo 'Locker ID: ' . $locker->id;

			$rent_locker->locker_id = $locker->id;
			$rent_locker->save();

			return redirect()->route('home');

		}else{
			$message = 'No locker available';
			$request->session()->flash('warning', $message);
			return redirect()->route('rentLocker.index');
		}
	}
}
