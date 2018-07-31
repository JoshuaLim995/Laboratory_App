<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Inventory;
use App\ItemLocation;
use App\MyCalendar;
use Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = Inventory::pluck('name', 'id')->all();

        return view('transaction.create', [
            'inventory' => $inventory,
            'locations' => [],
            ]);


    }

    public function selectAjax(Request $request)
    {
        if($request->ajax()){
            $itemLocation = ItemLocation::where('inventory_id',$request->inventory_id)->pluck("room_no","id")->all();
            $data = view('transaction.ajax-select',compact('itemLocation'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Inventory $inventory)
    {
        return view('transaction.create', [
            'inventory' => $inventory,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'type' => 'required',
            'inventory_id' => 'required',
            'location_id' => 'required',
            'quantity' => 'required',
            'date' => 'required',
            ]);

        $transaction = new Transaction;
        $transaction->fill($request->all());
        $transaction->date = MyCalendar::sqlDateOnly($request->date);
        $transaction->save();

        switch ($request->type) {
            case 'out':
                $quantity = -1 * $request->quantity;
                break;
            
            default:
                $quantity = $request->quantity;
                break;
        }

        $this->updateItemLocationQuantity($request->location_id, $quantity);

        Session::flash('success', 'Transaction complete');
        return redirect()->route('transaction.index');
    }

    public function updateItemLocationQuantity($location_id, $quantity)
    {
        $location = ItemLocation::find($location_id);
        $new = $location->quantity + $quantity;
        $location->update(['quantity' => $new]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
