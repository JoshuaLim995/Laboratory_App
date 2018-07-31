<script type="text/javascript">
		$(document).ready(function() {
			var inventory_id = $("input[name='inventory_id']").val();
			var t = $('#item_location').DataTable( {
				ajax: {
					url: "<?php echo route('getItemLocations') ?>",
					data: {
						inventory_id:inventory_id,
					},
				},

				columns : [
				{data: null},
				{data: 'room_no', name: 'room_no'},
				{data: 'floor_no', name: 'floor_no'},
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