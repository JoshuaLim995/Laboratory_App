@extends('layouts.app')
@section('content')

<div class="container">
	<div class="form-group">
		{!! Form::model($inventory) !!}

		@include('asset.inventory.show')

		{!! Form::close() !!}
	</div>	

	{!! Form::model($location, [
		'route' => ['location.update', $location],
		'class' => 'form-horizontal',
		'method' => 'put'
		]) !!}

		@include('asset.location.form')

		<div class="form-group row">
			<div class="col-sm-11">
				{!! Html::linkRoute('inventory.show', 'Cancel', 
					array($inventory->id),
					array('class'=>'btn btn-secondary'))!!}
				{!! Form::button('Update', [
					'type' => 'submit',
					'class' => 'btn btn-success pull-right',
					]) !!}
				</div>
			</div>
			{!! Form::close() !!}

		</div>
		@endsection