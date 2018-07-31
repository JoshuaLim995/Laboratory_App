<?php 

use Carbon\Carbon;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Reminder of Loan Overdue</title>
    @include('emails.mail_css')

</head>
<body>
    <div class="container">
        <h1>Reminder of Loan Overdue</h1>
        <p>Dear {{ $loan->user->name }},</p>
        <p>Please be reminded that your loan: {{ $loan->id }} has overdue at {{ Carbon::parse($loan->date_to)->format('D, M d, Y') }} </p>
        <p>Please return the items stated below as soon as possible to avoid complications.</p>
        <p>The loan of items</p>

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
    </div>
</body>
</html>