@extends('layouts.app')
@section('content')


<div class="container">

	<div class="control-group row">
		<h1 class="col-sm-3">Users</h1>
	</div>
	@if (Session::has('message'))
	<div class="alert alert-success">{{ Session::get('message') }}</div>
	@endif

	<table id="users-table" class="table">
		<thead>
			<tr>
				<th id="first-child"></th>
				<th>Name</th>
				<th>Email</th>
				<th>Contact</th>
				<th>Role</th>
				<th>Action</th>
			</tr>
		</thead>
	</table>

</div>

<script type="text/javascript">
	$(document).ready(function() {
		var t = $('#users-table').DataTable( {
			ajax: '{{ route('user.get_datatable') }}',
			columns : [
			{data: null, width: '10%'},
			{data: 'name', name: 'name'},
			{data: 'email', name: 'email'},
			{data: 'contact', name: 'contact'},
			{data: 'role', name: 'role'},
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