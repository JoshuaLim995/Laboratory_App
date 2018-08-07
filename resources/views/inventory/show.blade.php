@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Inventory Information</h1>
	<div class="form-group row">
		<label class="control-label col-sm-2">Image</label>
		<div class="col-sm-9">
			@if($inventory->photo)
			<img src="{{ asset('storage/inventories/'. $inventory->photo) }}">
			@else
			<label>No Image</label>
			@endif
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
	<hr/>
	@include('asset.location.show')
	@include('asset.location.show_script')

	<hr/>
	@include('asset.transaction.show')
	@include('asset.transaction.show_script')

</div>
@endsection