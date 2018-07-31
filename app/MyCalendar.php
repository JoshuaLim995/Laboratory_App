<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MyCalendar extends Model
{
	public static function time($time)
	{
		return Carbon::parse($time)->format('h:i A ');
	}

	public static function dayDate($date)
	{
		return Carbon::parse($date)->format('l, F d, Y');
	}

	public static function dateOnly($date)
	{
		return Carbon::parse($date)->format('F d, Y');
	}

	public static function sqlDateOnly($date)
	{
		return Carbon::parse($date)->format('Y-m-d');
	}

	public static function compareDate($first, $second)
	{
		return Carbon::parse($first)->diffInDays(Carbon::parse($second));
	}
}
