<?php

namespace App\Http\Controllers;

use Auth;
use Keygen;
use Hash;
use DataTables;
use App\User;
use App\Loan;
use App\LoanToken;
use App\LoanItem;
use Illuminate\Http\Request;
use Snowfire\Beautymail\Beautymail;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('loan.index');
    }

    public function get_datatable()
    {
        $loan = Loan::select([
            'id',
            'purpose',
            'user_id',
            'created_at',
            'status',
            ]);

        return  DataTables::of($loan)
        ->addColumn('user_name', function ($loan) {
            return $loan->user->name;
        })
        ->addColumn('action', function ($loan) {
            return '<a href="'. route('loan.show', $loan->id) .'" class="btn btn-primary">View</a>';
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
        $loan = new Loan();
        $loan->user_id = Auth::id();
        $loan->purpose = $request->purpose;
        $loan->date_from = $request->date_from;
        $loan->date_to = $request->date_to;
        $loan->status = 'pending';
        $loan->save();

        foreach ($request->inventory as $i => $inventory_id)
        {
            if (!empty($inventory_id)) {
                $loan_item = new LoanItem();
                $loan_item->inventory_id = $inventory_id;
                $loan_item->quantity = $request->quantity[$i];
                $loan_item->loan_id = $loan->id;

                $loan_item->save();
            }
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

        $approve_link = env('APP_URL') . 'loan/' . $loan->id . '/approval/' . $token_approve;
        $decline_link = env('APP_URL') . 'loan/' . $loan->id . '/approval/' . $token_decline;

        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.loan_request', [
            'loan' => $loan,
            'approve_link' => $approve_link,
            'decline_link' => $decline_link,
            ], function($message) 
            {
                $email = User::find(2)->email;
                // $email = 'limshiawjong@gmail.com';
                
                $message
                ->from('donotreply@laravel.com')
                ->to($email)
                ->subject('Test Mail!');
            });

        return redirect()->route('loan.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
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

    public function approval($id, $token)
    {
        if(Auth::id()===2){
            if($loan = Loan::find($id)){
                $loanToken = $loan->loan_token;
                if($token === $loanToken->token_approve)
                {
                    $loan->update(['status' => 'approved']);
                // return redirect()->route('exit');
                    return redirect()->route('loan.show', $id);
                }
                else if($token === $loanToken->token_decline)
                {
                    $loan->update(['status' => 'decline']);
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
            echo 'Not HOD';
            // return redirect()->route('logout');
        }
    }
}
