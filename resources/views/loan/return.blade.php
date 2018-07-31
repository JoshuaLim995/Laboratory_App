@extends('layouts.app')
@section('content')
<div class="container">

	<table class="table">
		<thead>
			<tr>
				<th></th>
				<th>Item name</th>
				<th>Quantity loaned</th>
				<th>Quantity returned</th>
			</tr>
		</thead>
		<tbody>
			@foreach($loan_items as $i => $loan_item)
			<tr>
				<td style="width: 5%"><input name="agree" type="checkbox" value="1"></td>						
				<td style="width: 30%">{{ $loan_item->inventory->name }}</td>
				<td style="width: 20%">
					{{ $loan_item->approved_quantity }}
				</td>
				<td style="width: 20%">
					{{ Form::text('return', null, [
					'class' => 'form-control',
					]) }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<div class="form-group">
		<label>Remark</label>
		{{ Form::textarea('comment', null, [
		'class' => 'form-control',
		]) }}
	</div>
</div>
@endsection