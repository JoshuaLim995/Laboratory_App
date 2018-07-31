<?php
use App\Locker;
?>
<div class="panel panel-default">
	<div class="form-group row">
		@if(Session::has('error'))
		<div class="alert alert-danger">
			{{ Session::get('error') }}
		</div>
		@endif
	</div>
	<div class="panel-body">
		<div class="form-group row">
			{!! Form::label('type' ,'Locker Type', [
			'class' => 'control-label col-sm-2'
			]) !!}
			<div class="col-sm-9 row">
				<div class="col-sm-4">
					{!! Form::radio('type', 'A', true, [
					]) !!}
					{!! Form::label('locker' ,'Normal Locker', [
					'class' => 'control-label'
					]) !!}
				</div>
				<div class="col-sm-4">
					{!! Form::radio('type', 'B', false, [
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
				{!! Form::text('locker_no', null, [
				'class' => 'form-control',
				'required',
				]) !!}
			</div>
		</div>

		<div class="form-group row">
			{!! Form::label('floor', 'Floor', [
			'class' => 'control-label col-sm-2'
			]) !!}
			<div class="col-sm-9">
				{!! Form::select('floor_no', Locker::$floors, null, [
				'class' => 'form-control',
				'placeholder' => 'Select Floor',
				'multiple' => false,
				'required',
				]) !!}
			</div>
		</div>
	</div>
</div>