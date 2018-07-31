<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	protected $fillable = [
	'inventory_id',
	'location_id',
	'quantity',
	'user',
	'date',
	'type',
	];

	public function inventory()
	{
		return $this->belongsTo(Inventory::class);
	}

	public function locations()
	{
		return $this->belongsTo(ItemLocation::class);
	}
}
