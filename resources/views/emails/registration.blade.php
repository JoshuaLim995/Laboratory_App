<!DOCTYPE html>
<html>
<head>
    <title>Registration Approved</title>
    @include('emails.mail_css')

</head>
<body>
    <div class="container">
        <h1>Registration Approved</h1>
        <p>Dear {{ $user->name }},</p>
        <p>Your account has been approved by the admin.</p>
        <p>You can now login by clicking this <a href="{{ env('APP_URL') . '/login' }}">link</a></p>
    </div>
</body>
</html>