<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thanh Toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="shortcut icon" type="image/png" href="../../images/icon.png">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-n/1hej/l22Kj4S1LKAJaztMsUpGQpbg9DlzTfVbw78v3Vv0xHzfp2XuRLmwALC8k" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../../css/thanhtoan.css" />

    <style>
        .error-message {
            color: red;
            display: block;
            margin-top: 20px;
        }

        .error-message-two {
            color: red;
            display: none;
        }

        .slogan-group {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container-xl wrap">
        <div class="row">
            <div class="col-md-7">
                <div class="logo">
                    <a href="/">
                        <img src="../../images/icon.png" alt="logo" class="img-logo" />
                    </a>
                </div>

                <div class="group-link-page">
                    <div class="link-page">
                        <a href="/cart/index" class="">Giỏ hàng </a> &nbsp;&gt;&nbsp;
                        <p class="text-link"> Thông tin giao hàng</p>
                    </div>
                </div>

                <div class="title">
                    <h4>Thông tin giao hàng</h4>
                </div>

                <div class="input-group flex-nowrap input-75">
                    <span class="input-group-text" id="addon-wrapping"><img src="../../images/username.png"
                            alt="username" /> </span>
                    <input type="text" class="form-control" placeholder="Họ và tên" aria-label="Username"
                        aria-describedby="addon-wrapping" value="{{ $profile[0]->TENKH }}" readonly>
                </div>

                <div class="input-group flex-nowrap input-75">
                    <span class="input-group-text" id="addon-wrapping"><img src="../../images/phone.png"
                            alt="username" /> </span>
                    <input type="text" class="form-control" placeholder="Số điện thoại" aria-label="Username"
                        aria-describedby="addon-wrapping" value="{{ $profile[0]->SODIENTHOAI }}" readonly>
                </div>

                @if ($diaChi)
                    @foreach ($diaChi as $item)
                        <div class="input-group mt-2">
                            <span class="input-group-text" id="addon-wrapping">
                                <img src="../../images/diachi.png" alt="address" />
                            </span>
                            <input type="text" class="form-control" placeholder="Địa chỉ" aria-label="address"
                                aria-describedby="addon-wrapping" value="{{ $item->DIACHI }}" readonly>
                            <div class="input-group-text" id="{{ $item->DIACHI }}">
                                <input id="{{ $item->DIACHI }}" class="form-check-input mt-0" type="radio" value="{{ $item->DIACHI }}" 
                                     aria-label="Checkbox for following text input" name="dia-chi-user-click">
                            </div>
                        </div>
                    @endforeach
                    <p class="error-message" id="error-message">Vui lòng chọn địa chỉ thanh toán.</p>
                @else
                    <p class="error-message" id="error-message-two">Vui lòng thêm địa chỉ thanh toán.</p>
                @endif

                <div class="fix-profile ">
                    <a href="/profile" class="">Chỉnh sửa thông tin</a>
                </div>

                <div class="title">
                    <h4>Phương thức vận chuyển</h4>
                </div>

                <div class="group-van-chuyen">
                    <ul class="list-group">
                        <style>
                            .price {
                                margin-top: -10px;
                                margin-left: 90%;
                            }
                        </style>

                        <ul class="list-group">
                            <li class="list-group-item">
                                <input class="form-check-input me-1" type="radio" name="listGroupRadioGiaoHang"
                                    value="" id="nhanh" checked>
                                <label class="form-check-label label-check" for="nhanh">Nhanh</label>
                                <span class="price" name="nhanh">20000</span>
                            </li>
                            <li class="list-group-item">
                                <input class="form-check-input me-1" type="radio" name="listGroupRadioGiaoHang"
                                    value="" id="tietkiem">
                                <label class="form-check-label label-check" for="tietkiem">Tiết kiệm </label>
                                <span class="price" name="tietkiem">10000</span>
                            </li>
                            <li class="list-group-item">
                                <input class="form-check-input me-1" type="radio" name="listGroupRadioGiaoHang"
                                    value="" id="hoatoc">
                                <label class="form-check-label label-check" for="hoatoc">Hoả tốc </label>
                                <span class="price" name="hoatoc">200000</span>
                            </li>
                        </ul>
                </div>

                <div class="title">
                    <h4>Phương thức thanh toán</h4>
                </div>

                <div class="group-phuong-thuc-thanh-toan">
                    <div class="row">
                        <div class="col-md-12 item-phuong-thuc-thanh-toan">
                            <input class="form-check-input me-1" type="radio" name="listGroupRadio" value=""
                                id="firstRadio" checked>
                            <label class="form-check-label label-check" for="firstRadio"><img class="img-label"
                                    src="../../images/thanhtoankhinhanhang.png" alt="" />Thanh toán khi giao
                                hàng (COD)</label>
                            <div class="add-content-onclick">
                                <style>
                                    .content {
                                        white-space: pre-line;
                                        padding: 1.5em;
                                        text-align: center;
                                    }
                                </style>
                                <p class="content" id="content-thanh-toan-khi-giao-hang">
                                    <br>
                                    Nếu bạn là Sinh Viên HUIT, nhân viên sẽ giảm giá khi gọi xác nhận.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12 item-phuong-thuc-thanh-toan no-border-top">
                            <input class="form-check-input me-1" type="radio" name="listGroupRadio" value=""
                                id="secondRadio">
                            <label class="form-check-label label-check" for="secondRadio"><img class="img-label"
                                    src="../../images/chuyenkhoan.png" alt="" />Chuyển khoản qua ngân
                                hàng</label>
                            <div class="row">
                                <div class="col-md-9">
                                    <p class="none-content" id="content-chuyen-khoan">
                                        <br>
                                        *Lưu ý: Nhân viên sẽ gọi xác nhận và thông báo số tiền cần chuyển khoản của quý
                                        khách,
                                        quý khách vui lòng không chuyển khoản trước.

                                        • Vietinbank CN Truong Vinh Ky SG: 105875253608 - VO NHUT HAO
                                        • Momo : 0388533248 - VÕ NHỰT HÀO

                                        LƯU Ý
                                        • Khi chuyển khoản quý khách ghi nội dung CK là: TÊN FB CÁ NHÂN + MÃ ĐƠN HÀNG +
                                        SĐT
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <a href="../../images/qrcode.jpg" class="open-popup-link">
                                        <img class="none-image" id="content-image" src="../../images/qrcode.jpg"
                                            alt="qrcode">
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <p class="error-message-thanh-toan" id="error-message-thanh-toan" style="display: none; color: red;">
                    Vui lòng chọn phương thức thanh toán.</p>

                <div class="group-link-thanh-toan row">
                    <div class="link-gio-hang col-md-6">
                        <a href="/cart/index" class="">Giỏ hàng</a>
                    </div>
                    <div class="link-thanh-toan col-md-6 text-md-end">
                        <form id="paymentForm" action="/emails/xacnhandonhang" method="GET">
                            <button class="btn btn-primary float-md-end btn-thanh-toan" type="submit"
                                id="btn-hoan-tat" name="tongtien">Hoàn tất đơn hàng</button>
                        </form>
                    </div>
                </div>

                <hr>
                <p class="" style="text-align: center">Powered by HaiHuocStore</p>
            </div>

            <div class="col-md-5 wrap-right slogan-group">
                <div class="list-cart" style="">
                    <h4>Số lượng sản phẩm: {{ $sogiohang }}</h4>
                    @foreach ($cart as $item)
                        <?php $TongTien = 0; ?>
                        <div class="item-wrap" id="cart-page-result">
                            <div class="cart-wrap" data-line="1" data-variant-id="1120468075">
                                <div class="item-info">
                                    <div class="item-img">
                                        <a href=""><img src="{{ URL('images/' . $item->HINHANH) }}"
                                                alt="{{ $item->TENSANPHAM }}"></a>
                                    </div>
                                    <div class="cart_content">
                                        <div class="item-title">
                                            <div class="cart_des">
                                                <a href="#">{{ $item->TENSANPHAM }}</a>
                                            </div>
                                            <div class="item-qua">
                                                <p>Số lượng: {{ $item->SOLUONG }}</p>
                                            </div>
                                        </div>
                                        <div class="cart_qty-pri">
                                            <div class="item-qty">
                                                <div class="option_content">
                                                    <span class="item-option">
                                                        <span>Size: {{ $item->SIZE }} / Chất liệu:
                                                            {{ $item->CHATLIEU }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="qty_pri-content">
                                                <div class="group-item-option">
                                                    <span class="item-option">
                                                        <span class="item-price">
                                                            <span class="money">{{ $item->THANHTIEN }}₫</span>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
                <div class="group-hoadon">
                    <p class="left-text">Tạm tính:</p>
                    <p class="right-value">{{ $tongtienSP }}</p>
                </div>
                <div class="group-hoadon">
                    <p class="left-text">Phí vận chuyển: </p>
                    <p class="right-value phi-van-chuyen" id="phi-van-chuyen">20000</p>
                </div>
                <hr>
                <div class="price-total" data-tong-cong="{{ $tongtienSP }}">
                    <p class="left-text">Tổng cộng: </p>
                    <p class="right-value tong-tong-value" id="tong-cong">{{ $tongtienSP + 20000 }}</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('input[name="dia-chi-user-click"]').forEach(function(radio) {
            const messageError = document.getElementById('error-message');
            radio.addEventListener('change', function() {
                if (this.checked) {
                    console.log(messageError.innerText);
                    messageError.style.display = 'none';
                    console.log("Đã chọn địa chỉ:", this.value);
                }
            });
        });
    </script>
    <script>
        document.getElementById("btn-hoan-tat").addEventListener("click", function(event) {
            event.preventDefault();
            var tongCongValue = parseInt(document.getElementById("tong-cong").textContent);
            var phiVanChuyen = parseInt(document.getElementById("phi-van-chuyen").textContent);
            var selectedAddress = $('input[name="dia-chi-user-click"]:checked').val();

            if (!selectedAddress) {
                Swal.fire({
                    title: 'Vui lòng thêm địa chỉ của bạn !!!',
                    icon: 'error',
                    timer: 3500,
                });
            } else {
                var data = "tongCongValue=" + tongCongValue + "&phiVanChuyen=" + phiVanChuyen + "&diaChi=" +
                    selectedAddress;

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log("Đã gửi yêu cầu thành công!");
                        Swal.fire({
                            title: 'Đặt hàng thành công!',
                            text: 'Đơn hàng đang được xác nhận ! \n Vui lòng kiểm tra email về thông tin sản phẩm',
                            icon: 'success',
                            timer: 3500,
                        }).then(() => {
                            window.location.href = "/";
                        });
                    }
                };
                console.log(data);
                xhttp.open("POST", "/sendEmail", true);
                xhttp.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]')
                    .getAttribute(
                        'content'));
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(data);

            }


        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const firstRadio = document.getElementById('firstRadio');
            const secondRadio = document.getElementById('secondRadio');
            const codContent = document.getElementById('content-thanh-toan-khi-giao-hang');
            const bankTransferContent = document.getElementById('content-chuyen-khoan');
            const image = document.getElementById('content-image');

            firstRadio.addEventListener('change', function() {
                if (this.checked) {
                    codContent.style.display = 'block';
                    bankTransferContent.style.display = 'none';
                    image.style.display = 'none';
                }
            });

            secondRadio.addEventListener('change', function() {
                if (this.checked) {
                    codContent.style.display = 'none';
                    bankTransferContent.style.display = 'block';
                    image.style.display = 'block';
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const radioInputs = document.querySelectorAll('input[name="listGroupRadioGiaoHang"]');
            const value = document.querySelector('.phi-van-chuyen');

            radioInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const selectedPrice = document.querySelector('.price[name="' + this.id + '"]');
                    const priceValue = selectedPrice.textContent;
                    value.textContent = priceValue;
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.open-popup-link').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var prices = document.querySelectorAll(".tong-cong-value");

            prices.forEach(function(price) {
                var number = parseFloat(price.innerHTML);
                var formattedPrice = number.toLocaleString();
                price.innerHTML = formattedPrice + "₫";
                //console.log(formattedPrice);
            });

            const radioInputs = document.querySelectorAll('input[name="listGroupRadioGiaoHang"]');
            const value = document.querySelector('.tong-tong-value');
            const tongCong = parseFloat(document.querySelector('.price-total').dataset.tongCong);

            radioInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const selectedPrice = document.querySelector('.price[name="' + this.id + '"]');
                    const priceValue = parseFloat(selectedPrice.textContent);
                    const total = tongCong + priceValue * 1000;
                    value.textContent = total.toLocaleString() + "₫";
                    //console.log(priceValue);
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var prices = document.querySelectorAll(".price, .right-value, .money");

            prices.forEach(function(price) {
                var number = parseFloat(price.innerHTML);

                var formattedPrice = number.toLocaleString();


                price.innerHTML = formattedPrice + "₫";
                console.log(formattedPrice);
            });
        });
    </script>
</body>

</html>
