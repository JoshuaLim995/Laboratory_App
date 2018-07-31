<?php
use App\Inventory;
?>

<div class="form-group row">
	{!! Form::label('category', 'Category', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::select('category', Inventory::$categories, null, [
		'class' => 'form-control select2',
		'placeholder' => 'Select Category',
		'multiple' => false,
		'disabled'
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('name', 'Name', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('name', null, [
		'class' => 'form-control',
		'disabled'
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('measurement_unit', 'Unit of measurement', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('measurement_unit', null, [
		'class' => 'form-control',
		'disabled'
		]) !!}
	</div>
</div>

