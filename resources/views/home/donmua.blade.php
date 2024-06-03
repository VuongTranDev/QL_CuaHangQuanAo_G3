@extends('layouts.showProfile')
@section('renderProfile')
    <div class="row">
        <div class="col-md-6">
            <h5>Thông tin đơn mua</h5>
        </div>
        <div class="col-md-6">
            <h5 style="text-align: right">Số đơn mua: {{ $sodonmua }}</h5>
        </div>
    </div>
    <hr>
    <style>
        .img-item-don-mua {
            width: 150px;
            height: 150px;
        }

        .item-don-mua {
            background: #f3f3f3;
            padding: 10px;
            margin-bottom: 30px;
        }

        .title-item-don-mua,
        .so-luong {
            margin-left: 30px;


        }

        .size-item-don-mua {
            margin-left: 15px;
        }

        .title-item-don-mua {
            font-weight: 700;
        }

        .money,
        .discout {
            font-size: 13px;
        }

        .discout {
            color: red;
        }

        .mua-lai {
            display: flex;
            justify-content: flex-end;
        }

        .money {
            color: gray;
        }

        .thanh-tien {
            color: red;
        }
        a{
            color: #333;
            text-decoration: none;
        }
    </style>
    <div class="container">

        @foreach ($donmua as $item)
            <div class="item-don-mua">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="http://127.0.0.1:8000/products/{{ $item->MASP }}">
                            <img class="img-item-don-mua" src="{{ URL('images/' . $item->HINHANH) }}"
                                alt="{{ $item->TENSANPHAM }}">
                        </a>
                    </div>
                    <div class="col-md-9 info-item">
                        <div class="title-item-don-mua">
                            <a href="http://127.0.0.1:8000/products/{{ $item->MASP }}">
                                <p>{{ $item->TENSANPHAM }}</p>
                            </a>
                        </div>
                        <div class="size-item-don-mua row">
                            <div class="col-md-3">
                                <p>Size: {{ $item->SIZE }}</p>
                            </div>
                            <div class="col-md-8">
                                <p class="price" style="text-align: right">
                                    @php
                                        $save_price = $item->GIA * (20 / 100);
                                        $discout = $item->GIA - $save_price;

                                    @endphp
                                    <span class="money"><del class="del-gia">{{ $item->GIA }}</del></span>
                                    <span class="discout">{{ $discout }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="so-luong">
                            <p>x{{ $item->SL }}</p>
                        </div>
                        <div class="tong-tien">
                            <p style="text-align: right; font-weight: 600">Thành tiền: <span
                                    class="thanh-tien">{{ $item->THANHTIEN }}</span></p>
                        </div>
                        <div class="mua-lai">
                            <a href="http://127.0.0.1:8000/products/{{ $item->MASP }}">
                                <button style="width: 100px" type="button" class="btn btn-primary">Mua lại </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        var prices = document.querySelectorAll(
            ".thanh-tien, .discout, .del-gia");

        prices.forEach(function(price) {
            var number = parseInt(price.innerHTML);

            var formattedPrice = number.toLocaleString();

            console.log(formattedPrice)

            price.innerHTML = formattedPrice + "₫";
        });
    </script>
@endsection
