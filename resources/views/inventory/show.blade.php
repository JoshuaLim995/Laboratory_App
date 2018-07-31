@extends('layouts.app')
@section('content')
<style type="text/css">
	input {
		pointer-events:none;
	}
	select {
		pointer-events:none;
	}
</style>
<div class="container">

	<div class="form-group row">
		<label class="control-label col-sm-2">Image</label>
		<div class="col-sm-9">
			<img src="{{ asset('storage/inventories/'. $inventory->photo) }}">
		</div>

	</div>

	{!! Form::model($inventory) !!}

	@include('asset.inventory.show')

	{!! Form::close() !!}

	<div class="form-group">
		<a href="{{ route('inventory.index') }}"><button class="btn btn-secondary">Return</button></a>
		@if(Auth::user()->isAdmin())
		<div class="pull-right">
			<a href="{{ route('inventory.edit', $inventory->id) }}"><button class="btn btn-success">Edit Inventory</button></a>	
			<a href="{{ route('inventory.delete', $inventory) }}"><button class="btn btn-danger" onclick="if(!confirm('Are you sure delete this record?')){return false;};">Delete Inventory</button></a>
		</div>
		@endif
	</div>

	<input type="hidden" name="inventory_id" value="{{ $inventory->id }}">

	@include('asset.location.show')
	@include('asset.location.show_script')

	

	@include('asset.transaction.show')
	@include('asset.transaction.show_script')

	<div class="form-group">
		<a href="{{ route('inventory.index') }}"><button class="btn btn-secondary">Return</button></a>
	</div>

	

</div>
@endsection