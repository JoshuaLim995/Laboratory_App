<?php
use App\Inventory;
?>

<div class="container">
	<h1>Make Loan</h1>
	<div class="panel panel-default">
		<div class="panel-body">
			{!! Form::model(null, [
				'route' => ['loan.store'],
				'class' => 'form-horizontal',
				]) !!}

				<div class="form-group row">
					@if(Session::has('error'))
					<div class="alert alert-danger">
						{{ Session::get('error') }}
					</div>
					@endif
				</div>

				<div class="form-group row">
					{!! Form::label('period' ,'Loan period', [
						'class' => 'control-label col-sm-2'
						]) !!}
						<div class="col-sm-4">
							<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
								<input name='date_from' type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" required/>
								<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
						</div>
						<div class="col-sm-1">
							To
						</div>

						<div class="col-sm-4">
							<div class="input-group date" id="datetimepicker2" data-target-input="nearest">
								<input name='date_to' type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" required/>
								<div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group row">
						{!! Form::label('venue', 'Venue to be used', [
							'class' => 'control-label col-sm-2'
							]) !!}
							<div class="col-sm-9">
								{!! Form::text('venue', null, [
									'class' => 'form-control',
									]) !!}
								</div>
							</div>

							<div class="col-sm-11">
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
														'placeholder' => '',
														'multiple' => false,
														'required',
														]) !!}
													</div>
												</td>
												<td id="quantity">
													{!! Form::number('quantity[]', '', [
														'class' => 'form-control',
														'placeholder' => 'Quantity',
														'min' => 0,
														'required',
														]) !!}
													</td>
													<td>
														{!! Form::button('Add', [
															'class' => 'btn btn-primary add-more',
															]) !!}
														</td>
													</tr>
												</tbody>
											</table>
										</div>


										<br>
										<div class="col-sm-11">
											<div class="pull-right">
												{!! Form::button('Submit', [
													'type' => 'submit',
													'class' => 'btn btn-success',
													]) 
													!!}
												</div>
											</div>


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

									<script type="text/javascript">

										$(document).ready(function() {

											$('.select2').select2({
												id: '-1',
												allowClear: true,
												placeholder: "Select item",
											});

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
									<script type="text/javascript">
										Date.prototype.addDays = function(days) {
											var date = new Date(this.valueOf());
											date.setDate(date.getDate() + days);
											return date;
										}

										$(function () {
											var date = new Date();
											$('#datetimepicker1').datetimepicker({
												format: 'L',
			// minDate: date.addDays(5),
			minDate: 'moment',
			useCurrent: false
		});
											$('#datetimepicker2').datetimepicker({
												format: 'L',
												useCurrent: false,
												minDate: 'moment',
			// minDate: date.addDays(5),
		});
											$("#datetimepicker1").on("change.datetimepicker", function (e) {
												$('#datetimepicker2').datetimepicker('minDate', e.date);
											});
											$("#datetimepicker2").on("change.datetimepicker", function (e) {
												$('#datetimepicker1').datetimepicker('maxDate', e.date);
											});
										});
									</script>
