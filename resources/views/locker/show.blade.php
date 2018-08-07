@extends('layouts.app')
@section('content')
<div class="container">

	@include('asset.locker.show')

	@include('asset.locker.rentLocker')

		<div class="form-group">
		<a href="{{ route('locker.index') }}"><button class="btn btn-secondary">Return</button></a>
		@if(Auth::user()->isAdmin())
		<div class="pull-right">
			<a href="{{ route('locker.edit', $locker->id) }}"><button class="btn btn-success">Edit Locker</button></a>	
			<a href="{{ route('locker.delete', $locker) }}"><button class="btn btn-danger" onclick="if(!confirm('Are you sure delete this record?')){return false;};">Delete Locker</button></a>
		</div>
		@endif
	</div>
</div>
@endsection