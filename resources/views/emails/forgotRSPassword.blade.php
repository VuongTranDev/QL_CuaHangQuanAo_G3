<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    <p>You are receiving this email because we received a password reset request for your account.</p>
    <p>Please click the link below to reset your password:</p>
    <a href="{{ url('resetPassword/'.$token) }}">Reset Password</a>
    <p>If you did not request a password reset, no further action is required.</p>
</body>
</html>