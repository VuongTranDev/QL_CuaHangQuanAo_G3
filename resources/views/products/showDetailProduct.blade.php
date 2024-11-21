@extends('layouts.app')

@section('renderBody')
    <style>


    </style>

    <script src="../../js/javascript.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <div class="container-fluid">
        <div class="row mb-5">
            <nav aria-label="breadcrumb" class="mb-3" data-aos="fade-up">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('products.productsByType', ['tenloai' => $tenloai]) }}">{{ $tenloai }}</a>
                    </li>
                    @foreach ($sanpham as $item)
                        <li class="breadcrumb-item active" aria-current="page">{{ $item->TENSANPHAM }}</li>
                    @endforeach
                </ol>
            </nav>

            <div class="col-12 col-lg-6 d-flex justify-content-between row carousel-detail-product">
                <!-- Thumbnail -->
                <div class="col-0 col-lg-2 thumbnail-group">
                    @foreach ($hinhanh as $key => $item)
                        <div class="mb-3 me-2">
                            <img src="{{ asset('images/' . $item->HINHANHSP) }}" class="img-thumbnail thumbnail"
                                alt="..." data-target="#carouselExample" data-slide-to="{{ $key }}">
                        </div>
                    @endforeach
                </div>

                <div class="col-12 col-lg-10 carousel-detail-group">
                    <div id="carouselExample" class="carousel slide slide-detail" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($hinhanh as $key => $item)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}" align="center">
                                    <img src="{{ asset('images/' . $item->HINHANHSP) }}" class="img-detail" alt="...">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 ps-1 ps-lg-3" data-aos="fade-up">
                <form action="{{ route('muahang') }}" method="POST" onsubmit="return checkSelectedSize()">
                    @csrf
                    @foreach ($sanpham as $item)
                        <h3 class="mb-3" style="font-size: 27px; font-weight: 600;">{{ $item->TENSANPHAM }}</h3>
                        @php
                            $save_price = $item->GIA * (20 / 100);
                            $discout = $item->GIA - $save_price;
                        @endphp
                        <div class="d-flex align-items-center">
                            <span class="price-detail-product me-3">{{ $discout }}</span>
                            <input type="hidden" name="discout" value="{{ $discout }}">
                            <span class="me-4"><del class="price-old">{{ $item->GIA }}</del></span>
                            <input type="hidden" name="price_old" value="{{ $item->GIA }}">
                            <span class="discout-label">-20%</span>
                            <input type="hidden" name="discount_label" value="-20%">
                        </div>
                        <div>
                            <p style="font-size: 14px;" class="mt-2">( Tiết kiệm <span
                                    class="price-old">{{ $save_price }}</span> )</p>
                        </div>
                    @endforeach

                    <div class="mb-3 mt-3">
                        <div class="title-size mb-2">
                            <p style="font-weight: 600; font-size: 19px;">Kích thước</p>
                            <a href="#" id="showSizeGuide" class="me-4 text-dark">Hướng dẫn chọn size</a>
                        </div>

                        <div>
                            @foreach ($size as $item)
                                <label class="size-btn" id="{{ $item->SIZESP }}">
                                    <input type="radio" name="size" value="{{ $item->SIZESP }}"
                                        onclick="checkSelectedSize(this)">
                                    {{ $item->SIZESP }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-button-detail mb-3 mt-3 w-100">
                            <div class="quantity-input me-3">
                                <button class="quantity-btn minus-btn" type="button">-</button>
                                <input class="quantity" name="quantity" value="1" min="1">
                                <button class="quantity-btn plus-btn" type="button">+</button>
                            </div>

                            <div class="button_actions mb-0 w-100">
                                <button id="themvaogiohang" name="themvaogiohang" type="submit"
                                    class="btn btn_add_cart btn-cart add_to_cart product-combo is-full">Thêm vào giỏ
                                    hàng</button>
                            </div>
                        </div>
                        <div class="button_actions">
                            <button id="muangay" name="muangay" type="submit" class="btn btn-buynow">Mua ngay</button>
                        </div>
                    </div>
                </form>




                @include('products.moTa')
                @include('danhgias.showDanhGia')

            </div>
        </div>

        @include('danhgias.themDanhGia')

        <div class="box-select-size">
            <div class="group-size">
                <button id="closeBox">X</button>
                <img id="sizeGuideImage" src="" alt="Hướng dẫn chọn size" class="img-select-size">
                <input type="hidden" id="tenLoaiValue" value="{{ $tenloai }}">
            </div>
        </div>

        <h2 class="mb-3 ms-3 mt-4" style="font-weight: 600" data-aos="fade-up">Có thể bạn sẽ thích</h2>
        <div class="slider-container row">
            <div class="slider row">
                @foreach ($sanphamcungloai as $item)
                    <div class="col-6 col-sm-3 col-md-3 d-flex product-list">
                        <div class="product-detail m-2" align="center">
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
                                {{-- <div class="price-product">{{ $item->GIA }}</div> --}}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="slick-controls">
                <button type="button" class="slick-prev" style="color: black; display: block"><i
                        class="fas fa-chevron-left"></i></button>
                <button type="button" class="slick-next" style="color: black"><i
                        class="fas fa-chevron-right"></i></button>
            </div>
        </div>

        <h2 class="mb-3 ms-3 mt-2" style="font-weight: 600">Sản phẩm cùng loại</h2>
        <div class="row mt-4">
            @foreach ($sanphamcungloai as $item)
                <div class="col-6 col-sm-3 col-md-3 d-flex product-list">
                    <div class="product-detail" align="center">
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
        $(document).ready(function() {
            $('.slider').slick({
                lazyLoad: 'ondemand',
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 1,
                prevArrow: $('.slick-prev'),
                nextArrow: $('.slick-next'),
                autoplay: true,
                autoplaySpeed: 3000,
                responsive: [{
                    breakpoint: 786,
                    settings: {
                        slidesToShow: 2
                    }
                }]
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('form').addEventListener('submit', function(event) {
                if (!document.querySelector('input[name="size"]:checked')) {
                    event.preventDefault();
                }
            });
        });
    </script>
    <script>
        function checkSelectedSize() {
            var radios = document.getElementsByName('size');
            var selectedSize = false;
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    selectedSize = true;
                    break;
                }
            }
            if (!selectedSize) {
                Swal.fire({
                    title: 'Vui lòng chọn size!',
                    icon: 'error',
                    timer: 10000,
                })
                return false;
            }
            return true;
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            handleSearchForm();
            handleSearchForm2();

            const searchInput2 = document.getElementById('searchInput2');
            searchInput2.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {

                    submitSearch2();
                }
            });

            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    submitSearch();
                }
            });
        });

        function handleSearchForm() {
            const searchInput = document.querySelector('.search');
            const searchIcon = document.querySelector('.ic-search');

            searchIcon.addEventListener('click', function(e) {
                if (!searchInput.classList.contains('expanded')) {
                    e.preventDefault();
                    searchInput.classList.add('expanded');
                    searchInput.focus();
                }
            });

            searchInput.addEventListener('blur', function() {
                if (searchInput.value === '') {
                    searchInput.classList.remove('expanded');
                }
            });
        }

        function submitSearch() {
            var searchQuery = $('#searchInput').val();
            $.ajax({
                url: "{{ route('products.search') }}",
                type: "GET",
                data: {
                    search_query: searchQuery
                },
                success: function(response) {
                    var newUrl = "{{ route('products.search') }}" + '?search_query=' + encodeURIComponent(
                        searchQuery);
                    window.history.pushState({
                        path: newUrl
                    }, '', newUrl);
                    window.location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function handleSearchForm2() {
            const searchInput2 = document.getElementById('searchInput2');
            const searchIcon2 = document.getElementById('searchButton2');

            searchIcon2.addEventListener('click', function(e) {
                if (!searchInput2.classList.contains('expanded')) {
                    e.preventDefault();
                    searchInput2.classList.add('expanded');
                    searchInput2.focus();
                }
            });

            searchInput2.addEventListener('blur', function() {
                if (searchInput2.value === '') {
                    searchInput2.classList.remove('expanded');
                }
            });
        }

        function submitSearch2() {
            var searchQuery2 = $('#searchInput2').val();
            $.ajax({
                url: "{{ route('products.search') }}",
                type: "GET",
                data: {
                    search_query: searchQuery2
                },
                success: function(response) {
                    var newUrl = "{{ route('products.search') }}" + '?search_query=' + encodeURIComponent(
                        searchQuery2);
                    window.history.pushState({
                        path: newUrl
                    }, '', newUrl);
                    window.location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
@endsection
