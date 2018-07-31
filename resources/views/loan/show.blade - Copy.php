@extends('layouts.app')
@section('content')
<div class="container">

	{!! Form::model($loan, [
	'route' => ['loan.approve_quantity', $loan,],
	'method' => 'put',
	'class' => 'form-horizontal',
	]) !!}

	<div class="panel panel-body">

		<h1>Lab Equipment Loan Request</h1>

		<p>Student Name: {{ $loan->user->name }}</p>


			<div class="form-group row">
				{!! Form::label('purpose' ,'Purpose', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::text('purpose', null, [
					'class' => 'form-control',
					'required',
					'disabled'
					]) !!}
				</div>
			</div>



		<p>Purpose: {{ $loan->purpose }}</p>
		<p>Period: {{ $loan->date_from }} to {{ $loan->date_to }}</p>
		<p>Status: {{ $loan->status }}</p>

		<h2>Requested items</h2>


		<table class="table">
			<thead>
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>Requested Quantity</th>
					<th>Approved Quantity</th>
				</tr>
			</thead>
			<tbody>
				@foreach($loan->loan_items as $i => $loan_item)
				<tr>
					<td>{{ $i + 1 }}</td>						
					<td>{{ $loan_item->inventory->name }}</td>
					<td>{{ $loan_item->requested_quantity }}</td>
					<td>
						@if($loan->status === 'pending')
						{!! Form::text('pending', 'processing',
						[
						'class' => 'form-control',
						'disabled' => 'true',
						]) !!}

						@elseif($loan->status === 'approved')								
						@if(Auth::user()->isA('admin', 'staff'))
						<div class="col-sm-4">
							{!! Form::hidden('loan_item_id[]', $loan_item->id, [
							]) !!}
							{!! Form::number('approved_quantity[]', $loan_item->requested_quantity,
							[
							'class' => 'form-control',
							'min' => 0,
							'required',
							]) !!}
						</div>
						@else
						{!! Form::text('pending', 'waiting for approval',
						[
						'class' => 'form-control',
						'min' => 0,
						'disabled' => 'true',
						]) !!}
						@endif
						@else
						{{ $loan_item->approved_quantity }}
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		@if(Auth::user()->isA('admin', 'staff'))
			<h3>Message</h3>
			{!! Form::textarea('message', $loan,
			[
			'class' => 'form-control',
			'placeholder' => 'Message to requester....',
			]) !!}
		@else
			<h3>Message</h3>
			<p>{{ $loan }}</p>
		@endif
	</div>	


	<div class="form-group row">
		@if (Session::has('success'))
		<div class="alert alert-success">
			{{ Session::get('success') }}
		</div>
		@elseif(Session::has('error'))
		<div class="alert alert-danger">
			{{ Session::put('error') }}
		</div>
		@endif
	</div>

	<div class="form-horizontal">
		@if(Auth::user()->isA('hod') && $loan->status === 'pending')
		{!! Html::linkRoute('loan.approval', 'Approve', 
		array($loan->id, $loan->loan_token->token_approve), 
		array('class'=>'btn btn-success'))!!}
		{!! Html::linkRoute('loan.approval', 'Decline', 
		array($loan->id, $loan->loan_token->token_decline), 
		array('class'=>'btn btn-danger'))!!}
		0
		@elseif(Auth::user()->isA('admin') && $loan->status === 'approved')
		{!! Form::button('Submit', [
		'type' => 'submit',
		'class' => 'btn btn-success',
		]) !!}

		@endif
		{!! Html::linkRoute('loan.index', 'Return', null, 
		array('class'=>'btn btn-primary'))!!}
	</div>
	{!! Form::close() !!}
</div>
@endsection