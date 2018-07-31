<?php

namespace App\Http\Controllers;

use Bouncer;
use Auth;
use Keygen;
use Hash;
use DataTables;
use App\User;
use App\Loan;
use App\LoanToken;
use App\LoanItem;
use App\MyCalendar;
use Illuminate\Http\Request;
use Snowfire\Beautymail\Beautymail;
use Validator;
use Session;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        return view('loan.index');
    }

    public function get_datatable()
    {
        $user = Auth::user();
        if($user->isStaff())
            // $loans = Loan::orderBy('date_from', 'desc');
            $loans = Loan::all();
        elseif($user->isStudent())
            $loans = $user->loans;

        return $dataTables = DataTables::of($loans)
        ->addColumn('status', function ($loan) {
            return $loan->getStatus($loan->status);
        })
        ->addColumn('created_at', function ($loan) {
            return MyCalendar::dateOnly($loan->created_at);
        })
        ->addColumn('date_from', function ($loan) {
            return MyCalendar::dateOnly($loan->date_from);
        })
        ->addColumn('date_to', function ($loan) {
            if($loan->isOverDue())
                $loan->updateStatus(99);
            return MyCalendar::dateOnly($loan->date_to);
        })
        ->addColumn('user_name', function ($loan) {
            if($loan->user)
                return $loan->user->name;
            else
                return 'N/A';
        })
        ->addColumn('department', function ($loan) {
            if($loan->user)
                return $loan->user->department;
            else
                return 'N/A';
        })
        ->addColumn('action', function ($loan) {
            return '<a href="'. route('loan.show', $loan->id) .'" class="btn btn-info">View</a>';
        })
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date_from' => 'required',
            'date_to' => 'required',
            ]);

        if($validator->fails()){
            $request->session()->flash('error', 'Please fill in the required information');

            return redirect()->route('loan.create')->withErrors($validator);
        }
        $loan = new Loan();
        $loan->user_id = Auth::id();
        $loan->date_from = MyCalendar::sqlDateOnly($request->date_from);
        $loan->date_to = MyCalendar::sqlDateOnly($request->date_to);
        $loan->status = '0';
        $loan->venue = $request->venue;
        $loan->save();


        if(!is_null($request->inventory[0]))
        {
            foreach ($request->inventory as $i => $inventory_id)
            {
                if (!empty($inventory_id)) {
                    $loan_item = new LoanItem();
                    $loan_item->inventory_id = $inventory_id;
                    $loan_item->requested_quantity = $request->quantity[$i];
                    $loan_item->loan_id = $loan->id;
                    $loan_item->is_returned = 0;
                    $loan_item->save();
                }                
            }
        }
        else
        {
            $request->session()->flash('warning', 'Missing Item');            
            $loan->delete();
            return redirect()->route('loan.create');
        }

        $token_approve = Keygen::alphanum(64)->generate();
        $token_decline = Keygen::alphanum(64)->generate();

        $loanToken = new LoanToken();
        $loanToken->loan_id = $loan->id;
        // $loanToken->token_approve = Hash::make($token_approve);
        // $loanToken->token_decline = Hash::make($token_decline);
        $loanToken->token_approve = $token_approve;
        $loanToken->token_decline = $token_decline;
        $loanToken->save();

        $this->sendEmail($loan, $token_approve, $token_decline);

        return redirect()->route('loan.index');
    }

    public function sendEmail($loan, $token_approve, $token_decline)
    {
        $approve_link = env('APP_URL') . 'loan/' . $loan->id . '/approval/' . $token_approve;
        $decline_link = env('APP_URL') . 'loan/' . $loan->id . '/approval/' . $token_decline;

        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.loan_request', [
            'loan' => $loan,
            'approve_link' => $approve_link,
            'decline_link' => $decline_link,
            ], function($message) 
            {
                $email = User::find(1)->email;

                $message
                ->from(env('EMAIL_ADDR'))
                ->to($email)
                ->subject('New Loan Request Need Approval');
            });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        if($loan->isOverDue())
                $loan->updateStatus(99);

        return view('loan.show', [
            'loan' => $loan,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }

    public function checkDue(Loan $loan)
    {
        $now = Carbon::now();
        if($loan->date_to < $now)
            return 'ovedue';
        else
            return 'not';
    }

    public function cancel(Loan $loan)
    {
        if(Auth::id() === $loan->user_id)
        {
            if($loan->compareStatus('0'))
            {
                $loan->updateStatus(9);
                Session::flash('success', 'Loan canceled');
            }
            else
                Session::flash('warning', 'Unable to cancel');
        }            
        else
            Session::flash('warning', 'You are not authorised to perform this action');

        return redirect()->route('loan.show', $loan);
    }

    public function approval($id, $token)
    {
        if(Auth::user()->isdlmsa()){
            if($loan = Loan::find($id)){
                $loanToken = $loan->loan_token;
                if($token === $loanToken->token_approve)
                {
                    $loan->updateStatus(1);
                    return redirect()->route('loan.show', $id);
                }
                else if($token === $loanToken->token_decline)
                {
                    $loan->updateStatus(10);
                    return redirect()->route('loan.show', $id);
                }
                else
                {
                    return 'Invalid Token';
                }
            }
            else {
                return 'Invalid loan_id';
            }
        }
        else 
        {
            Session::flash('warning', 'You are not authorised to perform this action');
            return redirect()->route('loan.show', $id);
        }
    }

    public function approve_quantity(Request $request, Loan $loan)
    {
        foreach ($request->loan_item_id as $key => $value) {
            $loanItem = LoanItem::find($value);
            $loanItem->update(['approved_quantity' => $request->approved_quantity[$key]]);
            $loanItem->update(['remark' => $request->remarks[$key]]);
        }

        $loan->updateStatus(2);
        $loan->update(['message' => $request->message]);

        return redirect()->route('loan.show', $loan->id);
    }

    public function recieved(Loan $loan)
    {
        $loan->updateStatus(3);
        Session::flash('success', 'Item recieved by the student.');
        return redirect()->route('loan.show', $loan->id);
    }
}
