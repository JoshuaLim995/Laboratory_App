<script type="text/javascript">
		$(document).ready(function() {
			var inventory_id = $("input[name='inventory_id']").val();
			var t = $('#transaction').DataTable( {
				ajax: {
					url: "<?php echo route('getInventoryTransaction') ?>",
					data: {
						inventory_id:inventory_id,
					},
				},

				columns : [
				{data: null},
				{data: 'type', name: 'type'},
				{data: 'quantity', name: 'quantity'},
				{data: 'user', name: 'user'},
				{data: 'location', name: 'location'},
				{data: 'date', name: 'date'},
				// {data: 'action', name: 'action', orderable: false, searchable: false}
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