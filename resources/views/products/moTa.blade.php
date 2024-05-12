<div class="product-policises-wrapper">
    <ul class="product-policises list-unstyled py-sm-3 m-0">
        <li class="media">
            <div class="me-2">
                <img class="img-fluid " loading="lazy" width="24" height="24"
                    src="//theme.hstatic.net/1000361985/1001103158/14/policy_product_image_1.png?v=1274"
                    alt="Giao hàng nhanh 1-5 ngày toàn quốc">
            </div>
            <div class="media-body">
                Giao hàng nhanh 1-5 ngày toàn quốc
            </div>
        </li>
        <li class="media">
            <div class="me-2">
                <img class="img-fluid " loading="lazy" width="24" height="24"
                    src="//theme.hstatic.net/1000361985/1001103158/14/policy_product_image_2.png?v=1274"
                    alt="Mua gì cũng tích điểm">
            </div>
            <div class="media-body">
                Mua gì cũng tích điểm
            </div>
        </li>
        <li class="media">
            <div class="me-2">
                <img class="img-fluid " loading="lazy" width="24" height="24"
                    src="//theme.hstatic.net/1000361985/1001103158/14/policy_product_image_3.png?v=1274"
                    alt="Giảm ngay 3% khi trở thành thành viên">
            </div>
            <div class="media-body">
                Giảm ngay 3% khi trở thành thành viên
            </div>
        </li>
        <li class="media">
            <div class="me-2">
                <img class="img-fluid " loading="lazy" width="24" height="24"
                    src="//theme.hstatic.net/1000361985/1001103158/14/policy_product_image_4.png?v=1274"
                    alt="Đổi hàng/Hoàn tiền bất kể lí do trong vòng 15 ngày">
            </div>
            <div class="media-body">
                Đổi hàng/Hoàn tiền bất kể lí do trong vòng 15 ngày
            </div>
        </li>
    </ul>
</div>

<div class="describe-group">
    <div class="dropdown-describe d-flex justify-content-between">
        <p class="title-group-detail">Mô tả sản phẩm</p>
        <i class="fa fa-angle-down d-inline-block"></i>
    </div>
    <div class="describe-list">
        <ul class="mt-3">
            @foreach ($mota as $item)
                <li type="circle">{{ $item->MOTA }}</li>
            @endforeach
        </ul>
        @foreach ($sanpham as $item)
            <p>Áo thun <b>{{ $item->TENSANPHAM }}</b> với thiết kế thời thượng bằng chất liệu cotton 2 chiều 250gsm mang đến
                sự thoải mái và quen thuộc khi mặc. Hình in kéo lụa chắc chắn và bền màu. Form áo oversize cá
                tính và che hết mọi khuyết điểm trên cơ thể. Sản phẩm phù hợp với mọi hoạt động thường ngày. Cổ
                áo tròn ôm sát, dày dặn 3 cm và có chu vi vừa phải, tôn dáng và thoải mái khi mặc.
            </p>
        @endforeach

    </div>
</div>

<div class="size-group mb-3" data-aos="fade-up">
    <div class="dropdown-size d-flex justify-content-between" id="dropdown-size">
        <p class="title-group-detail">Bảng kích thước sản phẩm</p>
        <i class="fa fa-angle-down d-inline-block"></i>
    </div>
    <div class="size-item">
        <img id="sizeImage" src="" alt="Hướng dẫn chọn size" class="w-100">
        <input type="hidden" id="tenLoaiValue" value="{{ $tenloai }}">
    </div>
</div>

