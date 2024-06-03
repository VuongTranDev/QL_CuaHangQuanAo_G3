@extends('layouts.app')
@section('renderBody')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tìm kiếm</li>
            </ol>
        </nav>

        <div class="row mt-4">
            <h5 class="text-center mb-3">Tìm được {{ $count_product }} kết quả tương thích với từ khoá "{{ $search_query }}"
            </h5>
            <div class="d-flex align-items-center mb-3">
                <label for="sort" class="me-2">
                    <span style="font-weight: 400">Sắp xếp:</span>
                </label>
                <div class="sort-group">
                    <select name="sort" id="sort" class="form-control">
                        <option value="none" class="text-center">--Lọc theo--</option>
                        <option value="kytu_az">Tên A → Z</option>
                        <option value="kytu_za">Tên Z → A</option>
                        <option value="tang_dan">Giá tăng dần</option>
                        <option value="giam_dan">Giá giảm dần</option>
                    </select>
                </div>
            </div>

            @foreach ($search_product as $item)
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

            <div class="btn-container">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item {{ $search_product->currentPage() == 1 ? 'disabled' : '' }}">
                            <a class="page-link"
                                href="{{ $search_product->previousPageUrl() }}&search_query={{ $search_query }}"
                                aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $search_product->lastPage(); $i++)
                            <li class="page-item {{ $search_product->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link"
                                    href="{{ $search_product->url($i) }}&search_query={{ $search_query }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li
                            class="page-item {{ $search_product->currentPage() == $search_product->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link"
                                href="{{ $search_product->nextPageUrl() }}&search_query={{ $search_query }}"
                                aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var priceElement = document.querySelectorAll(".price-product");

            priceElement.forEach(function(element) {
                var gia = parseFloat(element.textContent);
                var formattedPrice = gia.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                });
                element.textContent = formattedPrice;
            });
        });

        $(document).ready(function() {
            $('#sort').on('change', function() {
                var currentUrl = new URL(window.location.href);
                var selectedSort = $(this).val();
                currentUrl.searchParams.set('sort_by', selectedSort);
                var currentPage = currentUrl.searchParams.get('page');
                if (!currentPage) {
                    currentPage = 1;
                }
                currentUrl.searchParams.set('page', currentPage);
                window.location.href = currentUrl.toString();
                return false;
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
        });
    </script>
@endsection
