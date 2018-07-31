@extends('layouts.app')
@section('content')


<div class="container">

	<div class="control-group row">
		<h1 class="col-sm-3">Category</h1>
		<a href="{{ route('category.create') }}"><button class="btn btn-default">Add Category
		</button></a>
	</div>

	@if (Session::has('message'))
	<div class="alert alert-success">{{ Session::get('message') }}</div>
	@endif

	<table id="categories-table" class="table">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Action</th>
			</tr>
		</thead>
	</table>

</div>

<script type="text/javascript">
	$(document).ready(function() {
		var t = $('#categories-table').DataTable( {
			ajax: '{{ route('category.get_datatable') }}',
			columns : [
			{data: null, width: '10%'},
			{data: 'name', name: 'name', width: '60%'},
			{data: 'action', name: 'action', width: '30%', orderable: false, searchable: false}
			],
			"columnDefs": [ {
				"searchable": false,
				"orderable": false,
				"targets": 0
			} ],
			"order": [[ 1, 'asc' ]],
		} );

		t.on( 'order.dt search.dt', function () {
			t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
				cell.innerHTML = i+1;
			} );
		} ).draw();
	} );
</script>
@endsection