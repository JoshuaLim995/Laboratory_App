@extends('layouts.app')
@section('content')
<div class="container">
	@if(count($users) > 0)
	<table class="table">
		<thead>
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $i => $user)
			<tr>
				<td>{{ $i + 1 }}</td>
				<td>{{ $user->name }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
	No Record
	@endif
</div>
@endsection