<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanItem extends Model
{
	protected $fillable = [
	'inventory_id',
	'quantity',
	'loan_id',
	];

	public function loan()
	{
		return $this->belongsTo(Loan::class);
	}

	public function inventory()
	{
		return $this->belongsTo(Inventory::class);
	}
}
