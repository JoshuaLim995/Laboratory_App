<?php
use App\Category;
?>

@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Edit Inventory</h1>

	<div class="panel panel-default">
		<div class="panel-body">
			{!! Form::model($inventory, [
			'route' => ['inventory.update', $inventory],
			'class' => 'form-horizontal',
			'method' => 'put',
			'enctype' => 'multipart/form-data',
			]) !!}

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

			<div class="form-group row">
				{!! Form::label('photo', 'Photo', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					<div>
						<img id="img" src="{{ asset('storage/inventories/'. $inventory->photo) }}" alt="image" />
					</div>
					<div>
						{!! Form::file('photo', [
						{{-- 'required', --}}
						'onchange' => 'readURL(this);',
						]) !!}
					</div>
				</div>
			</div>

			@include('asset.inventory.form')
			
			<div class="form-group row">
				<div class="col-sm-11">
					{!! Html::linkRoute('inventory.index', 'Cancel', 
					array(null),
					array('class'=>'btn btn-secondary'))!!}
					{!! Form::button('Update', [
					'type' => 'submit',
					'class' => 'btn btn-success pull-right',
					]) !!}
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>

@include('asset.inventory.script')
@endsection