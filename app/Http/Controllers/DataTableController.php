<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemLocation;
use App\Transaction;
use DataTables;

class DataTableController extends Controller
{
	public function getItemLocations(Request $request)
	{
		$itemLocations = ItemLocation::select([
			'id',
			'room_no',
			'floor_no',
			'quantity',
			])->where('inventory_id', $request->inventory_id);
			// ])->where('inventory_id', '1');

		return DataTables::eloquent($itemLocations)
		->addColumn('action', function ($itemLocation) {
			return '<div class="action">' .
			// '<a href="'. route('inventory.show', $inventory) .'" class="btn btn-info">View</a>' . 
			'<a href="'. route('location.edit', $itemLocation->id) .'" class="btn btn-success">Edit</a>' .
			'<a href="'. route('location.delete', $itemLocation) .'" class="btn btn-danger"' . ' onclick="if(!confirm(' . "'Are you sure delete this record?'". ')){return false;};"' . '">Delete</a>' .
			'</div>';
		})
		->toJson();
	}

	public function getInventoryTransaction(Request $request)
	{
		$transactions = Transaction::select([
			'location_id',
			'quantity',
			'user',
			'date',
			'type',
			])->where('inventory_id', $request->inventory_id);
			// ])->where('inventory_id', '1');



		return DataTables::eloquent($transactions)
		->addColumn('location', function ($transaction) {
			$location = ItemLocation::find($transaction->location_id)->room_no;
			return $location;
		})
		->toJson();
	}
}
