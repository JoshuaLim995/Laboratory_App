<?php
use App\Equipment;
?>
<div class="form-group row">
	{!! Form::label('name1', 'Description 1 (Revised assent name)', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('name1', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('name2', 'Description 2 (As described in Invoice)', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('name2', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('code', 'Item Code', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('code', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('model', 'Model', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('model', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('brand', 'Brand', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('brand', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('seri_no', 'Serial Number', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('seri_no', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>
<div class="form-group row">
	{!! Form::label('ass_code', 'Asset Code', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('ass_code', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>
<div class="form-group row">
	{!! Form::label('cost', 'Cost', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('cost', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('pr_no', 'PR Number', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('pr_no', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('po', 'PO', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('po', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('inv_no', 'INV NO', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('inv_no', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('do', 'DO', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('do', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('do_date', 'DO Date', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('do_date', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('supp_cont', 'Supplier & Contact', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('supp_cont', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('initiator', 'Initiator', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('initiator', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('purpose', 'Purpose', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::select('purpose', Equipment::$purpose, null, [
		'class' => 'form-control select2',
		'placeholder' => 'Select Category',
		'multiple' => false,
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('sub_code', 'Subject code for Practical Class', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('sub_code', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('cat', 'Category (General, Expert and/or High Risk, Sensitive, etc', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('cat', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('el', 'Expert (E) OR Lecturer In-Charge (L)', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('el', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('rpmc', 'Require Preventive Maintenance/Calibration?', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('rpmc', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>

<div class="form-group row">
	{!! Form::label('remark', 'Remark', [
	'class' => 'control-label col-sm-2'
	]) !!}
	<div class="col-sm-9">
		{!! Form::text('remark', null, [
		'class' => 'form-control',
		]) !!}
	</div>
</div>