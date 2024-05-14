@extends('layouts.app')
@section('renderBody')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tim kiếm</li>

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
                        <option value="{{ Request::url() }}?search_query={{ $search_query }}&sort_by=none"
                            class="text-center">
                            --Lọc theo--</option>
                        <option value="{{ Request::url() }}?search_query={{ $search_query }}&sort_by=kytu_az">Tên A → Z
                        </option>
                        <option value="{{ Request::url() }}?search_query={{ $search_query }}&sort_by=kytu_za">Tên Z → A
                        </option>
                        <option value="{{ Request::url() }}?search_query={{ $search_query }}&sort_by=tang_dan">Giá tăng
                            dần
                        </option>
                        <option value="{{ Request::url() }}?search_query={{ $search_query }}&sort_by=giam_dan">Giá
                            giảm dần
                        </option>
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
                            <div class="price-product">{{ $item->GIA }}</div>
                        </a>
                    </div>
                </div>
            @endforeach
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

        // $(document).ready(function() {
        //     $('#sort').on('change', function() {
        //         var url = $(this).val();
        //         if (url) {
        //             window.location = url;
        //         }
        //         return false;
        //     });
        // });

        // var selectElement = document.getElementById('sort');

        // selectElement.addEventListener('change', function() {
        //     var selectedOption = this.options[this.selectedIndex].value;
        //     localStorage.setItem('selectedSortOption', selectedOption);
        // });

        // document.addEventListener('DOMContentLoaded', function() {
        //     var savedOption = localStorage.getItem('selectedSortOption');
        //     if (savedOption) {
        //         selectElement.value = savedOption;
        //     }
        // });
        $(document).ready(function() {
            var selectElement = document.getElementById('sort');

            // Khi tài liệu đã được tải hoàn toàn
            document.addEventListener('DOMContentLoaded', function() {
                // Lấy giá trị được lưu trong Local Storage
                var savedOption = localStorage.getItem('selectedSortOption');
                console.log("savedOption:", savedOption);
                if (savedOption) {
                    // Nếu có giá trị trong Local Storage, chọn giá trị đó trên dropdown
                    selectElement.value = savedOption;
                } else {
                    // Nếu không có giá trị trong Local Storage, chọn giá trị đầu tiên trên dropdown
                    selectElement.value = selectElement.options[0].value;
                    // Lưu giá trị mặc định vào Local Storage
                    localStorage.setItem('selectedSortOption', selectElement.value);
                }
            });

            // Sự kiện thay đổi của dropdown
            $('#sort').on('change', function() {
                // Lưu giá trị mới vào Local Storage
                var selectedOption = this.options[this.selectedIndex].value;
                localStorage.setItem('selectedSortOption', selectedOption);
                console.log("selectedOption:", selectedOption);

                var url = $(this).val();
                if (url) {
                    window.location = url; // Chuyển hướng đến URL mới
                }
            });
        });
    </script>
@endsection
