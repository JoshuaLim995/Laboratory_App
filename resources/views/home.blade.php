@extends('layouts.app')

@section('content')

<div class="container">

	@if(Auth::user()->isUser())
	@if(Auth::user()->isStudent())
	@include('student_home')
	@else
	<div class="card mb-4">
		<div class="card-header">Welcome</div>
		<div class="card-body">
			Welcome to Laboratory Management System
		</div>
	</div>
	@endif
	@else
	<div class="card mb-4">
		<div class="card-header">Welcome</div>
		<div class="card-body">
			Please wait for the varification from admin
		</div>
	</div>
	@endif
	
</div>
@endsection
