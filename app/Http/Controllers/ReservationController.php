<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;

use Auth;
use Calendar;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::get();
        $reservation_list = [];
        foreach ($reservations as $key => $reservation) {
            $reservation_list[] = Calendar::event(
                $reservation->user_id,
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



$url = 'www.google.com';
        $calendar_details = Calendar::addEvents($reservation_list)
        ->setCallbacks([ 
            // 'viewRender' => 'function() {alert("Callbacks!");}',

            'eventClick' => 'function($reservation_list) {
                console.log($reservation_list);
                // alert($reservation_list);
                window.location.href = "{{ url($url) }}";
            }'
            ]);

        return view('reservations.index', [
            'calendar_details' => $calendar_details,
            ]);
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
        $reservation = new Reservation();
        $reservation->fill($request->all());
        $reservation->user_id = Auth::id();
        $reservation->save();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
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
        //
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
}
