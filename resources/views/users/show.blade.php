@extends('layouts.app')
@section('content')
<div class="container">

	<h1>View User information</h1>

	@include('asset.profile.show')


	<div>
		<a href="{{ route('user.index') }}"><button type="button" class="btn btn-secondary">Return</button></a>
		@if(Auth::user()->isAdmin())
		<div class="pull-right">
			<a href="{{ route('user.edit', $user) }}"><button type="button" class="btn btn-success">Edit</button></a>
			<a href="{{ route('user.delete', $user) }}"><button class="btn btn-danger" onclick="if(!confirm('Are you sure delete this user?')){return false;};">Delete</button></a>
		</div>
		@endif
	</div>




</div>
@endsection