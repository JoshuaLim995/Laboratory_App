<?php
use App\Locker;
?>

@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Edit Locker</h1>

	{!! Form::model($locker, [
	'route' => ['locker.update', $locker],
	'class' => 'form-horizontal',
	'method' => 'put',
	]) !!}

	@include('asset.locker.form')

	<div class="form-group row">
		{!! Form::label('floor', 'Floor', [
		'class' => 'control-label col-sm-2'
		]) !!}
		<div class="col-sm-9">
			{!! Form::select('availablity', Locker::$availablity, null, [
			'class' => 'form-control',
			'required',
			]) !!}
		</div>
	</div>
	
	<div class="form-group row">
		<div class="col-sm-11">
			{!! Html::linkRoute('locker.show', 'Cancel', 
			array($locker),
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