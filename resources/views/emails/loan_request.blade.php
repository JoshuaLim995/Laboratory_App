@extends('beautymail::templates.ark') 

@section('content')

<link href="{{ asset('css/app.css') }}" rel="stylesheet">


@include('beautymail::templates.ark.heading', [
'heading' => 'Lab Equipment Loan Request',
'level' => 'h1'
])

@include('beautymail::templates.ark.contentStart')

<p>Student Name: {{ $loan->user->name }}</p>
<p>Purpose: {{ $loan->purpose }}</p>
<p>Period: {{ $loan->date_from }} to {{ $loan->date_to }}</p>

@include('beautymail::templates.ark.contentEnd')

@include('beautymail::templates.ark.heading', [
'heading' => 'Requested items',
'level' => 'h2'
])

@include('beautymail::templates.ark.contentStart')

<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach($loan->loan_items as $i => $loan_item)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $loan_item->inventory->name }}</td>
            <td>{{ $loan_item->quantity }}</td>
        </tr>

        @endforeach
    </tbody>
</table>
<div class="form-horizontal">
    <a href="{{ $approve_link }}"><button class="btn btn-success">Approve</button></a>
    <a href="{{ $decline_link }}"><button class="btn btn-danger">Decline</button></a>
</div>


@include('beautymail::templates.ark.contentEnd')

@stop



