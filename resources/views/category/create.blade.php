@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Create category</h1>

	<div class="panel panel-default">
		<div class="panel-body">
			{!! Form::model(null, [
			'route' => ['category.store'],
			'class' => 'form-horizontal',
			'enctype' => 'multipart/form-data',
			]) !!}

			<div class="form-group row">
				{!! Form::label('name', 'Name', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::text('name', null, [
					'class' => 'form-control',
					]) !!}
				</div>
			</div>

			<div class="form-group row">
				{!! Form::button('Submit', [
				'type' => 'submit',
				'class' => 'btn btn-primary ',
				]) !!}
			</div>
		</div>
		{!! Form::close() !!}
	</div>	
</div>
@endsection