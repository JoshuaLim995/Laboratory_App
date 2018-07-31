<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemLocation extends Model
{
    protected $fillable = [
    'inventory_id',
    'room_no',
    'floor_no',
    'quantity',
    ];

    public function inventory()
    {
    	return $this->belongsTo(Inventory::class);
    }
}
