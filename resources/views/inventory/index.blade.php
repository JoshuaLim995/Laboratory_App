@extends('layouts.app')
@section('content')


<div class="container">

	<table id="inventories-table" class="table">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Quantity</th>
			</tr>
		</thead>
	</table>

</div>

<script type="text/javascript">
	$(document).ready(function() {
    var t = $('#inventories-table').DataTable( {
    	ajax: 'http://localhost/Laboratory_App/public/inventory/get_datatable',
    	columns : [
			{data: null},
			{data: 'name'},
			{data: 'quantity'},
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

{{-- Data Table js and css --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

@endsection