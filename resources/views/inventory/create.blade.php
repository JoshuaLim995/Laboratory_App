<?php
use App\Category;
?>

@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Create Inventory</h1>

	<div class="panel panel-default">
		<div class="panel-body">
			{!! Form::model(null, [
			'route' => ['inventory.store'],
			'class' => 'form-horizontal',
			'enctype' => 'multipart/form-data',
			]) !!}

			<div class="form-group row">
				{!! Form::label('name', 'Name', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::text('name', null, [
					'class' => 'form-control',
					]) !!}
				</div>
			</div>

			<div class="form-group row">		
				{!! Form::label('model', 'Model', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::text('model', null, [
					'class' => 'form-control',
					]) !!}
				</div>
			</div>

			<div class="form-group row">
				{!! Form::label('description', 'Description', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::textarea('description', null, [
					'class' => 'form-control',
					]) !!}
				</div>
			</div>


			{{-- 			<div class="form-group row">
			{!! Form::label('quantity', 'Quantity', [
			'class' => 'control-label col-sm-2'
			]) !!}
			<div class="col-sm-9">
				{!! Form::number('quantity', null, [
				'class' => 'form-control',
				'min' => 0,
				]) !!}
			</div>
		</div> --}}

		<div class="form-group row">
			{!! Form::label('category', 'Category', [
			'class' => 'control-label col-sm-2'
			]) !!}
			<div class="col-sm-9">
				{!! Form::select('category_id', Category::pluck('name', 'id'), null, [
				'class' => 'form-control select2',
				'placeholder' => 'Select Category',
				'multiple' => false,
				]) !!}
			</div>
		</div>


		<div class="form-group row">
			{!! Form::label('photo', 'Photo', [
			'class' => 'control-label col-sm-2'
			]) !!}
			<div class="col-sm-9">
				{!! Form::file('photo') !!}
			</div>
		</div>

		<div class="form-group row">
			{!! Form::button('Submit', [
			'type' => 'submit',
			'class' => 'btn btn-primary ',
			]) !!}
		</div>
	</div>
	{!! Form::close() !!}
</div>
</div>

<script type="text/javascript">
	$('.select2').select2({
		id: '-1',
		allowClear: true,
		placeholder: "Select Category",
	});
</script>
@endsection