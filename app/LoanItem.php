<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanItem extends Model
{
	protected $fillable = [
	'inventory_id',
	'requested_quantity',
	'approved_quantity',
	'remark',
	'loan_id',
	'is_returned',
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
