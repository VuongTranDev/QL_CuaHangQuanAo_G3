@extends('layouts.cartapp')

@section('main')
    <div class="container-xl">
        <div class="row">
            <div class="col-md-8">
                <div class="cart-title" style="background-color: #ebebeb;">
                    <h2>Giỏ hàng:</h2>
                    <span class="cart-count">
                        <span class="cart-counter">{{ $sogiohang }}</span>
                        <span class="cart-item-title">Sản phẩm</span>
                    </span>
                </div>
                <div class="list-cart" style="">
                    @foreach ($cart as $item)
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
                                            <div class="item-remove">
                                                <span class="remove-wrap">
                                                    <a href="javascript:void(0)"><i class="fa fa-times"></i></a>
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
                                                    <input type="button" value="–" class="qty-btn btn-left-quantity">
                                                    <input type="text" readonly="" name="updates[]"
                                                        value="{{ $item->SOLUONG }}" min="1"
                                                        class="quantity-selector quantity-mini">
                                                    <input type="button" value="+" class="qty-btn btn-right-quantity">
                                                </div>
                                                <div class="group-item-option">
                                                    <span class="item-option">
                                                        <span class="item-price">
                                                            <span class="money">{{ $item->GIA * $item->SOLUONG }}₫</span>
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
            </div>

            <div class="col-md-4" style="background-color: #ebebeb;">
                <div class="bg-while sidebar-checkout">
                    <div class="sidebar-order-wrap">
                        <div class="order_title">
                            <h4>Thông tin đơn hàng</h4>
                        </div>
                        <div class="order_total">
                            <p>Tạm tính:
                                <span class="total-price total-price-cart"
                                    style="color:#000">{{ $item->GIA * $item->SOLUONG }}₫</span>
                            </p>
                            <p>Giá giảm:
                                <span class="total-price-sale">0₫</span>
                            </p>
                            <p>Tổng tiền:
                                <span class="total-price">{{ $item->THANHTIEN }}₫</span>
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
                                <button class="btncart-checkout text-center" type="submit">THANH TOÁN NGAY</button>
                            </form>
                            <p class="link-continue text-center">
                                <a href="#">
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
    <script></script>
@endsection
