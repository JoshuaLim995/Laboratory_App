@extends('layouts.app')
@section('content')
<div class="container">
	<div class="control-group row">
		<h1>Notify late users</h1>
	</div>
	@if (Session::has('message'))
	<div class="alert alert-success">{{ Session::get('message') }}</div>
	@endif

	<br>
	<div>
		<table id="users-table" class="table">
			<thead>
				<tr>
					<th></th>
					<th>Name</th>
					<th>Contact</th>
					<th>Email</th>
					<th>From</th>
					<th>To</th>
					<th>Action</th>
				</tr>
			</thead>
		</table>
	</div>

	{!! Form::model(null, [
		'route' => ['reminder.sendMultipleReminders'],
		]) !!}
		<input type="text" id="selectedIds" name="id" hidden>

	{!! Form::button('Send Emails', [
			'type' => 'submit',
			'class' => 'btn btn-primary',
			]) 
			!!}

		

			{!! Form::close() !!}
		</div>

		<script type="text/javascript">
			$(document).ready(function() {
				var t = $('#users-table').DataTable( {
					ajax: '{{ route('reminder.get_datatable') }}',
					columns : [
					{data: 'id', width: '10%'},
					{data: 'user_name', name: 'name'},
					{data: 'user_contact', name: 'email'},
					{data: 'user_email', name: 'contact'},
					{data: 'date_from', name: 'role'},
					{data: 'date_to', name: 'role'},
					{data: 'action', name: 'action', orderable: false, searchable: false}
					],
					"columnDefs": [ {
				className: 'select-checkbox', //for select
				"searchable": false,
				"orderable": false,
				"targets": 0
			} ],
			"select": {
				"style":    'multi',
				"selector": 'td:first-child'
			},
			"order": [[ 1, 'asc' ]],

		} );		

				t.on( 'order.dt search.dt', function () {
					t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
						cell.innerHTML = i+1;
					} );
				} ).draw();

				var selectedIds_array = [];
				var selectedId;
				var selectedIds = document.getElementById('selectedIds');				

				t.on( 'click', 'tr', function () {
					selectedId = t.cell( this, 0 ).data();
				} );

		t.on('select.dt', function(e, dt, type, indexes) {
			selectedIds_array.push(selectedId);
			console.log(selectedIds_array);
			selectedIds.value = JSON.stringify(selectedIds_array);
		})

		t.on('deselect.dt', function(e, dt, type, indexes) {
			selectedIds_array.splice(selectedIds_array.indexOf(selectedId), 1);
			console.log(selectedIds_array);
			selectedIds.value = JSON.stringify(selectedIds_array);
		})
	} );
</script>

@endsection
