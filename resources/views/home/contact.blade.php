@extends('layouts.app')
@section('renderBody')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thông tin liên hệ</li>
            </ol>
        </nav>
        <div class="row ps-2 pe-2" data-aos="fade-up">
            <div class="col-lg-7">
                <hr>
                <div class="single-contact">
                    <i class="fa fa-home"></i>
                    <div class="content">Địa chỉ:
                        <span>140 Lê Trọng Tấn, Tây Thạnh, Tân Phú, TP.HCM</span>
                    </div>
                </div>
                <div class="single-contact">
                    <i class="fa fa-phone"></i>
                    <div class="content">
                        Số điện thoại: 0123456789</a>
                    </div>
                </div>
                <div class="single-contact">
                    <i class="fa fa-envelope"></i>
                    <div class="content">
                        Email: mail@gmail.com</a>
                    </div>
                </div>
                <hr>
                <h3 class="mb-3">Liên hệ với chúng tôi</h3>
                <form action="submit.php" method="POST">
                    <div class="form-group">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Họ tên *"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email *"
                            required>
                    </div>
                    <div class="form-group">
                        <textarea id="message" name="message" class="form-control" placeholder="Nhập nội dung *" required></textarea>
                    </div>
                    <input type="submit" value="Gửi liên hệ của bạn" class="btn w-100 btn-submit-contact">
                </form>
            </div>
            <div class="col-lg-5">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3922.3987662869856!2d106.68756591404364!3d10.766265262356275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752950ce12e7fd%3A0x9b64b6861ed36485!2zNTcwIMSQxrDhu51uZyBOZ3V54buFbiwgUXXhuq1uIDQsIFBoxrDhu51uZyA4LCBC4bqpbmggU8O9IFRo4buFIEzhuqNpLCBOZ3V54buFbiwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1649355022426!5m2!1svi!2s&q=10.806304764392191,106.62863457670079&marker=color:red%7C10.806304764392191,106.62863457670079"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>

    </div>
@endsection
