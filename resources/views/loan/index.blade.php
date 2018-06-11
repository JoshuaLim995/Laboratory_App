
@extends('layouts.app')
@section('content')
<div class="container">

	<div class="control-group input-group">
		<a href="{{ route('loan.create') }}"><button class="btn btn-default">Create loan
		</button></a>
	</div>

	<br>

	@if(count($loans) > 0)
	<table class="table">
		<thead>
			<tr>
				<th>No</th>
				<th>Purpose</th>
				<th>User</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@foreach($loans as $i => $loan)
			<tr>
				<td>{{ $i + 1 }}</td>
				<td>{{ $loan->purpose }}</td>
				<td>{{ $loan->user->name }}</td>
				<td>{{ $loan->status }}</td>
				<td>
					{!! Html::linkRoute(
					'loan.show', 
					'View', 
					array($loan->id), 
					array('class'=>'btn btn-success')
					)!!}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{ $loans->links() }}
	@else
	No Record
	@endif
</div>
@endsection