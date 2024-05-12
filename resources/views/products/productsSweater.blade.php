<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center p-2 mt-2" data-aos="fade-up">
        <a href="{{ route('products.productsByType', ['tenloai' => 'Sweater']) }}" class="title-category">Áo Sweater</a>
        <a href="{{ route('products.productsByType', ['tenloai' => 'Sweater']) }}" class="category-link-all">Xem các sản
            phẩm khác</a>
    </div>
    <div class="row mt-4">
        @foreach ($sanphamSweater as $item)
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
