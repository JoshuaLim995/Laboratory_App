<?php 
use App\MyCalendar;
?>
@extends('layouts.app')
@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group mb-4">
				<h1>Laboratory Reservation</h1>
				<hr>
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

			<div class="form-group">
				<a href="{{ route('reservation.index') }}"><button class="btn btn-secondary">Return</button></a>
				@if(Auth::user()->isAdmin())
				<div class="pull-right">
					<a href="{{ route('reservation.edit', $reservation->id) }}"><button class="btn btn-success">Edit</button></a>	
					<a href="{{ route('reservation.delete', $reservation) }}"><button class="btn btn-danger" onclick="if(!confirm('Are you sure delete this record?')){return false;};">Delete</button></a>
				</div>
				@endif
			</div>
		</div>
	</div>
	@endsection