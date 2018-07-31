@extends('layouts.app')
@section('content')
<div class="container">

	@if(Auth::user()->isStaff())
	@include('reservations.index_admin')
	@elseif(Auth::user()->isStudent())
	@include('reservations.index_student')

	@endif
</div>
@endsection
