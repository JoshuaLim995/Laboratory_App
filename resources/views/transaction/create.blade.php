<?php
use App\Inventory;
?>

@extends('layouts.app')
@section('content')
<div class="container">

	<h1>Inventory Transaction</h1>

	<div class="panel panel-default">
		<div class="panel-body">

			{!! Form::model(null, [
			'route' => ['transaction.store'],
			'class' => 'form-horizontal',
			]) !!}

			<div class="form-group row">
				{!! Form::label('user' ,'User Name', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::text('user', null, [
					'class' => 'form-control',
					'required',
					]) !!}
				</div>
			</div>

			<div class="form-group row">
				{!! Form::label('date' ,'Date', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
						<input name='date' type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" required/>
						<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
							<div class="input-group-text"><i class="fa fa-calendar"></i></div>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group row">
				{!! Form::label('type' ,'Transaction Type', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9 row">
					<div class="col-sm-4">
						{!! Form::radio('type', 'in', true, [
						]) !!}
						{!! Form::label('type' ,'In', [
						'class' => 'control-label'
						]) !!}
					</div>
					<div class="col-sm-4">
						{!! Form::radio('type', 'out', false, [
						]) !!}
						{!! Form::label('type' ,'Out', [
						'class' => 'control-label'
						]) !!}
					</div>
				</div>
			</div>

			<div class="form-group row">
				{!! Form::label('inventory', 'Inventory', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::select('inventory_id', $inventory, null, [
					'id' => 'inventory',
					'class' => 'form-control select2',
					'placeholder' => 'Select Inventory',
					'multiple' => false,
					'required',
					]) !!}
				</div>
			</div>

			<div class="form-group row">
				{!! Form::label('location', 'Location', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::select('location_id', $locations, null, [
					'id' => 'location',
					'class' => 'form-control select2',
					'placeholder' => 'Select Location',
					'multiple' => false,
					'required',
					]) !!}
				</div>
			</div>

			<div class="form-group row">
				{!! Form::label('quantity', 'Quantity', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::number('quantity', null, [
					'class' => 'form-control',
					'required',
					]) !!}
				</div>
			</div>


			<div class="form-group row">
				<div class="col-sm-11">
					<div class="pull-right">
						{!! Form::button('Submit', [
						'type' => 'submit',
						'class' => 'btn btn-success',
						]) 
						!!}
					</div>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

<script type="text/javascript">
    $("button").click(function(){
        $( "#dialog" ).dialog();
    });
</script>

<script type="text/javascript">

	$("select[name='inventory_id']").change(function(){
		var inventory_id = $(this).val();
		var token = $("input[name='_token']").val();
		$.ajax({
			url: "<?php echo route('select-ajax') ?>",
			method: 'POST',
			data: {inventory_id:inventory_id, _token:token},
			success: function(data) {
				$("select[name='location_id'").html('');
				$("select[name='location_id'").html(data.options);
			}
		});
	});
</script>

<script type="text/javascript">
	$('#inventory').select2({
		id: '-1',
		placeholder: "Select Inventory",
	});
	// $('#location').select2({
	// 	id: '-1',
	// 	placeholder: "Select Location",
	// });
</script>

<script type="text/javascript">
	Date.prototype.addDays = function(days) {
		var date = new Date(this.valueOf());
		date.setDate(date.getDate() + days);
		return date;
	}

	$(function () {
		var date = new Date();
		$('#datetimepicker1').datetimepicker({
			format: 'L',
			minDate: 'moment',
		});
	});
</script>

@endsection