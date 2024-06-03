<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    <p>
        Bạn nhận được email này vì đã yêu cầu chúng tôi đặt lại mật khẩu cho tài khoản của bạn.</p>
    <p>
        Vui lòng nhấp vào liên kết bên dưới để đặt lại mật khẩu của bạn:</p>
    <a href="{{ url('resetPassword/'.$token) }}">Reset Password</a>
    <p>Nếu bạn không yêu cầu đặt lại mật khẩu thì không cần thực hiện thêm hành động nào.</p>
</body>
</html>
