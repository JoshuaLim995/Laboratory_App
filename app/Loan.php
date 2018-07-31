<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Loan extends Model
{
	protected $fillable = [
	'user_id', 
	'venue',
	'date_from',
	'date_to',
	'status',
	'message',
	];

	public static $status = [
	'0' => 'Pending',
	'1' => 'Approved',
	'2' => 'Item prepared',
	'3' => 'Recieved',
	'4' => 'Returned',
	'5' => 'Partial returned',
	'9' => 'Canceled',
	'10' => 'Declined',
	'99' => 'Overdue',
	];

	public static $is_returned = [
	'0' => 'Not returned',
	'1' => 'Returned',
	];

	public function getStatus($value)
	{
		return $this::$status[$value];
	}

	public function updateStatus($value)
	{
		$this->update(['status' => $value]);
	}

	public function compareStatus($value)
	{
		return $this->status === $value;
	}

	public function returned($value)
	{
		if($value)
			$this->updateStatus(4);
		else
			$this->updateStatus(5);
	}

	public function isOverDue()
	{
		$now = Carbon::now();
		if($this->date_to < $now && ($this->compareStatus('3') || $this->compareStatus('5')))
			return true;
		else
			return false;
	}

	public function getPrepared()
	{
		return $this->where('status', '2')->get();
	}

	public function loan_items()
	{
		return $this->hasMany(LoanItem::class);
	}

	public function getReturnedItems()
	{
		return $this->loan_items()->where('is_returned', '1');
	}

	public function loan_token()
	{
		return $this->hasOne(LoanToken::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}