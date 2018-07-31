<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loan;
use App\LoanItem;
use Session;

class ReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return view('return.index');
    }

    public function searchLoan(Request $request)
    {
        $loan = Loan::find($request->loan_id);
        if($loan)
            return redirect()->route('return.returnItem', $loan);
        else
            Session::flash('warning', 'No data found.');
        return back();
    }

    public function returnItem(Loan $loan)
    {
         // return view('loan.return', [
         //    'loan' => $loan,
         //    ]);

        return view('return.return_item', [
            'loan' => $loan,
            ]);
    }

    public function store(Request $request, Loan $loan)
    {
        $items = $request->item;
        $loan_items = $loan->loan_items;

        foreach ($loan_items as $key => $value) {
            if($request->$key == '1')
                $loan_items[$key]->update(['is_returned' => '1']);
            else
                $loan_items[$key]->update(['is_returned' => '0']);
        }

        if(count($loan->getReturnedItems) === count($loan_items))
        {
            Session::flash('success', 'All Items are returned.');
            $loan->returned(true);
        }
        else
        {
            Session::flash('success', 'Some items are returned.');
            $loan->returned(false);
        }

        return redirect()->route('loan.index');
    }
}
