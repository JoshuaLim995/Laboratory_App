@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Update User Details</h1>

	<div class="panel panel-default">
		<div class="panel-body">
			{!! Form::model($user, [
				'route' => ['profile.update'],
				'class' => 'form-horizontal',
				'method' => 'put',
				]) !!}

				<!-- Display Error Message -->
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif

				@include('asset.profile.edit')

				<div class="form-group row">
					<div class="col-sm-11">
						{!! Html::linkRoute('profile.index', 'Cancel', 
							null,
							array('class'=>'btn btn-secondary btn-md', 
							))!!}

						{!! Form::button('Update', [
							'type' => 'submit',
							'class' => 'btn btn-success btn-md pull-right',
							]) !!}
						</div>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>

		@endsection
