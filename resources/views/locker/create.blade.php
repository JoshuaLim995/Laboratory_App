@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Add Locker</h1>

	{!! Form::model(null, [
	'route' => ['locker.store'],
	'class' => 'form-horizontal',
	]) !!}

	@include('asset.locker.form')


	<div class="form-group row">
		<div class="col-sm-11">
			{!! Html::linkRoute('locker.index', 'Cancel', 
			array(null),
			array('class'=>'btn btn-secondary'))!!}
			{!! Form::button('Save', [
			'type' => 'submit',
			'class' => 'btn btn-success pull-right',
			]) 
			!!}
		</div>
	</div>
	{!! Form::close() !!}
</div>
@endsection