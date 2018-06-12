@extends('layouts.app')
@section('content')
<div class="container">

	<h1>Lab Equipment Loan Request</h1>

	<p>Student Name: {{ $loan->user->name }}</p>
	<p>Purpose: {{ $loan->purpose }}</p>
	<p>Period: {{ $loan->date_from }} to {{ $loan->date_to }}</p>
	<p>Status: {{ $loan->status }}</p>

	<h2>Requested items</h2>
	<div class="panel panel-body">
		<table class="table">
			<thead>
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>Quantity</th>
				</tr>
			</thead>
			<tbody>
				@foreach($loan->loan_items as $i => $loan_item)
				<tr>
					<td>{{ $i + 1 }}</td>
					<td>{{ $loan_item->inventory->name }}</td>
					<td>{{ $loan_item->quantity }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>	

	<div class="form-horizontal">
		{!! Html::linkRoute(
			'loan.approval', 
			'Approve', 
			array($loan->id, $loan->loan_token->token_approve), 
			array('class'=>'btn btn-success'))!!}

		{!! Html::linkRoute(
			'loan.approval', 
			'Decline', 
			array($loan->id, $loan->loan_token->token_decline), 
			array('class'=>'btn btn-danger'))!!}
	</div>






</div>
@endsection