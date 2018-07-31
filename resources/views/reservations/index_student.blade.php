
{{-- <button id='hideshow' class="btn btn">Make reservation</button> --}}
<div id="cal" class="panel panel-primary">
	<h1>My Reservation</h1>
	<table id="reservation-table" class="table">
		<thead>
			<tr>
				<th></th>
				<th>Room</th>
				<th>Date</th>
				<th>Time</th>
				<th>Action</th>
			</tr>
		</thead>
	</table>
</div>

{{-- <div id="create" class="panel panel-primary"  style="display: none;">
	@include('reservations.create')
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('#hideshow').on('click', function(event) {
			$('#cal').toggle('show');
			$('#create').toggle('show');
			
			$(this).text(function(i, text){
				return text === "Show reservation" ? "Make reservation" : "Show reservation";
			});
		});
	});
</script> --}}

<script type="text/javascript">
	$(document).ready(function() {
		var t = $('#reservation-table').DataTable( {
			ajax: '{{ route('reservation.get_datatable') }}',
			columns : [
			{data: null},
			{data: 'room', name: 'room'},
			{data: 'date', name: 'date'},
			{data: 'time', name: 'time'},
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