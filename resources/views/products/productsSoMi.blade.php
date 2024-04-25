<div class="container-fluid">
    <div class="row mt-4">
        @foreach ($sanphamSoMi as $item)
            <div class="col-6 col-sm-3 col-md-3 d-flex product-list">
                <div class="product-detail" align="center" data-aos="fade-up" data-aos-duration="800">
                    <a href="#" class="product-link">
                        <img src="{{ URL('images/' . $item->HINHANH) }}" alt="{{ $item->TENSANPHAM }}" class="img-product">
                        <p class="name-product">{{ $item->TENSANPHAM }}</p>
                        <div class="price-product">{{ $item->GIA }}</div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>