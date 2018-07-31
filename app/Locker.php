<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
	protected $fillable = [
	'locker_no', 
	'floor_no',
	'type',
	'availablity',
	];

	public static $type = [
	'A' => 'Normal Locker',
	'B' => 'Steel Cabinet',
	];

	public static $floors = [
	'5' => 'Floor 5',
	'6' => 'Floor 6',
	'7' => 'Floor 7',
	'8' => 'Floor 8',
	// '9' => 'Floor 9',
	];

	public static $availablity = [
	'0' => 'Not Available',
	'1' => 'Available',
	];

	public function rent_locker()
	{
		return $this->belongsTo(RentLocker::class);
	}

	public function floor()
	{
		return $this->belongsTo(StaffFloor::class);
	}
}
