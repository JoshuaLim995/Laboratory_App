@extends('layouts.app')
@section('content')

<div class="container">
	<div class="form-group">
		{!! Form::model($inventory) !!}

		@include('asset.inventory.show')

		{!! Form::close() !!}
	</div>

	<!-- Display Error Message -->
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif

	{!! Form::model(null, [
		'route' => ['location.store'],
		'class' => 'form-horizontal',
		]) !!}

		@include('asset.location.form')

		<div class="form-group row">
			<div class="col-sm-11">
				{!! Html::linkRoute('inventory.show', 'Cancel', 
					array($inventory->id),
					array('class'=>'btn btn-secondary'))!!}
				{!! Form::button('Save', [
					'type' => 'submit',
					'class' => 'btn btn-success pull-right',
					]) !!}
				</div>
			</div>
			{!! Form::close() !!}

		</div>
		@endsection