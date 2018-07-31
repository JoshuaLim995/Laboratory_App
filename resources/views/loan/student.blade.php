<div class="container">
	<div class="control-group input-group">
		{{-- <a href="{{ route('loan.create') }}"><button class="btn btn-default">Create loan</button></a> --}}
		<button id='hideshow' class="btn btn">Make loan</button>
	</div>

	<div id="tab" class="panel panel-primary">
	<h1>My Loan</h1>

		<table id="loan-table" class="table">
			<thead>
				<tr>
					<th></th>
					<th>From</th>
					<th>To</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
		</table>
	</div>

	<div id="create" class="panel panel-primary"  style="display: none;">
		@include('loan.create')
	</div>

</div>

<script type="text/javascript">
	$(document).ready(function() {
		var t = $('#loan-table').DataTable( {
			ajax: '{{ route('loan.get_datatable') }}',
			columns : [
			{data: null},
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
			"order": [[ 1, 'asc' ]]
		} );

		t.on( 'order.dt search.dt', function () {
			t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
				cell.innerHTML = i+1;
			} );
		} ).draw();
	} );
</script>

<script type="text/javascript">
	$(document).ready(function(){

		$('#hideshow').on('click', function(event) {
			$('#tab').toggle('show');
			$('#create').toggle('show');
			
			$(this).text(function(i, text){
				// return text === "Hide Calender" ? "Show Calender" : "Hide Calender";
				return text === "Show" ? "Make loan" : "Show";
			});
		});
	});
</script>