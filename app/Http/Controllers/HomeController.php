<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $pending_loans = count($user->pending_loans);
        $approved_loans = count($user->approved_loans);
        $prepared_loans = count($user->prepared_loans);
        $overdue_loans = count($user->overdue_loans);

        $rent_locker = $user->rent_locker;

        $reservations = $user->reservations;

        return view('home', [
            'rent_locker' => $rent_locker,
            'reservations' => $reservations,
            'pending_loans' => $pending_loans,
            'approved_loans' => $approved_loans,
            'prepared_loans' => $prepared_loans,
            'overdue_loans' => $overdue_loans,
            ]);
    }
}
