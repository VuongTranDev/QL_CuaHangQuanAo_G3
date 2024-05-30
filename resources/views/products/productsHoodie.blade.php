<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center p-2 mt-2" data-aos="fade-up">
        <a href="{{ route('products.productsByType', ['tenloai' => 'Hoodie']) }}" class="title-category">Áo Hoodie</a>
        <a href="{{ route('products.productsByType', ['tenloai' => 'Hoodie']) }}" class="category-link-all">Xem các sản
            phẩm khác</a>
    </div>
    <div class="row mt-4 mb-2 d-flex justify-content-between">
        <div class="col-lg-6 row">
            @foreach ($sanphamHoodie as $item)
                <div class="col-6 col-sm-6 col-md-6 d-flex product-list">
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
        <div class="col-lg-6" data-aos="fade-up">
            <a href="/allProducts"><img src="../../images/Wanderlust5.jpg" alt="" class="w-100 mb-4"></a>
        </div>
    </div>
</div>
