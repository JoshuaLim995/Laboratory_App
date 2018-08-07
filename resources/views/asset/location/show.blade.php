<div>
	<div class="control-group row">
		<h3 class="col-sm-3">Locations</h3>
		@if(Auth::user()->isAdmin())
		<div class="pull-right">
			<a href="{{ route('location.create', ['inventory' => $inventory->id]) }}"><button class="btn btn-primary">Add Location</button></a>	
		</div>
		@endif
	</div>
	
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
</div>