<div class="delivery-group mb-3" data-aos="fade-up">
    <div class="dropdown-delivery d-flex justify-content-between">
        <p class="title-group-detail">Chính sách giao hàng</p>
        <i class="fa fa-angle-down d-inline-block"></i>
    </div>
    <div class="delivery-list">

        <p><span style="font-size:16px;">Wonder Vista&nbsp;cam kết đảm bảo quyền lợi của khách hàng bằng
                cách cung
                cấp các chính sách vận chuyển tốt nhất, phù hợp với nhu cầu. Tiêu biểu là đơn vị vận
                chuyển GIAO
                HÀNG NHANH và một số đối tác khác. Hiện tại, Wonder Vista cung cấp dịch vụ giao hàng toàn
                quốc với
                mức phí đồng giá là 35,000đ</span></p>
        <h1><span style="font-size:18px;"><strong>1. Thời gian giao hàng</strong></span></h1>
        <p><span style="font-size:16px;"><u>Đối với nội thành trong TP. Hồ Chí Minh</u></span></p>
        <ul>
            <li><span style="font-size:16px;">Giao hàng từ 1-2 ngày kể từ ngày đặt hàng và thanh
                    toán (đối với
                    đơn hàng phát sinh vào Chủ Nhật và các ngày lễ, thời gian giao hàng sẽ là 2-4
                    ngày)</span>
            </li>
            <li><span style="font-size:16px;">Đặc biệt Wonder Vista có dịch vụ giao hàng trong ngày cho
                    khách có nhu
                    cầu nhận hàng trong ngày, như sau:</span></li>
        </ul>
        <p><span style="font-size:16px;">- Giao nhanh trong 2 tiếng: Phí ship sẽ phụ thuộc vào địa
                điểm khách
                nhận hàng, Wonder Vista sẽ hỗ trợ ship đối với đơn hàng trên 1,000,000đ</span></p>
        <p><span style="font-size:16px;">- Giao hàng trong 4 tiếng - dưới 10km: Phí ship
                &lt;40,000đ</span></p>
        <p><span style="font-size:16px;"><u>Đối với các tỉnh trong vùng miền Nam</u></span></p>
        <ul>
            <li><span style="font-size:16px;">Giao hàng từ 2-3 ngày kể từ ngày đặt hàng và thanh
                    toán (đối với
                    đơn hàng phát sinh vào Chủ Nhật và các ngày lễ, thời gian giao hàng sẽ là 3-5
                    ngày)</span>
            </li>
        </ul>
        <p><span style="font-size:16px;"><u>Đối với các khu vực còn lại&nbsp;</u></span></p>
        <ul>
            <li><span style="font-size:16px;">Giao hàng từ 3-4 ngày kể từ ngày đặt hàng và thanh
                    toán (đối với
                    đơn hàng phát sinh vào Chủ Nhật và các ngày lễ, thời gian giao hàng sẽ là 4-6
                    ngày)</span>
            </li>
        </ul>
        <p><span style="font-size:16px;"><u>Lưu ý:</u> Đơn hàng phát sinh vào các ngày có CTKM lớn
                có thể bị kéo
                dài thêm 2-4 ngày</span></p>
        <h1><span style="font-size:18px;"><strong>2. Số lần giao hàng</strong></span></h1>
        <ul>
            <li><span style="font-size:16px;">1 đơn hàng sẽ có tổng cộng 3 lần giao. Sau lần thứ
                    nhất nếu nhân
                    viên giao hàng không thể giao đơn hàng cho bạn (vì lí do như số điện thoại không
                    liên hệ
                    được hoặc địa chỉ giao hàng không đúng), nhân viên sẽ lưu kho đơn hàng 3 ngày để
                    Wonder Vista sẽ
                    liên hệ lại với bạn để đối chiếu thông tin nhận hàng chính xác chưa. Nếu sau 3
                    lần vẫn không
                    liên hệ giao hàng được, đơn hàng sẽ được hoàn về. Nếu đơn hàng của bạn gặp phải
                    tình trạng
                    này, uui lòng liên hệ với Wonder Vista qua Facebook hoặc Hotline để được hỗ trợ nhanh
                    nhất</span>
            </li>
            <li><span style="font-size:16px;">Đối với các trường hợp chịu sự ảnh hưởng của bệnh
                    dịch, thiên tai
                    hoặc các sự việc đặc biệt tác động đến quá trình giao hàng. Dịch vụ vận chuyển
                    sẽ tự động
                    thay đổi lịch giao hàng cho phù hợp mà không cần báo trước</span></li>
        </ul>
        <h1><span style="font-size:18px;"><strong>3. Kiểm tra trạng thái đơn hàng</strong></span>
        </h1>
        <p><span style="font-size:16px;">Bạn có thể vào mục ‘Kiểm tra đơn hàng' &nbsp;trên website
                để trực tiếp
                kiểm tra trạng thái đơn hàng.</span></p>
        <p><span style="font-size:16px;">Liên hệ với bộ phận Chăm sóc khách hàng của Wonder Vista qua
                các trang mạng
                xã hội (Facebook, Instagram, Zalo Official Account) hoặc hotline 0329951368 bằng
                việc cung cấp
                mã đơn hàng hoặc số điện thoại đặt hàng của bạn.</span></p>
    </div>
