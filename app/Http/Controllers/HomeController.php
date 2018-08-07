<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;

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
        if($user->isStudent())
        {
            $pending_loans = count($user->pending_loans);
            $approved_loans = count($user->approved_loans);
            $prepared_loans = count($user->prepared_loans);
            $overdue_loans = count($user->overdue_loans);

            $rent_locker = $user->rent_locker;

            $reservations = $user->reservations;

            return view('home', [
                'user' => $user,
                'rent_locker' => $rent_locker,
                'reservations' => $reservations,
                'pending_loans' => $pending_loans,
                'approved_loans' => $approved_loans,
                'prepared_loans' => $prepared_loans,
                'overdue_loans' => $overdue_loans,
                ]);
        }
        elseif($user->isAdmin())
        {
            $newUsers = User::where('approved', '0')->get();
            return view('home', [
                'user' => $user,
                'newUsers' => $newUsers,
                ]);
        }
    }
}
