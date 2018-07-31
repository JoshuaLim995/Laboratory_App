<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loan;
use App\User;
use Carbon\Carbon;
use DataTables;
use Session;
use App\MyCalendar;
use Snowfire\Beautymail\Beautymail;

class ReminderController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('admin');
	}
	
	public function index()
	{
		return view('reminder.index');
	}

	public function get_datatable()
	{
		$now = Carbon::now();
		$loans = Loan::where('date_to', '<', $now)->where('status', '99')->get();

		return $dataTables = DataTables::of($loans)
		->addColumn('user_name', function ($loan) {
			if($loan->user)
				return $loan->user->name;
			else
				return 'N/A';
		})
		->addColumn('user_contact', function ($loan) {
			if($loan->user)
				return $loan->user->contact;
			else
				return 'N/A';
		})
		->addColumn('user_email', function ($loan) {
			if($loan->user)
				return $loan->user->email;
			else
				return 'N/A';
		})
		->addColumn('date_from', function ($loan) {
			return MyCalendar::dateOnly($loan->date_from);
		})
		->addColumn('date_to', function ($loan) {
			return MyCalendar::dateOnly($loan->date_to);
		})
		->addColumn('action', function ($loan) {
			return '<a href="'. route('loan.show', $loan->id) .'" class="btn btn-primary">View</a>';
			return '';
		})
		->toJson();
	}

	public function sendMultipleReminders(Request $request)
	{
		$ids = json_decode($request->id);
		// $array = [];

		$beautymail = app()->make(Beautymail::class);

		foreach ($ids as $id) {
			$loan = Loan::find($id);

			$beautymail->send('emails.reminder', [
				'loan' => $loan,
				], function($message) use ($loan)
				{
					$email = $loan->user->email;

					$message
					->from(env('EMAIL_ADDR'))
					->to($email)
					->subject('Reminder of Loan Overdue');
				});
		}

		Session::flash('success', 'Email sent successfuly');
		return redirect()->route('reminder.index');
	}

	public function sendReminder(Loan $loan)
	{
		$beautymail = app()->make(Beautymail::class);
		$beautymail->send('emails.reminder', [
			'loan' => $loan,
			], function($message) use ($loan)
			{
				$email = $loan->user->email;

				$message
				->from(env('EMAIL_ADDR'))
				->to($email)
				->subject('Reminder of Loan Overdue');
			});

		Session::flash('success', 'Email sent successfuly');
		return redirect()->route('loan.index');
	}
}
