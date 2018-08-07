<div class="card mb-4">
	<div class="card-header">Hello {{ $user->name }}!</div>
	<div class="card-body">
		You are log in as {{ $user->role('title') }}. Welcome to Laboratory Management System.
	</div>
</div>