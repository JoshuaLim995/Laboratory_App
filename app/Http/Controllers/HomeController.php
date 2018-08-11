<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;

class HomeController extends Controller
{
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




    // public function index()
    // {
    //     $arr = [];
    //     $r = ['g', 'g'];

    //     $arr;
    //     // return $arr;

    //     $l = 1;
    //     while ($l <= 40) 
    //     {
    //         for($f = 5; $f < 9; $f++)
    //         {
    //             $filled_int = sprintf("%03d", $l);
    //             $l++;
    //             if($l % 2 === 0)
    //                 $t = 'A';
    //             else
    //                 $t = 'B';

    //             echo "
    //             [
    //             'locker_no' => '". $filled_int ."',
    //             'floor_no' => '". $f . "',
    //             'type' => '". $t ."',
    //             'availablity' => '1',
    //             ],
    //             ";

    //             echo "<br>";
    //         }            
    //         echo "<br>";
    //     }
    // }
}
