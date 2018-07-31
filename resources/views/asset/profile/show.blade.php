
<table class="table">
	<tr>
		<th>Attribute</th>
		<th>Value</th>
	</tr>
	<tr>
		<th>User Type</th>
		<td>{{ $user->role('title') }}</td>
	</tr>
	<tr>
		<th>Name</th>
		<td>{{ $user->name }}</td>
	</tr>
	<tr>
		<th>E-mail</th>
		<td>{{ $user->email }}</td>
	</tr>
	<tr>
		<th>Contact</th>
		<td>{{ $user->contact }}</td>
	</tr>
	<tr>
		<th>Username</th>
		<td>{{ $user->username }}</td>
	</tr>
	<tr>
		<th>Department</th>
		<td>{{ $user->department }}</td>
	</tr>
	<tr>
		<th>Programme</th>
		<td>{{ $user->getProgramme() }}</td>
	</tr>
	<tr>
		<th>Supervisor</th>
		<td>{{ $user->getSupervisor() }}</td>
	</tr>
</table>