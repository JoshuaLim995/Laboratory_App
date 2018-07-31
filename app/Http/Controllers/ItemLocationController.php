<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\ItemLocation;
use Session;

class ItemLocationController extends Controller
{
	public function create(Request $request)
	{
		$inventory = Inventory::find($request->inventory);
		if($inventory)
			return view('location.create', ['inventory' => $inventory]);
		else{
			Session::flash('warning', 'Invalid Inventory ID');
			return back();
		}
	}

	public function store(Request $request)
	{
		$request->validate([
            'room_no' => 'required',
            'floor_no' => 'required',
            'quantity' => 'required',
            ]);

		$location = new ItemLocation;
		$location->fill($request->all());
		$location->save();
		Session::flash('success', 'New item location added successfully!');
		return redirect()->route('inventory.show', $request->inventory_id);
	}

	public function edit(ItemLocation $location)
	{
		return view('location.edit', [
			'inventory' => $location->inventory,
			'location' => $location,
			]);
	}

	public function update(Request $request, ItemLocation $location)
	{
		$location->fill($request->all());
		$location->save();
		Session::flash('success', 'Item location updated successfully!');
		return redirect()->route('inventory.show', $request->inventory_id);
	}

    public function delete(ItemLocation $location)
    {
        $location->delete();
        Session::flash('success', 'Item deleted successfully!');
        return redirect()->route('inventory.show', $location->inventory_id);
    }
}
