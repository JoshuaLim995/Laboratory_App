<?php
use App\Locker;
?>

@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Locker or steel cabinet rental</h1>

	<div class="panel panel-default">
		<div class="panel-body">
			{!! Form::model(null, [
			'route' => ['rentLocker.store'],
			'class' => 'form-horizontal',
			]) !!}

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

			@if(Auth::user()->isA('pg'))
			<div class="form-group row">
				{!! Form::label('type' ,'Locker Type', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9 row">
					<div class="col-sm-4">
						{!! Form::radio('type', 'A', true, [
						]) !!}
						{!! Form::label('locker' ,'Normal Locker', [
						'class' => 'control-label'
						]) !!}
					</div>
					<div class="col-sm-4">
						{!! Form::radio('type', 'B', false, [
						]) !!}
						{!! Form::label('steel' ,'Steel cabinet', [
						'class' => 'control-label'
						]) !!}
					</div>
				</div>
			</div>
			@elseif(Auth::user()->isA('ug'))
			<div style="display: none;">
				{!! Form::radio('type', 'A', true, [
				]) !!}
			</div>
			@endif

			<div class="form-group row">
				{!! Form::label('period' ,'Loan period', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-4">
					<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
						<input name='date_from' type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" required/>
						<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
							<div class="input-group-text"><i class="fa fa-calendar"></i></div>
						</div>
					</div>
				</div>
				<div class="col-sm-1">
					To
				</div>

				<div class="col-sm-4">
					<div class="input-group date" id="datetimepicker2" data-target-input="nearest">
						<input name='date_to' type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" required/>
						<div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
							<div class="input-group-text"><i class="fa fa-calendar"></i></div>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group row">
				{!! Form::label('floor', 'Floor', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::select('floor', Locker::$floors, null, [
					'class' => 'form-control',
					'placeholder' => 'Select Floor',
					'multiple' => false,
					'required',
					]) !!}
				</div>
			</div>
			<br>
			<div class="col-sm-11">
				<div class="pull-right">
					{!! Form::button('Submit', [
					'type' => 'submit',
					'class' => 'btn btn-success',
					]) 
					!!}
				</div>
			</div>

			{!! Form::close() !!}
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function () {
		$('#datetimepicker1').datetimepicker({
			format: 'L',
			minDate: 'moment',
			useCurrent: false
		});
		$('#datetimepicker2').datetimepicker({
			format: 'L',
			minDate: 'moment',
			useCurrent: false
		});
		$("#datetimepicker1").on("change.datetimepicker", function (e) {
			$('#datetimepicker2').datetimepicker('minDate', e.date);
		});
		$("#datetimepicker2").on("change.datetimepicker", function (e) {
			$('#datetimepicker1').datetimepicker('maxDate', e.date);
		});
	});
</script>

@endsection