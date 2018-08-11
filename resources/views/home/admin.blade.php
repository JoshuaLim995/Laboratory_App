<div class="card mb-4">
	<div class="card-header">Hello {{ $user->name }}!</div>
	<div class="card-body">
		You are log in as {{ $user->role('title') }}. Welcome to Laboratory Management System.
	</div>
</div>

@if(count($newUsers) > 0)
<div class="card mb-4">
	<div class="card-header">New User Registration Approval</div>
	<div class="card-body">
		<table class="table">
			<thead>
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>Department</th>
					<th>Role</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($newUsers as $i => $newUser)
				<tr>
					<td>{{ $i + 1 }}</td>
					<td>{{ $newUser->name }}</td>
					<td>{{ $newUser->department }}</td>
					<td>{{ $newUser->role('title') }}</td>
					<td>
						<a href="{{ route('newRegistrationApproval', $newUser) }}"><button class="btn btn-success">Approve</button></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@else
<div class="card mb-4">
	<div class="card-header">New User Registration Approval</div>
	<div class="card-body">
		No new registeration
	</div>
</div>
@endif

