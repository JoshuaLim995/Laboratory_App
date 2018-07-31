@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Return Loan Item</h1>
	<br>
	{!! Form::model(null, [
		'route' => ['return.searchLoan'],
		'class' => 'form-horizontal',
		]) !!}

		<div class="form-group row">
			{!! Form::label('loan_id', 'Search Loan ID', [
				'class' => 'control-label col-sm-3'
				]) !!}
				<div class="col-sm-7">
					{!! Form::text('loan_id', null, [
						'class' => 'form-control',
						'required',
						]) !!}
					</div>
				</div>

				<div class="form-group row">
					<div class="col-sm-10">

						{!! Form::button('Search', [
							'type' => 'submit',
							'class' => 'btn btn-success btn-md pull-right',
							]) !!}
						</div>
					</div>

					{!! Form::close() !!}
				</div>

				@endsection