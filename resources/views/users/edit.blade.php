@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Update User Details</h1>

	<div class="panel panel-default">
		<div class="panel-body">
			{!! Form::model($user, [
				'route' => ['user.update', $user],
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

				<div class="form-group row">
					{!! Form::label('type', 'User Type', [
						'class' => 'control-label col-sm-2'
						]) !!}
						<div class="col-sm-9">
							{!! Form::select('type', $roles, $user->role('name'), [
								'class' => 'form-control select2',
								'placeholder' => 'Select User Type',
								'multiple' => false,
								'required',
								]) !!}
							</div>
						</div>

				@include('asset.profile.edit')

						<div class="form-group row">
							<div class="col-sm-11">
								{!! Html::linkRoute('user.show', 'Cancel', 
									array($user),
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
