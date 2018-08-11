@extends('layouts.app')

@section('content')

<div class="container">

	@if(Auth::user()->isApproved())
	@if(Auth::user()->isStudent())
	@include('home.student')
	@elseif(Auth::user()->isAdmin())
	@include('home.admin')
	@elseif(Auth::user()->isStaff())
	@include('home.staff')
	@endif
	@else
	@include('home.new_user')
	@endif
	
</div>
@endsection
