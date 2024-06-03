<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-n/1hej/l22Kj4S1LKAJaztMsUpGQpbg9DlzTfVbw78v3Vv0xHzfp2XuRLmwALC8k" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/stylelogin.css" />
</head>

<body>
    <br>
    <br>
	
    <div class="cont">
        <div class="form sign-in">
            <h2>Xin chào</h2>
            <?php 
            $message = Session::get('message') ;
            if($message)
              {
                echo "<span style='color: red;margin-left:30px; font-weight: bold;margin-left:170px'>$message</span>";
                Session::put('message',null); 
              }
            ?>
           <form action="{{ URL::to("/checkresetPassword") }}" method="post">

				{{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <label>
                    <span>Nhập mật khẩu mới</span>
                    <input type="password" id="username" name="mk"/>    
                </label>
                <label>
                    <span>Xác nhận mật khẩu</span>
                    <input type="password" id="password" name="resetmk"/>
                </label>
                
                <button type="submit" class="submit" id="dangnhap" name="dangnhap">Xác nhận</button>
            </form>
        </div>
        <div class="sub-cont">
            <div class="img">
                <div class="img__text m--up">

                    <h3>Không có tài khoản ha! Đăng ký nhé!<h3>
                </div>
                <div class="img__text m--in">

                    <h3>Bạn đã có tài khoản ư! Đăng nhập nhé<h3>
                </div>
                <div class="img__btn">
                    <span class="m--up">Đăng ký</span>
                    <span class="m--in">Đăng nhập</span>
                </div>
            </div>
            <div class="form sign-up">
                <h2>Create your Account</h2>
				<form action="{{ URL::to("/DangKiTK") }}" method="post">
					{!! csrf_field() !!}
                {{-- <label>
                    <span>Họ và tên</span>
                    <input type="text" id="nameregis" name = "name" />
                </label> --}}
                <label>
                    <span>Tài khoản</span>
                    <input type="text" id="usernameregis"  name = "TenTK" />
                </label>
                <label>
                    <span>Mật khẩu</span>
                    <input type="password" id="passwordregis" name = "MatKhau" />
                </label>
                <button type="submit" class="submit" id="dangky">Đăng ký</button>
			</form>
            </div>
        </div>
        
    </div>

    <script>
        document.querySelector('.img__btn').addEventListener('click', function() {
            document.querySelector('.cont').classList.toggle('s--signup');
        });
    </script>
   
</body>

</html>
