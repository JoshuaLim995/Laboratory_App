<div class="form-group">
	<label class="control-label">Locations</label>
	<table id="item_location" class="table">
		<thead>
			<tr>
				<th></th>
				<th>Room No</th>
				<th>Floor No</th>
				<th>Quantity</th>
				<th width="20%">Action</th>
			</tr>
		</thead>
	</table>
	<div class="form-group">
		@if(Auth::user()->isAdmin())
		<div class="pull-right">
			<a href="{{ route('location.create', ['inventory' => $inventory->id]) }}"><button class="btn btn-primary">Add Location</button></a>	
		</div>
		@endif
	</div>
</div>