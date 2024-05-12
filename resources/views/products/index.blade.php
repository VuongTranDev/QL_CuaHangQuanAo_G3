@include('layouts.carousel')

<div class="container-fluid">
    <div class="policies-body justify-content-between align-items-center mt-4" data-aos="fade-up">
        <div class="policies-item">
            <div class="policies-image">
                <img src="//theme.hstatic.net/1000361985/1001103158/14/policies_icon_1.png?v=1274"
                    alt="policies_icon_1.png" width="40" height="40" class="img-policies" loading="lazy">
            </div>
            <div class="policies-info">
                <h3 class="policies-title">Miễn phí vận chuyển</h3>
                <div class="policies-desc">Cho đơn hàng chỉ từ 299k</div>
            </div>
        </div>

        <div class="policies-item">
            <div class="policies-image">
                <img src="//theme.hstatic.net/1000361985/1001103158/14/policies_icon_2.png?v=1274"
                    alt="policies_icon_2.png" width="40" height="40" class="img-policies" loading="lazy">
            </div>
            <div class="policies-info">
                <h3 class="policies-title">Quà tặng hấp dẫn</h3>
                <div class="policies-desc">Nhiều ưu đãi khuyến mãi hot</div>
            </div>
        </div>

        <div class="policies-item">
            <div class="policies-image">
                <img src="//theme.hstatic.net/1000361985/1001103158/14/policies_icon_3.png?v=1274"
                    alt="policies_icon_3.png" width="40" height="40" class="img-policies" loading="lazy">
            </div>
            <div class="policies-info">
                <h3 class="policies-title">Chất liệu chất lượng</h3>
                <div class="policies-desc">Yên tâm mua sắm
                </div>
            </div>
        </div>

        <div class="policies-item">
            <div class="policies-image">
                <img src="//theme.hstatic.net/1000361985/1001103158/14/policies_icon_4.png?v=1274"
                    alt="policies_icon_4.png" width="40" height="40" class="img-policies" loading="lazy">
            </div>
            <div class="policies-info">
                <h3 class="policies-title">Hotline: 0329951368</h3>
                <div class="policies-desc">Hỗ trợ bạn từ 9h00-22h00</div>
            </div>
        </div>
    </div>
</div>

@include('products.productsAoThun')
@include('products.productsQuan')
@include('products.productsSweater')
@include('products.productsHoodie')
@include('products.productsSoMi')
@include('products.productsJeans')

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
        formatPriceElements();
    });
</script>
