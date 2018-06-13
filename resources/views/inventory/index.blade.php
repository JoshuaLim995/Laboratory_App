@extends('layouts.app')
@section('content')


<div class="container">

    <div class="control-group input-group">
        <a href="{{ route('inventory.create') }}"><button class="btn btn-default">Create Inventory
        </button></a>
    </div>
    <br>

    <table id="inventories-table" class="table">
      <thead>
       <tr>
        <th></th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Action</th>

    </tr>
</thead>
</table>

</div>

<script type="text/javascript">
	$(document).ready(function() {
        var t = $('#inventories-table').DataTable( {
           ajax: '{{ route('inventory.get_datatable') }}',
           columns : [
           {data: null},
           {data: 'name', name: 'name'},
           {data: 'quantity', name: 'quantity'},
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

{{-- Data Table js and css --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

@endsection