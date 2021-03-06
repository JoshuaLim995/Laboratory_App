<?php
use App\Reservation;
use App\MyCalendar;
?>

<div class="row mb-4">
	<div class="col-md-4 col-sm-6">
		<div class="card">
			<div class="card-header">My Loan</div>
			<div class="card-body">
				<div>

					<table class="table">
						<tr>
							<th>Pending</th>
							<td>{{ $pending_loans }}</td>
						</tr>
						<tr>
							<th>Approved</th>
							<td>{{ $approved_loans }}</td>
						</tr>
						<tr>
							<th>Prepared</th>
							<td>{{ $prepared_loans }}</td>
						</tr>
						<tr>
							<th>OverDue</th>
							<td>{{ $overdue_loans }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8 col-sm-6">
		<div class="card">
			{{-- <div class="card mb-4"> --}}
			<div class="card-header">My Locker</div>
			<div class="card-body">
				@if($rent_locker)
				<table class="table">
					<thead>
						<tr>
							<th>Locker No</th>
							<th>Floor</th>
							<th>From</th>
							<th>To</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $rent_locker->locker->locker_no }}</td>
							<td>{{ $rent_locker->locker->floor_no }}</td>
							<td>{{ $rent_locker->date_from }}</td>
							<td>{{ $rent_locker->date_to }}</td>
						</tr>
					</tbody>
				</table>
				@else
				You have no locker.
				@endif
			</div>
		</div>
	</div>
</div>

<div class="card mb-4">
	<div class="card-header">My Lab Reservations</div>

	<div class="card-body">
		@if(count($reservations) > 0)
		<table class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Purpose</th>
					<th>Lab</th>
					<th>Date</th>
					<th>Time</th>
				</tr>
			</thead>
			<tbody>
				@foreach($reservations as $i => $reservation)
				<tr>
					<td>{{ $i + 1 }}</td>
					<td>{{ $reservation->purpose }}</td>
					<td>{{ Reservation::$room_no[$reservation->room_no] }}</td>
					<td>{{ MyCalendar::dayDate($reservation->starts_at) }}</td>
					<td>
						{{ MyCalendar::time($reservation->starts_at) }}
						-
						{{ MyCalendar::time($reservation->ends_at) }}
					</td>
				</tr>
				@endforeach				
			</tbody>				
		</table>
		@else
		You have no reservations
		@endif
	</div>
</div>
