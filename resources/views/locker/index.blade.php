<?php
use App\Common;
use App\Locker;
?>

@extends('layouts.app')
@section('content')
<div class="container">
	<div class="control-group row">
		<h1 class="col-sm-5">Lockers/Steel Cabinet</h1>
		<a href="{{ route('locker.create') }}"><button class="btn btn-default">Add Locker
		</button></a>
	</div>

	<table id="locker-table" class="table">
		<thead>
			<tr>
				<th></th>
				<th>Locker No</th>
				<th>Type</th>
				<th>Floor No</th>
				<th>Availablity</th>
				<th>Action</th>
			</tr>
		</thead>
	</table>
</div>

</div>

<script type="text/javascript">
	$(document).ready(function() {
		var t = $('#locker-table').DataTable( {
			ajax: '{{ route('locker.get_datatable') }}',
			columns : [
			{data: null},
			{data: 'locker_no', name: 'locker_no'},
			{data: 'type', name: 'type'},
			{data: 'floor_no', name: 'floor_no'},
			{data: 'availablity', name: 'availablity'},
			{data: 'action', name: 'action', orderable: false, searchable: false}
			],
			"columnDefs": [ {
				"searchable": false,
				"orderable": false,
				"targets": 0
			} ],
			"order": [[ 1, 'asc' ]]
		} );

		t.on( 'order.dt search.dt', function () {
			t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
				cell.innerHTML = i+1;
			} );
		} ).draw();
	} );
</script>

@endsection