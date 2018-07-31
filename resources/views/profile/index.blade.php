@extends('layouts.app')
@section('content')
<div class="container">
	@include('asset.profile.show')
	<div class="pull-right">
		<a href="{{ route('profile.edit') }}"><button type="button" class="btn btn-success">Edit Profile</button></a>
	</div>
</div>
@endsection