<?php 
use App\MyCalendar;
?>
@extends('layouts.app')
@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			@if($loan->compareStatus('1'))
			{!! Form::model($loan, [
				'route' => ['loan.approve_quantity', $loan,],
				'method' => 'put',
				'class' => 'form-horizontal',
				]) !!}
				@elseif($loan->compareStatus('2'))
				{!! Form::model(null, [
					'route' => ['loan.recieved', $loan,],
					'method' => 'put',
					'class' => 'form-horizontal',
					]) !!}
					@elseif($loan->compareStatus('99'))
					{!! Form::model(null, [
						'route' => ['reminder.sendReminder', $loan,],
							'method' => 'put',
						'class' => 'form-horizontal',
						]) !!}
						@endif

						<div class="form-group mb-4">
							<div class="form-group">
								<h1>Lab Equipment Loan Request</h1>
							</div>

							<div class="form-group row">
								<label class="control-label col-sm-2">Loan ID</label>
								<div class="col-sm-10">
									<input type="text" name="loan_no" class="form-control" disabled value="{{ $loan->id }}">
								</div>
							</div>

							<div class="form-group row">
								<label class="control-label col-sm-2">Student Name</label>
								<div class="col-sm-10">
									<input type="text" name="loan_no" class="form-control" disabled value="{{ $loan->user->name }}">
								</div>
							</div>

							<div class="form-group row">
								<label class="control-label col-sm-2">Program</label>
								<div class="col-sm-10">
									<input type="text" name="program" class="form-control" disabled value="{{ $loan->user->department }}">
								</div>
							</div>

							<div class="form-group row">
								<label class="control-label col-sm-2">Venue</label>
								<div class="col-sm-10">
									<input type="text" name="venue" class="form-control" disabled value="{{ $loan->venue }}">
								</div>
							</div>

							<div class="form-group row">
								<label class="control-label col-sm-2">From</label>
								<div class="col-sm-4">
									<input type="text" name="date_from" class="form-control" disabled value="{{ MyCalendar::dateOnly($loan->date_from) }}">
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-sm-2">To</label>
								<div class="col-sm-4">
									<input type="text" name="date_to" class="form-control" disabled value="{{ MyCalendar::dateOnly($loan->date_to) }}">
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-sm-2">Status</label>
								<div class="col-sm-4">
									<input type="text" name="status" class="form-control" disabled value="{{ $loan->getStatus($loan->status) }}">
								</div>					
							</div>
						</div>

						<div class="form-group mb-4">
							<h2>Requested Item(s)</h2>
							<table class="table">
								<thead>
									<tr>
										<th>No.</th>
										<th>Item name</th>
										<th>Requested Quantity</th>
										<th>Approved Quantity</th>
										@if(Auth::user()->isAdmin())
										<th>Remarks</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($loan->loan_items as $i => $loan_item)
									<tr>
										<td>{{ $i + 1 }}</td>						
										<td>{{ $loan_item->inventory->name }}</td>
										<td>{{ $loan_item->requested_quantity }}</td>
										<td>
											@if($loan->compareStatus('0'))
											{!! Form::text('status', '',
												[
												'class' => 'form-control',
												'disabled' => 'true',
												]) !!}

												@elseif($loan->compareStatus('1'))
												@if(Auth::user()->isAdmin())
													{!! Form::hidden('loan_item_id[]', $loan_item->id, [
													]) !!}
													{!! Form::number('approved_quantity[]', $loan_item->requested_quantity, [
														'class' => 'form-control',
														'min' => 0,
														'required',
														]) !!}
													@else
													{!! Form::text('status', 'Waiting for quantity approval', [
														'class' => 'form-control',
														'min' => 0,
														'disabled' => 'true',
														]) !!}
														@endif
														@else
														{{ $loan_item->approved_quantity }}
														@endif
													</td>
													@if(Auth::user()->isAdmin())
													<td>
													@if($loan->compareStatus('1'))
														{!! Form::text('remarks[]', $loan_item->remark, [
														'class' => 'form-control',
														]) !!}
														@else
														{{ $loan_item->remark }}
														@endif
													</td>
													@endif
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>

									<div class="form-group mb-4">
										@if($loan->compareStatus('1'))
										@if(Auth::user()->isAdmin())
										<h3>Message</h3>
										{!! Form::textarea('message', null, [
											'class' => 'form-control',
											'placeholder' => 'Message to requester....',
											]) !!}
											@endif
											@else
											@if($loan->message)
											<h3>Message</h3>
											<p>{{ $loan->message }}</p>
											@endif


											@endif



										</div>

										@if(Auth::user()->isStudent() && $loan->compareStatus('2'))
										<div class="form-group mb-4">
											<p>Please collect the items on {{ MyCalendar::dayDate($loan->date_from) }}</p>
										</div>
										@endif

										<div class="form-horizontal">
											{!! Html::linkRoute('loan.index', 'Return', null, 
											array('class'=>'btn btn-secondary'))!!}

											<div class="pull-right">

												@if($loan->compareStatus('0'))
												@if(Auth::user()->isStudent())
												<a href="{{ route('loan.cancel', $loan) }}"><button type="button" class="btn btn-danger">Cancel loan</button></a>

												@elseif(Auth::user()->isdlmsa())
												{!! Html::linkRoute('loan.approval', 'Approve', 
													array($loan->id, $loan->loan_token->token_approve), 
													array('class'=>'btn btn-success'))!!}
												{!! Html::linkRoute('loan.approval', 'Decline', 
													array($loan->id, $loan->loan_token->token_decline), 
													array('class'=>'btn btn-danger'))!!}
													@endif

													@elseif($loan->compareStatus('1') && Auth::user()->isAdmin())
													{!! Form::button('Submit', [
														'type' => 'submit',
														'class' => 'btn btn-success',
														]) !!}

														@elseif($loan->compareStatus('2') && Auth::user()->isAdmin())
														{!! Form::button('Recieved', [
															'type' => 'submit',
															'class' => 'btn btn-success',
															]) !!}


															@elseif(($loan->compareStatus('3') || $loan->compareStatus('5')) && Auth::user()->isAdmin())
															{!! Html::linkRoute('return.returnItem', 'Return Items', 
																array($loan), 
																array('class'=>'btn btn-success'))!!}

																@elseif($loan->compareStatus('99') && Auth::user()->isAdmin())
																{!! Html::linkRoute('return.returnItem', 'Return Items', 
																array($loan), 
																array('class'=>'btn btn-success'))!!}
																<input type="hidden" name="loan" value="{{ $loan->id }}">
																{!! Form::button('Send Reminder', [
																	'type' => 'submit',
																	'class' => 'btn btn-primary',
																	]) !!}
																	@endif

																</div>
															</div>

															{!! Form::close() !!}
														</div>
													</div>
												</div>
												@endsection