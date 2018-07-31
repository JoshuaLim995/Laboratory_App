<?php 
use App\MyCalendar;
?>
@extends('layouts.app')
@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group mb-4">
				<div class="form-group">
					<h1>Lab Equipment reservation Request</h1>
				</div>

				<div class="form-group row">
					<label class="control-label col-sm-2">Name</label>
					<div class="col-sm-10">
						<input type="text" name="purpose" class="form-control" disabled value="{{ $reservation->user->name }}">
					</div>
				</div>

				<div class="form-group row">
					<label class="control-label col-sm-2">Purpose</label>
					<div class="col-sm-10">
						<input type="text" name="purpose" class="form-control" disabled value="{{ $reservation->purpose }}">
					</div>
				</div>

				<div class="form-group row">
					<label class="control-label col-sm-2">Date</label>
					<div class="col-sm-5">
						<input type="text" name="date" class="form-control" disabled value="{{ MyCalendar::dateOnly($reservation->starts_at) }}">
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-sm-2">From</label>
					<div class="col-sm-5">
						<input type="text" name="time" class="form-control" disabled value="{{ MyCalendar::time($reservation->starts_at) }}">
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-sm-2">To</label>
					<div class="col-sm-5">
						<input type="text" name="date_from" class="form-control" disabled value="{{ MyCalendar::time($reservation->ends_at) }}">
					</div>
	{{-- 				@if(Auth::user()->isA('student') && $reservation->compareStatus('0'))
					<a href="{{ route('reservation.cancel', $reservation) }}"><button type="button" class="btn btn-danger">Cancel reservation</button></a>
					@endif --}}
				</div>
			</div>



			<div class="form-horizontal">
				{!! Html::linkRoute('reservation.index', 'Return', null, 
				array('class'=>'btn btn-secondary'))!!}

			</div>
		</div>
	</div>
	@endsection