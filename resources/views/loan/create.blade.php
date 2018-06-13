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

			<table id="myTable" class="table">
				<thead>
					<tr>
						<th style="width: 30%">Item</th>
						<th style="width: 20%">Quantity</th>
						<th style="width: 10%"></th>
					</tr>
				</thead>
				<tbody>


					<tr class="after-add-more">
						<td id="item">
							<div class="col-sm-7">
								{!! Form::select('inventory[]', Inventory::pluck('name', 'id'), null, [
								'class' => 'form-control select2',
								'placeholder' => 'Select item',
								'multiple' => false,
								]) !!}
							</div>									
						</td>
						<td id="quantity">
							{!! Form::number('quantity[]', null, [
							'class' => 'form-control',
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

			<br>
			{!! Form::button('Submit', [
			'type' => 'submit',
			'class' => 'btn btn-primary',
			]) 
			!!}

			<!-- Copy Fields -->

			<div id="btn-remove" class="invisible">
				{!! Form::button('Remove', [
				'class' => 'btn btn-danger remove',
				]) !!}
			</div>

			{!! Form::close() !!}
		</div>
	</div>
</div>

<!-- Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<script type="text/javascript">

	$(document).ready(function() {

		$('.select2').select2();

		$(".add-more").click(function(){ 
			$('.select2').select2('destroy');

			var table = document.getElementById("myTable");
			var row = table.insertRow(-1);
			row.setAttribute('id', 'copy');


			row.insertCell(0).innerHTML = $("#item").html();
			row.insertCell(1).innerHTML = $("#quantity").html();
			row.insertCell(2).innerHTML = $("#btn-remove").html();

			$('.select2').select2();

		});

		$("tbody").on("click",".remove",function(){ 
			$(this).parents("#copy").remove();
		});

	});

</script>
@endsection