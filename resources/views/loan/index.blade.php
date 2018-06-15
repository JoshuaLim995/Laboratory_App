@extends('layouts.app')
@section('content')


<div class="container">

	<div class="control-group input-group">
		<a href="{{ route('loan.create') }}"><button class="btn btn-default">Create loan
		</button></a>
	</div>
	<br>

	<table id="loan-table" class="table">
		<thead>
			<tr>
				<th></th>
				<th>Purpose</th>
				<th>User</th>
				<th>Created At</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
	</table>

</div>

<script type="text/javascript">
	$(document).ready(function() {
		var t = $('#loan-table').DataTable( {
			ajax: '{{ route('loan.get_datatable') }}',
			columns : [
			{data: null},
			{data: 'purpose', name: 'purpose'},
			{data: 'user_name', name: 'user_name'},
			{data: 'created_at', name: 'created_at'},
			{data: 'status', name: 'status'},	
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