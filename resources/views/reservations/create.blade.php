@extends('layouts.app')
@section('content')


<div class="container">
	<h1>Make Reservation</h1>
	<div class="panel panel-default">
		<div class="panel-body">
			{!! Form::model(null, [
			'route' => ['reservation.store'],
			'class' => 'form-horizontal',
			]) !!}

			<div class="form-group row">
				{!! Form::label('start_at' ,'Start at', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::date('starts_at', null, [
					'class' => 'form-control',
					]) !!}
				</div>
			</div>

			<div class="form-group row">
				{!! Form::label('end_at' ,'End at', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::date('ends_at', null, [
					'class' => 'form-control',
					]) !!}
				</div>
			</div>

			<br>
			{!! Form::button('Submit', [
			'type' => 'submit',
			'class' => 'btn btn-primary',
			]) 
			!!}

			{!! Form::close() !!}
		</div>
	</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
    </div>
</div>
@endsection
