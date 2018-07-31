<?php
use App\Category;
?>

@extends('layouts.app')
@section('content')
<div class="container">
	<h1>New Inventory</h1>

	<div class="panel panel-default">
		<div class="panel-body">
			{!! Form::model(null, [
				'route' => ['inventory.store'],
				'class' => 'form-horizontal',
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
					{!! Form::label('category', 'Category', [
						'class' => 'control-label col-sm-2'
						]) !!}
						<div class="col-sm-9">
							{!! Form::select('category_id', Category::pluck('name', 'id'), null, [
								'class' => 'form-control select2',
								'placeholder' => 'Select Category',
								'multiple' => false,
								'required',
								'onchange' => 'select(value)',
								]) !!}
							</div>
						</div>

						<div class="form-group row">
							{!! Form::label('photo', 'Photo', [
								'class' => 'control-label col-sm-2'
								]) !!}
								<div class="col-sm-9">
									<div>
										<img id="img" src="#" alt="image" />
									</div>
									<div>
										{!! Form::file('photo', [
											'onchange' => 'readURL(this);',
											]) !!}
										</div>
									</div>
								</div>

								<div id="consumable_tools" style="display: none;">
									@include('inventory.create_consumable_tools')
								</div>

								<div id="equipment" style="display: none;">
									@include('inventory.create_equipment')
								</div>
{{--
		<div class="form-group row">
			{!! Form::label('name', 'Name', [
			'class' => 'control-label col-sm-2'
			]) !!}
			<div class="col-sm-9">
				{!! Form::text('name', null, [
				'class' => 'form-control',
				'required',
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
				'required',
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
		--}}





													<div class="form-group row">
		<div class="col-sm-11">
			{!! Html::linkRoute('inventory.index', 'Return', 
			array(null),
			array('class'=>'btn btn-secondary'))!!}
			{!! Form::button('Submit', [
			'type' => 'submit',
			'class' => 'btn btn-primary pull-right',
			]) !!}
		</div>
	</div>
{!! Form::close() !!}
</div>
</div>
</div>

<script type="text/javascript">

	$('#category_id').select2({
		id: '-1',
		placeholder: "Select Category",
	});

	function select(id) {
		if(id === '4'){
			document.getElementById('consumable_tools').style.display = "none";
			document.getElementById('equipment').style.display = "block";
		}
		else{
			document.getElementById('consumable_tools').style.display = "block";
			document.getElementById('equipment').style.display = "none";
		}
	}
</script>
<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#img')
				.attr('src', e.target.result)
				.height(300);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
@endsection