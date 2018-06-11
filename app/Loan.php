<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
	'user_id', 
	'purpose',
	'date_from',
	'date_to',
	'status',
	];

	public function loan_items()
	{
		return $this->hasMany(LoanItem::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
