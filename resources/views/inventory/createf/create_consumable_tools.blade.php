<div class="form-group row">
	{!! Form::label('name', 'Item Name', [
		'class' => 'control-label col-sm-2'
		]) !!}
		<div class="col-sm-9">
			{!! Form::text('name', null, [
				'class' => 'form-control',
				]) !!}
			</div>
		</div>

		<div class="form-group row">
			{!! Form::label('unit_measurement', 'Unit of measurement', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::text('unit_measurement', null, [
						'class' => 'form-control',
						]) !!}
					</div>
				</div>

				<div class="form-group row">
					{!! Form::label('unit_price', 'Unit Price (RM)', [
						'class' => 'control-label col-sm-2'
						]) !!}
						<div class="col-sm-9">
							{!! Form::text('unit_price', null, [
								'class' => 'form-control',
								]) !!}
							</div>
						</div>
