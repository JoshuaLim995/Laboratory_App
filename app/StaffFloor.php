<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffFloor extends Model
{
	protected $fillable = [
	'staff_id',
	'floor_no',
	];

	public function staff()
	{
		return $this->belongsTo(User::class);
	}

	public function lockers()
	{
		return $this->hasMany(Locker::class);
	}
}
