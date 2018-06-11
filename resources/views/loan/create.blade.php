<?php
use App\Inventory;
?>

@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Loan</h1>


	<div class="panel panel-default">

		<div class="panel-body">
			{!! Form::model(null, [
			'route' => ['loan.store'],
			'class' => 'form-horizontal',
			]) !!}

			<div class="form-group row">
				{!! Form::label('purpose' ,'Purpose', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-9">
					{!! Form::text('purpose', null, [
					'class' => 'form-control',
					]) !!}
				</div>
			</div>

			<div class="form-group row">
				{!! Form::label('period' ,'Loan period', [
				'class' => 'control-label col-sm-2'
				]) !!}
				<div class="col-sm-4">
					{!! Form::date('date_from', \Carbon\Carbon::now(), [
					'class' => 'form-control',
					]) !!}
				</div>
				<div class="col-sm-1">
					To
				</div>
				
				<div class="col-sm-4">
					{!! Form::date('date_to', null, [
					'class' => 'form-control',
					]) !!}
				</div>
				

			</div>

			<div class="form-group row">
				<table id="myTable" class="table">
					<thead>
						<tr>
							<th>Item</th>
							<th>Quantity</th>
						</tr>
					</thead>
					<tbody>


						<tr class="after-add-more">

							<td id="item">{!! Form::select('inventory[]', Inventory::pluck('name', 'id'), null, [
								'placeholder' => 'Select Item',
								'multiple' => false,
								]) !!}</td>
								<td id="quantity">
									{!! Form::number('quantity[]', null, [
									'placeholder' => 'Quantity',
									'min' => 0,
									]) !!}
								</td>
								<td>
									{!! Form::button('Add', [
									'class' => 'btn btn-success add-more',
									]) !!}
								</td>

							</tr>


						</tbody>
					</table>
				</div>


				<br>
				{!! Form::button('Submit', [
				'type' => 'submit',
				'class' => 'btn btn-primary',
				]) 
				!!}

				<!-- Copy Fields -->
				{{-- <div id="copy" class="invisible"> --}}
				<div id="btn-remove" class="invisible">
					{!! Form::button('Remove', [
					'class' => 'btn btn-danger remove',
					]) !!}
				</div>

				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

		$(".add-more").click(function(){ 

			var table = document.getElementById("myTable");
			var row = table.insertRow(-1);
			row.setAttribute('id', 'copy');


			row.insertCell(0).innerHTML = $("#item").html();
			row.insertCell(1).innerHTML = $("#quantity").html();
			row.insertCell(2).innerHTML = $("#btn-remove").html();

		});

		$("tbody").on("click",".remove",function(){ 
			$(this).parents("#copy").remove();
		});

	});
</script>
@endsection