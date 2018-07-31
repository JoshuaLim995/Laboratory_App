<script type="text/javascript">
	$('.select2').select2({
		id: '-1',
		allowClear: true,
		placeholder: "Select Category",
	});
</script>
<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#img')
				.attr('src', e.target.result)
				.height(300);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>