

@extends('admin_layout')

<style>
    .profile-container {
    padding: 20px;
}

.profile-header {
    display: flex;
    align-items: center;
}

.profile-avatar {
    margin-right: 20px;
    margin-left:200px;
}

.profile-avatar img {
    width: 700px;
    height: 500px;
    
}

.profile-info {
    font-size: 20px;
    margin-left: 200px;
}

.nav-tabs {
    margin-top: 20px;
}

.tab-content {
    padding-top: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.btn {
    margin-top: 10px;
}
</style>
@section('admin_content')
    <div class="profile-container">
        <h1 style="margin:10px 0px 10px 400px">Profile Admin</h1>
        <div class="profile-header">
            <div class="profile-avatar">
                <img src="{{ asset('../images/QC1.png') }}" alt="Ảnh đại diện">
            </div>
            
          
        </div>
        <div class="profile-info">
            <h2 class="username"> Tên tài khoản :
                <?php 
                    $name = Session::get('tk') ;		
                    if($name)
                    {	
                    echo $name ;}	
                ?>
            </h2>
            <h2 >    Mật khẩu :
                <?php 
            
                    $mk = Session::get('mk') ;		
                    if($mk)
                    {	
                    echo $mk ;}	
                ?>
            </h2>

        </div>
        
        <div class="profile-body" style=" width: 300px; margin-left: 400px;">
            <?php 
            $message = Session::get('message') ;
            if($message)
              {
                echo "<span style='color: red;margin-left:30px; font-weight: bold;margin-left:170px'>$message</span>";
                Session::put('message',null); 
              }
            ?>
            <ul class="nav nav-tabs" role="tablist">
                    <li ></li>
                <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Thông tin cá nhân</a></li>
                <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Đổi mật khẩu</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="profile">
                    <form>
                        <div class="form-group">
                            <label for="name">Họ và tên:</label>
                            <input type="text" style="width:200px" class="form-control" id="name" value="<?php 
            
                            $ten = Session::get('ten') ;		
                            if($ten)
                            {	
                            echo $ten ;}	
                        ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Số điện thoại:</label>
                            <input type="email" class="form-control" style="width:200px" id="email" value="<?php 
            
                            $sdt = Session::get('sdt') ;		
                            if($sdt)
                            {	
                            echo $sdt ;}	
                        ?>">
                        </div>
                        
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane" id="settings">
                    <form action="{{ URL::to('resetpassAdmin') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="password">Mật khẩu mới:</label>
                            <input type="password" name="mk" style="width:200px" class="form-control" id="password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Xác nhận mật khẩu:</label>
                            <input type="password" name="rsmk" class="form-control" style="width:200px" id="password_confirmation">
                        </div>
                        <button type="submit" style="width:200px" class="btn btn-primary">Đổi mật khẩu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection