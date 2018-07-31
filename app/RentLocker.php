<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentLocker extends Model
{
	use SoftDeletes;

	protected $fillable = [
	'user_id',
	'purpose',
	'date_from',
	'date_to',
	'locker_id',
	];

	protected $dates = ['deleted_at'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function locker()
	{
		return $this->belongsTo(Locker::class);
	}

	public function getActiveLocker()
	{
		$now = Carbon::now()->toDateString();
		return $this->where('date_to', '>=', $now);
	}
}
