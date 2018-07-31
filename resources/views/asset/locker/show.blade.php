<?php
use App\Locker;
?>
<div class="panel-body">
	<div class="form-group row">
		{!! Form::label('type' ,'Locker Type', [
		'class' => 'control-label col-sm-2'
		]) !!}
		<div class="col-sm-9 row">
			<div class="col-sm-4">
				{!! Form::radio('type', 'A', $locker->type=="A" ? 'checked' : '', [
				]) !!}
				{!! Form::label('locker' ,'Normal Locker', [
				'class' => 'control-label'
				]) !!}
			</div>
			<div class="col-sm-4">
				{!! Form::radio('type', 'B', $locker->type=="B" ? 'checked' : '', [
				]) !!}
				{!! Form::label('steel' ,'Steel cabinet', [
				'class' => 'control-label'
				]) !!}
			</div>
		</div>
	</div>

	<div class="form-group row">
		{!! Form::label('locker_no' ,'Locker no.', [
		'class' => 'control-label col-sm-2'
		]) !!}
		<div class="col-sm-9">
			{!! Form::text('locker_no', $locker->locker_no, [
			'class' => 'form-control',
			'required',
			'disabled'
			]) !!}
		</div>
	</div>

	<div class="form-group row">
		{!! Form::label('floor', 'Floor', [
		'class' => 'control-label col-sm-2'
		]) !!}
		<div class="col-sm-9">
			{!! Form::text('floor_no', Locker::$floors[$locker->floor_no], [
			'class' => 'form-control',
			'required',
			'disabled'
			]) !!}
		</div>
	</div>

	<div class="form-group row">
		{!! Form::label('availability', 'Availability', [
		'class' => 'control-label col-sm-2'
		]) !!}
		<div class="col-sm-9">
			{!! Form::text('availability', Locker::$availablity[$locker->availablity], [
			'class' => 'form-control',
			'required',
			'disabled'
			]) !!}
		</div>
	</div>
</div>