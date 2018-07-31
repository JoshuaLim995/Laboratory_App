@extends('layouts.app')
@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			{!! Form::model($category, [
				'route' => ['category.update', $category],
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

				<h1>Edit Category</h1>

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
							<div class="col-sm-11">
								{!! Html::linkRoute('category.index', 'Cancel', 
									array(null),
									array('class'=>'btn btn-secondary'))!!}
								{!! Form::button('Update', [
									'type' => 'submit',
									'class' => 'btn btn-success pull-right',
									]) !!}
								</div>
							</div>
						</div>
						{!! Form::close() !!}
						</div>
				</div>
				@endsection