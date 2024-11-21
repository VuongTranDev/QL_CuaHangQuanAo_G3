@extends('layouts.cartapp')

@section('main')
    <div class="container-fluid ps-5 pe-5">
        <div class="row">
            <div class="col-md-8">
                <div class="cart-title" style="background-color: #ebebeb;">
                    <h2>Giỏ hàng</h2>
                    <span class="cart-count">
                        <span class="cart-counter">{{ $sogiohang }}</span>
                        <span class="cart-item-title">Sản phẩm</span>
                    </span>
                </div>
                <div class="list-cart" style="">
                    <form id="cart-form" method="POST" action="{{ route('processSelectedItems') }}">
                        @csrf
                        @foreach ($cart as $item)
                            <div class="item-wrap" id="cart-page-result">
                                <div class="cart-wrap" data-line="1" data-variant-id="1120468075">
                                    <div class="item-info">
                                        <input type="checkbox" name="selected_items[]"
                                            value="{{ $item->MASP }}|{{ $item->SIZE }}"
                                            style="margin-right: 20px; width: 20px">
                                        <div class="item-img">
                                            <a href="http://127.0.0.1:8000/products/{{ $item->MASP }}"><img
                                                    src="{{ URL('images/' . $item->HINHANH) }}"
                                                    alt="{{ $item->TENSANPHAM }}"></a>
                                        </div>
                                        <div class="cart_content">
                                            <div class="item-title">
                                                <div class="cart_des">
                                                    <a
                                                        href="http://127.0.0.1:8000/products/{{ $item->MASP }}">{{ $item->TENSANPHAM }}</a>
                                                </div>
                                                <div class="item-remove">
                                                    <span class="remove-wrap">
                                                        <a href="javascript:void(0)" class="remove-item"
                                                            data-id="{{ $item->MASP }}"
                                                            data-sizedel = "{{ $item->SIZE }}"><i
                                                                class="fa fa-times"></i></a>
                                                    </span>

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
                                                    <div class="quantity-area">
                                                        <input type="button" name="giamsoluong" value="–" id="giamsoluong"
                                                            class="qty-btn btn-left-quantity">
                                                        <input type="text" readonly name="soluong" id="soluong"
                                                            value="{{ $item->SOLUONG }}" min="1"
                                                            class="quantity-selector quantity-mini"
                                                            data-masp="{{ $item->MASP }}"
                                                            data-size="{{ $item->SIZE }}">
                                                        <input type="button" name="tangsoluong" value="+" id="tangsoluong"
                                                            class="qty-btn btn-right-quantity">
                                                    </div>
                                                    <div class="group-item-option">
                                                        <span class="item-option">
                                                            <span class="item-price">
                                                                <span
                                                                    class="money">{{ ($item->GIA - $item->GIA * (20 / 100)) * $item->SOLUONG }}₫</span>
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
                        <button id="btn-chon-thanh-toan" style="" type="submit" class="btn btn-primary">Thanh toán
                            sản phẩm đã chọn</button>
                    </form>
                </div>



            </div>

            <div class="col-md-4" style="background-color: #ebebeb;">
                <div class="bg-while sidebar-checkout">
                    <div class="sidebar-order-wrap">
                        <div class="order_title">
                            <h4>Thông tin đơn hàng</h4>
                        </div>
                        <div class="order_total">
                            <p>Tạm tính:
                                <span class="total-price-cart" style="color:#000">{{ $tongtienSP }}₫</span>
                            </p>
                            <p>Giá giảm:
                                <span class="total-price-sale">{{ $tienGiam }}</span>
                            </p>
                            <p>Tổng tiền:
                                <span class="total-price">{{ $tongtienSP }}₫</span>
                            </p>
                        </div>

                        <div class="checkout-buttons clearfix">
                            <label for="note" class="note-label">Ghi chú đơn hàng</label>
                            <textarea class="form-control" name="note" rows="4" placeholder="Ghi chú"></textarea>
                            <input class="form-control dt-width-100 mg-top-10" id="code-discont"
                                placeholder="Nhập mã khuyến mãi (nếu có)">
                        </div>
                        <div class="order_action">
                            <form action="/hoadon/thanhtoan" method="GET">
                                <button id="thanh-toan-tat-ca" name="checkout_btn" class="btncart-checkout text-center"
                                    type="submit">THANH TOÁN
                                    TẤT CẢ GIỎ
                                    HÀNG</button>
                            </form>
                            <p class="link-continue text-center">
                                <a href="/">
                                    <i class="fa fa-reply"></i> Tiếp tục mua hàng
                                </a>
                            </p>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('form[id^="deleteForm-"]').forEach(function(form) {
                form.querySelector('button').addEventListener('click', function(event) {
                    event.preventDefault();
                    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const minusBtns = document.querySelectorAll('.minus-btn');
            const plusBtns = document.querySelectorAll('.plus-btn');
            const quantityInputs = document.querySelectorAll('.quantity');

            minusBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    let quantityInput = this.nextElementSibling;
                    let currentValue = parseInt(quantityInput.value, 10);
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                    }
                });
            });

            plusBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    let quantityInput = this.previousElementSibling;
                    let currentValue = parseInt(quantityInput.value, 10);
                    quantityInput.value = currentValue + 1;
                });
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-left-quantity').click(function() {
                var input = $(this).siblings('.quantity-selector');
                var newQuantity = parseInt(input.val()) - 1;
                if (newQuantity >= 1) {
                    updateQuantity(input, newQuantity);
                }
            });

            $('.btn-right-quantity').click(function() {
                var input = $(this).siblings('.quantity-selector');
                var newQuantity = parseInt(input.val()) + 1;
                updateQuantity(input, newQuantity);
            });

            function updateQuantity(input, newQuantity) {
                var masanpham = input.data('masp');
                var size = input.data('size');

                $.ajax({
                    url: '{{ route('updateCartQuantity') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        masanpham: masanpham,
                        size: size,
                        soluong: newQuantity,
                    },
                    success: function(response) {
                        input.val(newQuantity);
                        $('.total-price').text(response.tongtienSP + '₫');
                        $('.total-price-cart').text(response.tongtienSP +
                            '₫');
                        $('.total-price-sale').text(response.tienGiam + '₫');
                        $('.money').text(response.tongTienSPUpdate + '₫');
                        $('.quantity-selector').val(response.soLuong);
                        var prices = document.querySelectorAll(
                            ".total-price, .total-price-cart, .total-price-sale, .money");

                        prices.forEach(function(price) {
                            var number = parseInt(price.innerHTML);

                            var formattedPrice = number.toLocaleString();

                            console.log(formattedPrice)

                            price.innerHTML = formattedPrice + "₫";
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
                location.reload();
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#btn-chon-thanh-toan').on('click', function(event) {
                var checkedItems = $('.check-item:checked').map(function() {
                    return this.value;
                }).get();
                $.ajax({
                    url: '{{ route('processSelectedItems') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        selected_items: checkedItems
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.remove-item').on('click', function() {
                var masanpham = $(this).data('id');
                var size = $(this).data('sizedel')
                console.log(masanpham);
                console.log(size);
                var $itemRow = $(this).closest(
                    '.item-row');
                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: "Bạn sẽ không thể hoàn tác hành động này!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Vâng, xóa nó!',
                    cancelButtonText: 'Hủy bỏ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/delete-item',
                            type: 'POST',
                            data: {
                                MASP: masanpham,
                                SIZE: size,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    $itemRow.remove();
                                    location.reload();
                                } else {
                                    alert('Không thể xoá.');
                                }
                            },
                            error: function(xhr) {
                                alert('Không thể xoá.');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
