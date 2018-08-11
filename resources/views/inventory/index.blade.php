@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<h1 class="col-sm-3">Inventory</h1>
		@if(Auth::user()->isAdmin())
		<a href="{{ route('inventory.create') }}"><button class="btn btn-default">Add Inventory
		</button></a>
		@endif
	</div>

	<div class="control-group">
		<table id="inventories-table" class="table">
			<thead>
				<tr>
					<th></th>
					<th>Name</th>
					<th>Category</th>
					<th>Action</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var t = $('#inventories-table').DataTable( {
			ajax: '{{ route('inventory.get_datatable') }}',
			columns : [
			{data: null, width: '10%'},
			{data: 'name', name: 'name'},
			{data: 'category', name: 'category'},
			{data: 'action', name: 'action', orderable: false, searchable: false}
			],
			"columnDefs": [ {
				"searchable": false,
				"orderable": false,
				"targets": 0
			} ],
			"order": [[ 1, 'asc' ]],
			dom: 'Bfrtip',
			buttons: [
			{
				extend: 'copyHtml5',
					// text: '<i class="fa fa-file-copy-o"></i> CSV',
					// titleAttr: 'Copy',
					title: 'Inventory List',
					exportOptions: {
						columns: [ 0, 1, 2]
					}
				},
				{
					extend: 'csvHtml5',
					text: '<i class="fa fa-file-text-o"></i> CSV',
					titleAttr: 'CSV',
					title: 'Inventory List',
					exportOptions: {
						columns: [ 0, 1, 2]
					}
				},
				]
			} );

		t.on( 'order.dt search.dt', function () {
			t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
				cell.innerHTML = i+1;
			} );
		} ).draw();
	} );
</script>


@endsection

