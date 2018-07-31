<?php 

use Carbon\Carbon;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab Equipment Loan Request</title>
@include('emails.mail_css')
</head>
<body>
    <div class="container">
        <h1>Lab Equipment Loan Request</h1>
        <p>Student Name: {{ $loan->user->name }}</p>
        <p>Program: {{ $loan->department }}</p>
        <p>From: {{ Carbon::parse($loan->date_from)->format('D, M d, Y') }} </p>
        <p>To: {{ Carbon::parse($loan->date_to)->format('D, M d, Y') }} </p>
        <br>
        <h2>Requested items</h2>

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
                    <td>{{ $loan_item->requested_quantity }}</td>
                </tr>

                @endforeach
            </tbody>
        </table>

        <div>
            <a href="{{ $approve_link }}"><button class="btn btn-success">Approve</button></a>
            <div class="pull-right">
                <a href="{{ $decline_link }}"><button class="btn btn-danger">Decline</button></a>
            </div>

        </div>
    </div>





</body>
</html>
