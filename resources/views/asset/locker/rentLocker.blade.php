@if($rentLocker)
<div class="panel-body">
	<div class="form-group row">
		{!! Form::label('userName' ,'Occupant', [
		'class' => 'control-label col-sm-2'
		]) !!}
		<div class="col-sm-9">
			{!! Form::text('userName', $rentLocker->user->name, [
			'class' => 'form-control',
			'disabled'
			]) !!}
		</div>
	</div>

	<div class="form-group row">
		{!! Form::label('date_to' ,'From', [
		'class' => 'control-label col-sm-2'
		]) !!}
		<div class="col-sm-9">
			{!! Form::text('date_to', $rentLocker->date_from, [
			'class' => 'form-control',
			'disabled'
			]) !!}
		</div>
	</div>

	<div class="form-group row">
		{!! Form::label('date_to' ,'To', [
		'class' => 'control-label col-sm-2'
		]) !!}
		<div class="col-sm-9">
			{!! Form::text('date_to', $rentLocker->date_to, [
			'class' => 'form-control',
			'disabled'
			]) !!}
		</div>
	</div>
</div>
@endif