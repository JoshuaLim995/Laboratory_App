<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Auth;
use Calendar;
use Session;
use App\MyCalendar;
use DataTables;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservations.index');
    }

    public function showCalendar()
    {
        $reservations = Reservation::get();
        $reservation_list = [];
        foreach ($reservations as $key => $reservation) {
            $reservation_list[] = Calendar::event(
                Reservation::$room_no[$reservation->room_no],            
                false,
                new \DateTime($reservation->starts_at),
                new \DateTime($reservation->ends_at)
                );
        }

    //     $reservation_list[] = Calendar::event(
    //         'Event One', //event title
    // false, //full day event?
    // '2018-06-15 20:00:00', //start time (you can also use Carbon instead of DateTime)
    // '2018-06-15 21:00:00', //end time (you can also use Carbon instead of DateTime)
    // 0 //optionally, you can specify an event ID
    // );

        // $calendar_details = Calendar::addEvents($reservation_list);


        $calendar_details = Calendar::addEvents($reservation_list);

        // ->setCallbacks([ 
        //     // 'viewRender' => 'function() {alert("Callbacks!");}',

        //     'eventClick' => 'function($reservation_list) {
        //         console.log($reservation_list);
        //         // alert($reservation_list);
        //         window.location.href = "{{ url($url) }}";
        //     }'
        //     ]);

        return view('reservations.calendar', [
            'calendar_details' => $calendar_details,
            ]);
    }

    public function get_datatable()
    {        
        $dt = Carbon::now()->toDateString();

        $user = Auth::user();
        if($user->isStaff())
            $reservations = Reservation::where('starts_at', '>=', $dt)->orderBy('starts_at', 'desc');
        elseif($user->isStudent())
            $reservations = $user->reservations;

        return $dataTables = DataTables::of($reservations)
        ->addColumn('room', function ($reservation) {
            return Reservation::$room_no[$reservation->room_no];
        })
        ->addColumn('date', function ($reservation) {
            return MyCalendar::dateOnly($reservation->starts_at);
        })
        ->addColumn('time', function ($reservation) {
            return MyCalendar::time($reservation->starts_at) . ' - ' .
            MyCalendar::time($reservation->ends_at);
        })
        ->addColumn('name', function ($reservation) {
            return $reservation->user->name;
        })
        ->addColumn('action', function ($reservation) {
            return '<a href="'. route('reservation.show', $reservation->id) .'" class="btn btn-info">View</a>';
        })
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request, $starts_at, $ends_at);

        $reservation = new Reservation();
        $reservation->purpose = $request->purpose;
        $reservation->room_no = $request->room_no;
        $reservation->starts_at = $starts_at;
        $reservation->ends_at = $ends_at;
        $reservation->user_id = Auth::id();


        $reservation->save();
        $request->session()->flash('success', 'Reservation successfully made');
        return redirect()->route('reservation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {        
        return view('reservations.show', [
            'reservation' => $reservation,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        $date = MyCalendar::date($reservation->starts_at);
        $starts_at = MyCalendar::time($reservation->starts_at);
        $ends_at = MyCalendar::time($reservation->ends_at);

        return view('reservations.edit', [
            'reservation' => $reservation,
            'date' => $date,
            'starts_at' => $starts_at,
            'ends_at' => $ends_at,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $this->validation($request, $starts_at, $ends_at);

        $reservation->purpose = $request->purpose;
        $reservation->room_no = $request->room_no;
        $reservation->starts_at = $starts_at;
        $reservation->ends_at = $ends_at;
        $reservation->user_id = Auth::id();


        $reservation->save();
        $request->session()->flash('success', 'Reservation successfully updated');
        return redirect()->route('reservation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }

    public function validation(Request $request, &$starts_at, &$ends_at)
    {
        $validator = Validator::make($request->all(), [
            'purpose' => 'required',
            'room_no' => 'required',
            'starts_at' => 'required',
            'ends_at' => 'required',
            ]);

        if($validator->fails())
        {
            $request->session()->flash('warning', 'Please fill in the required information');
            return redirect()->route('reservation.create')->withErrors($validator);
        }

        $starts_at = Carbon::parse($request->date . ' ' . $request->starts_at);
        $ends_at = Carbon::parse($request->date . ' ' . $request->ends_at);

        if($ends_at < $starts_at)
        {
            $request->session()->flash('warning', 'Please select valid time');
            return redirect()->route('reservation.create');
        }

        if(Reservation::checkClash($starts_at, $request->room_no))
        {
            $request->session()->flash('warning', 'Please choose another available timeslot');
            // $request->session()->flash('error', 'Please choose another available timeslot');
            return redirect()->route('reservation.create');
        }
    }

    public function delete(Reservation $reservation)
    {
        $reservation->delete();
        Session::flash('success', 'Item deleted successfully!');
        return redirect()->route('reservation.index');
    }
}
