<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
	protected $fillable = [
	'inventory_id',
	'name1', 
	'name2',
	'code',
	'model',
	'brand',
	'seri_no',
	'ass_code',
	'cost',
	'pr_no',
	'po',
	'inv_no',
	'do',
	'do_date',
	'supp_cont',
	'initiator',
	'purpose',
	'sub_code',
	'cat',
	'el',
	'rpmc',
	'remark',
	];


	public static $purpose = [
	'ger' => 'General',
	'tea' => 'Teaching',
	'rea' => 'Research',
	];

	public function inventory()
	{
		return $this->belongsTo(Inventory::class);
	}
}
