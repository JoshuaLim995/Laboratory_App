<?php
use App\Loan;
use App\MyCalendar;
?>
@extends('layouts.app')
@section('content')
<div class="container">
	{!! Form::model($loan, [
		'route' => ['return.store', $loan],
		'method' => 'put',
		'class' => 'form-horizontal',
		]) !!}


		<div class="form-group">
			<h1>Return Loan Item</h1>
		</div>

		<div class="form-group row">
			<label class="control-label col-sm-2">Loan No</label>
			<div class="col-sm-4">
				<input type="text" name="loan_no" class="form-control" disabled value="{{ $loan->id }}">
			</div>
		</div>

		<div class="form-group row">
			<label class="control-label col-sm-2">Student Name</label>
			<div class="col-sm-4">
				<input type="text" name="loan_no" class="form-control" disabled value="{{ $loan->user->name }}">
			</div>
		</div>

		<div class="form-group row">
			<label class="control-label col-sm-2">From</label>
			<div class="col-sm-4">
				<input type="text" name="date_from" class="form-control" disabled value="{{ MyCalendar::dateOnly($loan->date_from) }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="control-label col-sm-2">To</label>
			<div class="col-sm-4">
				<input type="text" name="date_to" class="form-control" disabled value="{{ MyCalendar::dateOnly($loan->date_to) }}">
			</div>
		</div>

		<div class="form-group row mb-4">
			<label>*Check if all items are returned</label>
		</div>

		<div class="form-group mb-4">
			<h2>Item(s) to return</h2>
			<table class="table">
				<thead>
					<tr>
						<th>No.</th>
						<th>Item name</th>
						<th>Quantity</th>
						<th>Returned</th>
					</tr>
				</thead>
				<tbody>
					@foreach($loan->loan_items as $i => $loan_item)
					<tr>
						<td>{{ $i + 1 }}</td>						
						<td>{{ $loan_item->inventory->name }}</td>
						<td>{{ $loan_item->approved_quantity }}</td>
						<td>
						{{-- <input id="{{ $loan_item->id }}" name="item_return[]" type="checkbox" value="{{ $loan_item->id }}" {{ $loan_item->is_returned ? 'checked' : ''}}> --}}
						<input id="{{ $loan_item->id }}" name="{{ $i }}" type="hidden" value="0">
						<input id="{{ $loan_item->id }}" name="{{ $i }}" type="checkbox" value="1" {{ $loan_item->is_returned ? 'checked' : ''}}>
						{{-- <input id="{{ $loan_item->id }}" name="item_return[]" type="checkbox" value="1"> --}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<div class="form-horizontal">
			{!! Html::linkRoute('loan.show', 'Return', $loan, 
			array('class'=>'btn btn-secondary'))!!}

			<div class="pull-right">
				@if(Auth::user()->isAdmin() && ($loan->compareStatus('3') || $loan->compareStatus('5') || $loan->compareStatus('99')))
				{!! Form::button('Submit', [
					'type' => 'submit',
					'class' => 'btn btn-success',
					]) !!}
					@endif
				</div>
			</div>

			{!! Form::close() !!}
		</div>

		@endsection


		