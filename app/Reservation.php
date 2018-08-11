<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
    'user_id',
    'purpose',
    'room_no',
    'starts_at',
    'ends_at',
    ];

    public static $room_no = [
    '613' => 'KB613',
    '614' => 'KB614',
    '615' => 'KB615',
    '713' => 'KB713',
    '714' => 'KB714',
    '715' => 'KB715',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public static function checkClash($date, $room_no)
    {
        $reservation = Reservation::where([
            ['starts_at', '<=', $date],
            ['ends_at', '>', $date],
            ['room_no', '=', $room_no]
            ])->get();

        if(count($reservation) > 0)
            return true;
        else
            return false;
    }
}
