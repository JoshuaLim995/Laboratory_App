<?php
use App\Reservation;
use Carbon\Carbon;
?>

@extends('layouts.app')
@section('content')

<div class="container">
	<h1>Edit Laboratory Reservation</h1>
	<div class="panel panel-default">
		<div class="panel-body">
			{!! Form::model($reservation, [
			'route' => ['reservation.update', $reservation],
			'method' => 'put',
			'class' => 'form-horizontal',
			]) !!}
			{{--  --}}
			<div class="form-group row">
				{!! Form::label('purpose' ,'Purpose', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::text('purpose', null, [
					'class' => 'form-control',
					'required',
					]) !!}
				</div>
			</div>
			{{--  --}}
			<div class="form-group row">
				{!! Form::label('room_no' ,'Room No.', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::select('room_no', Reservation::$room_no, null, [
					'class' => 'form-control select2',
					'placeholder' => '',
					'multiple' => false,
					'required',
					]) !!}
				</div>
			</div>
			{{--  --}}
			<div class="form-group row">
				{!! Form::label('date' ,'Date', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
						<input name='date' type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" required value="{{ $date }}"/>
						<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
							<div class="input-group-text"><i class="fa fa-calendar"></i></div>
						</div>
					</div>
				</div>
			</div>
			{{--  --}}
			<div class="form-group row">
				{!! Form::label('start_at' ,'Start at', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					<div class="input-group date" id="datetimepicker2" data-target-input="nearest">
						<input name='starts_at' type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" required value="{{ $starts_at }}" />
						<div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
							<div class="input-group-text"><i class="fa fa-clock-o"></i></div>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group row">
				{!! Form::label('end_at' ,'End at', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					<div class="input-group date" id="datetimepicker3" data-target-input="nearest">
						<input name='ends_at' type="text" class="form-control datetimepicker-input" data-target="#datetimepicker3" required value="{{ $ends_at }}" />
						<div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
							<div class="input-group-text"><i class="fa fa-clock-o"></i></div>
						</div>
					</div>
				</div>
			</div>

			<br>
			<div class="form-group row">
				<div class="col-sm-11">
					{!! Form::button('Submit', [
					'type' => 'submit',
					'class' => 'btn btn-success pull-right',
					]) 
					!!}
				</div>				
			</div>

			{!! Form::close() !!}
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.select2').select2({
		id: '-1',
		placeholder: "Select Room Number",
	});

	$(function () {

		$('#datetimepicker1').datetimepicker({
			useCurrent: false,
			format: 'L',
			minDate: 'moment',
		});
		$('#datetimepicker2').datetimepicker({
			format: 'LT',
			useCurrent: false
		});

		$('#datetimepicker3').datetimepicker({
			format: 'LT',
			useCurrent: false
		});

		$("#datetimepicker2").on("change.datetimepicker", function (e) {
			$('#datetimepicker3').datetimepicker('minDate', e.date);
		});
		$("#datetimepicker3").on("change.datetimepicker", function (e) {
			$('#datetimepicker2').datetimepicker('maxDate', e.date);
		});
	});
</script>

@endsection