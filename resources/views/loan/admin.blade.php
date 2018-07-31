<div class="container">
	<div class="control-group row">
		<h1 class="col-sm-3">Loans</h1>
	</div>
	<table id="loan-table" class="table">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Program</th>
				<th>From</th>
				<th>Due Date</th>
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
			{data: 'user_name', name: 'user_name'},
			{data: 'department', name: 'department'},
			{data: 'date_from', name: 'date_from'},
			{data: 'date_to', name: 'date_to'},
			{data: 'status', name: 'status', searchable: false},	
			{data: 'action', name: 'action', orderable: false, searchable: false}
			],
			"columnDefs": [ {
				"searchable": false,
				"orderable": false,
				"targets": 0
			} ],
			"order": [[ 3, 'desc' ]]
		} );

		t.on( 'order.dt search.dt', function () {
			t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
				cell.innerHTML = i+1;
			} );
		} ).draw();
	} );
</script>
