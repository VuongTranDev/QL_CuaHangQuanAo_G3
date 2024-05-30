<div class="show-comment-group" data-aos="fade-up">
    @foreach ($sanpham as $item)
        <label class="ps-4 pt-4 font-bold">Đánh giá {{ $item->TENSANPHAM }}</label>
    @endforeach
    <div class="p-3">
        <table class="table-bordered w-100 mb-2" style="border: 1px solid #d5d5d5; border-radius: 8px;">
            <tr align="center">
                <td class="p-2 head-title-comment">
                    <p style="margin-bottom: 0px"><b>{{ $diemDanhGiaTong }}</b></p>
                    <p style="margin-bottom: 0px">({{ $countDanhGia }} đánh giá)</p>
                    <div class="avaliacou justify-content-center" style="height: 35px;" align="center">
                        @php
                            $soSaoNguyen = floor($diemDanhGiaTong);
                            $soSaoDu = $diemDanhGiaTong - $soSaoNguyen;
                        @endphp

                        @for ($i = 1; $i <= $soSaoNguyen; $i++)
                            <label class="star"></label>
                        @endfor

                        @if ($soSaoDu <= 0.5)
                            <label for="half-star" class="half-star star">&#x2605;</label>
                        @else
                            <label class="star"></label>
                        @endif
                    </div>
                </td>

                <td class="p-2">
                    <div class="avaliacou justify-content-start" style="height: 35px;" align="center">
                        <label for="star1" class="star" data-avaliacao="1"></label>
                        <label for="star2" class="star" data-avaliacao="2"></label>
                        <label for="star3" class="star" data-avaliacao="3"></label>
                        <label for="star4" class="star" data-avaliacao="4"></label>
                        <label for="star5" class="star" data-avaliacao="5"></label>
                        <span class="ms-2 count-comment">({{ $countDanhGia5s }} đánh giá)</span>
                    </div>
                    <div class="avaliacou justify-content-start" style="height: 35px;" align="center">
                        <label for="star1" class="star" data-avaliacao="1"></label>
                        <label for="star2" class="star" data-avaliacao="2"></label>
                        <label for="star3" class="star" data-avaliacao="3"></label>
                        <label for="star4" class="star" data-avaliacao="4"></label>
                        <label for="star5" class="star1" data-avaliacao="5"></label>
                        <span class="ms-2 count-comment">({{ $countDanhGia4s }} đánh giá)</span>
                    </div>
                    <div class="avaliacou justify-content-start" style="height: 35px;" align="center">
                        <label for="star1" class="star" data-avaliacao="1"></label>
                        <label for="star2" class="star" data-avaliacao="2"></label>
                        <label for="star3" class="star" data-avaliacao="3"></label>
                        <label for="star4" class="star1" data-avaliacao="4"></label>
                        <label for="star5" class="star1" data-avaliacao="5"></label>
                        <span class="ms-2 count-comment">({{ $countDanhGia3s }} đánh giá)</span>
                    </div>
                    <div class="avaliacou justify-content-start" style="height: 35px;" align="center">
                        <label for="star1" class="star" data-avaliacao="1"></label>
                        <label for="star2" class="star" data-avaliacao="2"></label>
                        <label for="star3" class="star1" data-avaliacao="3"></label>
                        <label for="star4" class="star1" data-avaliacao="4"></label>
                        <label for="star5" class="star1" data-avaliacao="5"></label>
                        <span class="ms-2 count-comment">({{ $countDanhGia2s }} đánh giá)</span>
                    </div>
                    <div class="avaliacou justify-content-start" style="height: 35px;" align="center">
                        <label for="star1" class="star" data-avaliacao="1"></label>
                        <label for="star2" class="star1" data-avaliacao="2"></label>
                        <label for="star3" class="star1" data-avaliacao="3"></label>
                        <label for="star4" class="star1" data-avaliacao="4"></label>
                        <label for="star5" class="star1" data-avaliacao="5"></label>
                        <span class="ms-2 count-comment">({{ $countDanhGia1s }} đánh giá)</span>
                    </div>
                </td>
            </tr>
        </table>

        <div class="w-100 p-3" style="border: 1px solid #d5d5d5;">
            @foreach ($sanpham as $item)
                <p>Có <b>{{ $countDanhGia }}</b> đánh giá cho sản phẩm <b>"{{ $item->TENSANPHAM }}"</b></p>
            @endforeach

            <div class="control-fiter mb-4">
                <button type="button" class="btn-filter-comment" value="5">5 <span>★</span></button>
                <button type="button" class="btn-filter-comment" value="4">4 <span>★</span></button>
                <button type="button" class="btn-filter-comment" value="3">3 <span>★</span></button>
                <button type="button" class="btn-filter-comment" value="2">2 <span>★</span></button>
                <button type="button" class="btn-filter-comment" value="1">1 <span>★</span></button>
            </div>
            
            <div id="container-comment">
                @include('danhgias.contentComment')
            </div>

            <div class="d-flex justify-content-center">

                <a href="/danhgias/showAllComment" target="_blank" class="form-control btn w-50 me-3 btn-show-comment">Xem thêm
                    đánh giá</a>
                <button type="submit" class="form-control btn w-50 btn-create-comment">Viết đánh giá</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var filterButtons = document.querySelectorAll(".btn-filter-comment");

        filterButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                var rating = this.value;
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "/danhgias/filterByRating?rating=" + rating, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = xhr.responseText;
                        document.getElementById("container-comment").innerHTML = response;
                    }
                };
                xhr.send();
            });
        });
    });

</script>
