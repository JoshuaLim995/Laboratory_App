
<div class="form-group row">		
	{!! Form::label('room_no', 'Room No', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('room_no', null, [
		'class' => 'form-control',
		'required',
		]) !!}
	</div>
</div>

<div class="form-group row">		
	{!! Form::label('floor_no', 'Floor No', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('floor_no', null, [
		'class' => 'form-control',
		'required',
		]) !!}
	</div>
</div>

<div class="form-group row">		
	{!! Form::label('quantity', 'Quantity', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::number('quantity', null, [
		'class' => 'form-control',
		'required',
		]) !!}
	</div>
</div>

<input type="hidden" name="inventory_id" value="{{ $inventory->id }}">
