@extends('layouts.app')
@section('renderBody')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giới thiệu</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-7 slogan-group" data-aos="fade-up">
                <div class="d-flex flex-wrap flex-column flex-sm-row">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="title-slogan">
                            WONDER VISTA - THƯƠNG HIỆU DÀNH CHO GIỚI TRẺ
                            <hr>
                            <div style="display: flex">
                                <img src="{{ URL('images/about3.png') }}" alt="" width="33%" height="auto">
                                <img src="{{ URL('images/about5.png') }}" alt="" width="33%" height="auto">
                                <img src="{{ URL('images/about2.png') }}" alt="" width="34%" height="auto">
                            </div>
                            <div style="display: flex">
                                <img src="{{ URL('images/about1.png') }}" alt="" width="50%" height="auto">
                                <img src="{{ URL('images/about4.png') }}" alt="" width="50%" height="auto">
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5" data-aos="fade-up">
                <div>
                    <h2 class="title-about">WHO WE ARE</h2>
                    <p style="text-align: justify;">
                        Là một trong những thương hiệu thời trang tiên phong, thành lập vào giữa năm 2018, WONDER VISTA nay
                        đã
                        trở thành một thương hiệu quen thuộc đối với các bạn trẻ Việt yêu thời trang streetwear. Với
                        định
                        hướng là một thương hiệu cung cấp các sản phẩm thời trang trẻ trung, cá tính nhưng vẫn duy trì
                        sự
                        cân bằng hoàn hảo giữa giá cả và chất lượng, đã tạo nên sự nổi bật của WONDER VISTA trong thị trường
                        thời
                        trang Việt Nam.
                    </p>
                    <img src="{{ URL('images/about1.png') }}" alt="" width="100%" height="auto"
                        data-aos="fade-up">
                </div>
                <div data-aos="fade-up">
                    <h2 class="title-about">WHAT WE HAVE</h2>
                    <h4 class="title-about-item">THIẾT KẾ ĐỘC ĐÁO, ẤN TƯỢNG</h4>
                    <p style="text-align: justify;" data-aos="fade-up">
                        Với đội ngũ nhân viên trẻ trung, năng động và tâm huyết, WONDER VISTA luôn cố gắng thay đổi và học
                        hỏi
                        hằng ngày nhằm bắt kịp những xu hướng thời trang mới nhất. Những thiết kế của WONDER VISTA luôn chứa
                        đựng
                        sự sáng tạo dựa trên những hình tượng nghệ thuật, hay đôi khi là những hình ảnh bình thường trong
                        đời sống. Từ đó tạo ra những sản phẩm mang màu sắc cá tính riêng hoàn toàn khác biệt.
                    </p>
                    <img src="{{ URL('images/about4.png') }}" alt="" width="100%" height="auto"
                        data-aos="fade-up">
                </div>
                <div data-aos="fade-up">
                    <h4 class="title-about-item">CHẤT LƯỢNG SẢN PHẨM LUÔN ĐƯỢC ƯU TIÊN</h4>
                    <p style="text-align: justify;">
                        WONDER VISTA không chỉ thu hút bởi những thiết kế trẻ trung, năng động, bộc lộ rõ cá tính thời
                        trang, mà
                        còn mang đến cho người dùng trải nghiệm chất lượng áo tuyệt vời.
                        Gây ấn tượng bởi sự tỉ mỉ trong việc chọn nguyên liệu, cùng với sự quan tâm chu đáo tới trải nghiệm
                        khách hàng: các loại áo thun hút mồ hôi, co giãn nhẹ khiến người dùng thoải mái khi sử dụng; Áo
                        khoác luôn có 2 lớp với chất liệu hoàn hảo giữ ấm vào mùa đông mà vẫn thoáng mát vào mùa hè.
                        WONDER VISTA luôn tin rằng chất lượng sản phẩm của mình đủ làm hài lòng bất kỳ khách hàng nào dù khó
                        tính
                        nhất.
                    </p>
                    <img src="{{ URL('images/about2.png') }}" alt="" width="100%" height="auto"
                        data-aos="fade-up">
                </div>
                <div data-aos="fade-up">
                    <h4 class="title-about-item">CHÍNH SÁCH ƯU ĐÃI VÀ QUÀ TẶNG HẤP DẪN</h4>
                    <p style="text-align: justify;">
                        Bên cạnh việc cho ra đời những sản phẩm độc đáo và ấn tượng, WONDER VISTA còn có chiến lược truyền
                        thông
                        mạnh mẽ giúp quảng bá rộng rãi sản phẩm của thương hiệu đến gần hơn với khách hàng. Nhưng tất cả vẫn
                        chưa đủ, bởi vì WONDER VISTA còn có một yếu tố thu hút khách hàng không thể thiếu nữa đó là chính
                        sách ưu
                        đãi cùng quà tặng tri ân đến những người dùng đã ủng hộ chúng mình trên mỗi sản phẩm được bán ra.
                    </p>
                    <img src="{{ URL('images/about3.png') }}" alt="" width="100%" height="auto"
                        data-aos="fade-up">
                </div>
                <div data-aos="fade-up">
                    <h4 class="title-about-item">CHĂM SÓC KHÁCH HÀNG TẬN TÂM</h4>
                    <p style="text-align: justify;">
                        Ở WONDER VISTA, chúng mình tin rằng việc bán hàng là bán cả một trải nghiệm về sản phẩm và dịch vụ.
                        WONDER VISTA có luôn nỗ lực hướng tới trở thành một thương hiệu tiêu biểu về việc chăm sóc tận tâm
                        và là
                        “Best Choice” đối với khách hàng đã và đang sử dụng sản phẩm của thương hiệu.
                    </p>
                    <img src="{{ URL('images/about5.png') }}" alt="" width="100%" height="auto"
                        data-aos="fade-up">
                </div>

            </div>

        </div>
    </div>
@endsection
