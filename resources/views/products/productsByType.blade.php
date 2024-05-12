@extends('layouts.app')
@section('renderBody')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $tenloai }}</li>

            </ol>
        </nav>

        <div class="row mt-4">
            <div class="d-flex align-items-center mb-3">
                <label for="sort" class="me-2">
                    <span style="font-weight: 400">Sắp xếp:</span>
                </label>
                <div class="sort-group">
                    <select name="sort" id="sort" class="form-control">
                        <option value="{{ Request::url() }}?sort_by=none" class="text-center">--Lọc theo--</option>
                        <option value="{{ Request::url() }}?sort_by=kytu_az">Tên A → Z</option>
                        <option value="{{ Request::url() }}?sort_by=kytu_za">Tên Z → A</option>
                        <option value="{{ Request::url() }}?sort_by=tang_dan">Giá tăng dần</option>
                        <option value="{{ Request::url() }}?sort_by=giam_dan">Giá giảm dần</option>
                    </select>
                </div>
            </div>

            @foreach ($sanphamtheoloai as $item)
                <div class="col-6 col-sm-3 col-md-3 d-flex product-list">
                    <div class="product-detail" align="center" data-aos="fade-up" data-aos-duration="800">
                        <a href="{{ route('product.showDetailProduct', ['masanpham' => $item->MASANPHAM]) }}"
                            class="product-link">
                            <img src="{{ URL('images/' . $item->HINHANH) }}" alt="{{ $item->TENSANPHAM }}"
                                class="img-product">
                            <p class="name-product">{{ $item->TENSANPHAM }}</p>
                            @php
                                $save_price = $item->GIA * (20 / 100);
                                $discout = $item->GIA - $save_price;

                            @endphp
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="price-product me-2">{{ $discout }}</span>
                                <span class="me-2" style="font-size: 13px"><del
                                        class="price-old">{{ $item->GIA }}</del></span>
                                <span class="discout-label" style="font-size: 13px">-20%</span>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function formatPriceElements() {
            var priceElements = document.querySelectorAll(".price-product, .price-detail-product, .save-price, .price-old");
            priceElements.forEach(function(element) {
                var gia = parseFloat(element.textContent);
                var formattedPrice = gia.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                });
                element.textContent = formattedPrice;
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            formatPriceElements()
        });

        $(document).ready(function() {
            $('#sort').on('change', function() {
                var url = $(this).val();
                if (url) {
                    window.location = url;
                }
                return false;
            });
        });

        var selectElement = document.getElementById('sort');

        selectElement.addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex].value;
            localStorage.setItem('selectedSortOption', selectedOption);
        });

        document.addEventListener('DOMContentLoaded', function() {
            var savedOption = localStorage.getItem('selectedSortOption');
            if (savedOption) {
                selectElement.value = savedOption;
            }
        });
    </script>
@endsection