</div>

<div class="accordion-group mb-3" data-aos="fade-up">
    <div class="dropdown-accordion d-flex justify-content-between">
        <p class="title-group-detail">Chính sách đổi trả</p>
        <i class="fa fa-angle-down d-inline-block"></i>
    </div>
    <div class="accordion-list">
        <p><span style="font-size:16px"><span style="color:#393939">Cảm ơn các bạn đã tin tưởng lựa chọn
                    và mua
                    hàng tại Wonder Vista! Chúng mình hoàn toàn hiểu rằng việc mua sắm trực tuyến có thể
                    khiến
                    các
                    bạn phải đối mặt với một số thách thức, đặc biệt là khi chọn size, màu sắc hoặc kiểu
                    dáng
                    phù hợp. Với cam kết mang đến trải nghiệm mua sắm tốt nhất cho các bạn, Wonder
                    Vista&nbsp;xin
                    trân trọng thông báo về chính sách đổi trả linh hoạt của chúng mình.</span></span></p>
        <h1><span style="font-size:16px"><span style="color:#393939"><strong>1. ĐỔI/TRẢ HÀNG TRONG VÒNG
                        <u>15
                            NGÀY</u> NẾU LỖI TỪ NHÀ SẢN XUẤT</strong><br>Các lỗi thông thường đến từ nhà sản
                    xuất như: Hình in bị tróc, hư nút, kỹ thuật may, giãn cổ áo, hư khoá kéo trong quá trình
                    sử
                    dụng ngắn hạn hoắc các lỗi khác..</span></span></h1>
        <p><span style="font-size:16px"><span style="color:#393939">Lưu ý:</span></span></p>
        <ul>
            <li><span style="font-size:16px"><span style="color:#393939">Các bạn vui lòng liên hệ Wonder
                        Vista
                        để
                        đánh giá tình trạng sản phẩm để đưa ra hướng giải quyết nhanh chóng
                        nhất.</span></span>
            </li>
            <li><span style="font-size:16px"><span style="color:#393939">Bạn sẽ không mất bất cứ chi phí
                        nào nếu
                        lỗi từ Wonder Vista hay lỗi từ nhà sản xuất.</span></span></li>
        </ul>
        <h1><span style="font-size:16px"><strong>2. ĐỔI/TRẢ HÀNG TRONG VÒNG <u>7 NGÀY</u> NẾU NGOẠI QUAN
                    SẢN
                    PHẨM CÓ VẤN ĐỀ KHI NHẬN HÀNG</strong><br><span style="color:#393939">Các lỗi thông
                    thường ở
                    ngoại quan sản phẩm sẽ được đổi sản phẩm mới ngay khi nhận hàng được phát hiện những dấu
                    hiệu sau:</span></span></h1>
        <ul>
            <li><span style="font-size:16px"><span style="color:#393939">Sản phẩm không đầy đủ tag mác
                        (tag áo,
                        tag giấy và tag size của sản phẩm)</span></span></li>
            <li><span style="font-size:16px"><span style="color:#393939">Sản phẩm có vết bung chỉ, có vết
                        bẩn</span></span></li>
            <li><span style="font-size:16px"><span style="color:#393939">Sản phẩm không đúng mẫu, size đã
                        đặt
                        hàng</span></span></li>
        </ul>
        <p><span style="font-size:16px"><span style="color:#393939">Lưu ý:</span></span></p>
        <ul>
            <li><span style="font-size:16px"><span style="color:#393939">Mỗi hóa đơn chỉ được đổi trả 1
                        lần duy
                        nhất</span></span></li>
            <li><span style="font-size:16px"><span style="color:#393939">Bạn sẽ không mất bất cứ chi phí
                        nào nếu
                        lỗi từ Wonder Vista hay lỗi từ nhà sản xuất.</span></span></li>
        </ul>
        <h1><span style="font-size:16px"><strong>3. CÁC TRƯỜNG HỢP SẼ <u>KHÔNG</u> ĐƯỢC ĐỔI
                    TRẢ</strong></span>
        </h1>
        <ul>
            <li><span style="font-size:16px"><span style="color:#393939">Lỗi do bảo quản không đúng cách;
                        sử
                        dụng chất tẩy ngâm và giặt trực tiếp lên hình in và chi tiết của sản phẩm, phơi ở
                        nơi có
                        ánh nắng gắt trực tiếp quá lâu làm bạc màu sản phẩm</span></span></li>
            <li><span style="font-size:16px"><span style="color:#393939">Lỗi do có yêu tố ngoại quan làm
                        rách,
                        bẩn, ẩm mốc đến từ người sử dụng</span></span></li>
            <li><span style="font-size:16px"><span style="color:#393939">Quá thời hạn tính từ ngày nhận
                        hàng của
                        khách được in trên hoá đơn khi mua tại cửa hàng hoặc thời gian giao hàng thực tế đối
                        với
                        đơn hàng&nbsp;</span></span></li>
        </ul>

        <blockquote>
            <h2><span style="font-size:16px"><span style="color:#393939"><strong><u>Các trường hợp đổi trả
                                thường gặp</u></strong></span></span></h2>
        </blockquote>
        <blockquote>
            <p><span style="font-size:16px"><span style="color:#393939">(1) Nếu sản phẩm bạn mua với giá
                        500,000đ&nbsp;và tiền ship 30,000đ&nbsp;bị lỗi. Sau khi nhận hàng được&nbsp;10 ngày
                        và
                        nhận thấy&nbsp;sản phẩm bị lỗi, bạn cần trả hàng hoàn tiền thì bạn vẫn nhận được số
                        tiền
                        hoàn là 530,000đ<br>(2) Nếu sản phẩm hoàn toàn chưa qua sử dụng, còn mới 100% và đã
                        qua
                        10 ngày để từ ngày nhận hàng,&nbsp;Wonder Vista vẫn hỗ trợ đổi hoặc hoàn tiền lại
                        cho
                        bạn&nbsp;</span></span></p>
        </blockquote>
        <hr>
        <h1><strong><span style="font-size:16px">QUY TRÌNH TRẢ HÀNG - HOÀN TIỀN: NHANH CHÓNG VÀ MIỄN
                    PHÍ</span></strong></h1>
        <p><span style="font-size:16px"><span style="color:#393939">Bạn gửi trả hàng qua đơn vị vận
                    chuyển, vui
                    lòng&nbsp;liên hệ với Wonder Vista và cung cấp&nbsp;Tên + SĐT liên hệ và Thông tin tài
                    khoản
                    nhận
                    tiền kèm theo Mã vận đơn&nbsp;hàng trả.&nbsp;Wonder Vista cam kết trong&nbsp;24 tiếng
                    (Trừ
                    Thứ 7,
                    CN &amp; Lễ) sau khi nhận hàng sẽ thực hiện công tác&nbsp;kiểm tra sản phẩm tình trạng
                    sản
                    phẩm và điều kiện đơn hàng. Nếu tất cả đều hợp lệ,&nbsp;tiền sẽ được hoàn vào tài khoản
                    bạn
                    trong vòng 24 tiếng sau khi Wonder Vista kiểm tra.</span></span></p>
        <p><span style="font-size:16px"><span style="color:#393939">Phí thu hồi &amp; chuyển khoản tất cả
                    đều là
                    MIỄN PHÍ.</span></span></p>
        <div style="left: 20px; top: 20px;">&nbsp;</div>
    </div>
</div>
