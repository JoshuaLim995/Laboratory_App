@extends('layouts.app')
@section('content')
<div class="container">

	<div class="control-group input-group">
		<a href="{{ route('inventory.create') }}"><button class="btn btn-default">Create Inventory
		</button></a>
	</div>

	<br>

	@if(count($inventories) > 0)
	<table class="table">
		<thead>
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Quantity</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($inventories as $i => $inventory)
			<tr>
				<td>{{ $i + 1 }}</td>
				<td>{{ $inventory->name }}</td>
				<td>{{ $inventory->quantity }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
	No Record
	@endif
</div>
@endsection