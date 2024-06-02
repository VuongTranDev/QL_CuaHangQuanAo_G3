<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Xác nhận đơn hàng</title>
</head>

<body>

    <table border="0" cellpadding="0" cellspacing="0" width="600"
        style="background-color:#ffffff;border:1px solid #dedede;border-radius:3px">
        <tbody>
            <tr>
                <td align="center" valign="top">

                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="background-color:#96588a;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;border-radius:3px 3px 0 0">
                        <tbody>
                            <tr>
                                <td style="padding:36px 48px;display:block">
                                    <h1
                                        style="font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left;color:#ffffff;background-color:inherit">
                                        Cảm ơn bạn đã đặt hàng
                                    </h1>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </td>
            </tr>
            <tr>
                <td align="center" valign="top">

                    <table border="0" cellpadding="0" cellspacing="0" width="600">
                        <tbody>
                            <tr>
                                <td valign="top" style="background-color:#ffffff">

                                    <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td valign="top" style="padding:48px 48px 32px">
                                                    <div
                                                        style="color:#636363;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">

                                                        <p style="margin:0 0 16px">Xin chào
                                                            {{ $emailParams->usersName }}</p>
                                                        <p style="margin:0 0 16px">
                                                            Cảm ơn bạn đã đặt hàng. Đơn hàng sẽ bị tạm
                                                            giữ cho đến khi chúng tôi xác nhận thanh toán hoàn thành.
                                                            Trong
                                                            thời gian chờ đợi, đây là lời nhắc về những gì bạn đã đặt
                                                            hàng:
                                                        </p>

                                                        <h2
                                                            style="color:#96588a;display:block;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">
                                                            Thông tin đơn hàng
                                                        </h2>

                                                        <table cellspacing="0" cellpadding="6" border="1"
                                                            style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        Tên sản phẩm
                                                                    </th>
                                                                    <th scope="col"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        Giá
                                                                    </th>
                                                                    <th scope="col"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        Chất liệu
                                                                    </th>
                                                                    <th scope="col"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        Hình ảnh
                                                                    </th>
                                                                    <th scope="col"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        Số lượng
                                                                    </th>
                                                                    <th scope="col"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        Thành tiền
                                                                    </th>
                                                                    <th scope="col"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        Size
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @php
                                                                    $TongTien = 0;
                                                                @endphp
                                                                @foreach ($emailParams->cart as $item)
                                                                    <tr>
                                                                        <td
                                                                            style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word">
                                                                            {{ $item->TENSANPHAM }}
                                                                        </td>
                                                                        <td class="price"
                                                                            style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                                            {{ $item->GIA }} &nbsp;₫
                                                                        </td>
                                                                        <td
                                                                            style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                                            {{ $item->CHATLIEU }}
                                                                        </td>
                                                                        <td
                                                                            style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                                            <img src="http://127.0.0.1:8000/images/{{ $item->HINHANH }}"
                                                                                alt="{{ $item->TENSANPHAM }}">
                                                                        </td>
                                                                        <td
                                                                            style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                                            {{ $item->SOLUONG }}
                                                                        </td>
                                                                        <td class="thanh-tien"
                                                                            style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                                            {{ $item->THANHTIEN }} &nbsp;₫
                                                                        </td>
                                                                        <td
                                                                            style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                                            {{ $item->SIZE }}
                                                                        </td>

                                                                    </tr>
                                                                    <?php $TongTien += $item->THANHTIEN; ?>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="6"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        <span>Phí vận chuyển:</span>
                                                                    </td>
                                                                    <td class="phi-van-chuyen"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        {{ $emailParams->phiVanChuyen }}&nbsp;₫

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        <span>Tổng tiền:</span>
                                                                    </td>
                                                                    <td class="tong-tien"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        {{ $emailParams->tongtien }}&nbsp;₫

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        <span>Địa Chỉ:</span>
                                                                    </td>
                                                                    <td
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        {{ $emailParams->diaChi }}

                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </td>
                            </tr>
                        </tbody>
                    </table>


                </td>
            </tr>
        </tbody>
    </table>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var prices = document.querySelectorAll(".price, .thanh-tien, .tong-tien, .phi-van-chuyen");

        prices.forEach(function(price) {
            var number = parseFloat(price.innerHTML);

            var formattedPrice = number.toLocaleString();


            price.innerHTML = formattedPrice + "₫";
            console.log(formattedPrice);
        });
    });
</script>

</html>
