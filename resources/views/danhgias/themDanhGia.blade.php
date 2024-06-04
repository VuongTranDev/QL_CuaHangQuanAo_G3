<div class="box-create-comment">
    <div class="form-create-comment">
        <button id="close-box-comment">X</button>
        <div class="comment-group mb-3 mt-3" align="center">
            <p class="title-comment mb-3 text-center">Đánh giá sản phẩm</p>
            @foreach ($sanpham as $item)
                <img src="{{ URL('images/' . $item->HINHANH) }}" alt="{{ $item->TENSANPHAM }}" width="100px"
                    height="130px">
                <h5 class="mb-3 mt-3" style="font-weight: 600;" align="center">{{ $item->TENSANPHAM }}</h5>
            @endforeach
            <form class="form-comment" role="comment" action="{{ route('danhgias.themDanhGia') }}" method="POST">
                @csrf
                @php
                    $MACTHD = Session::get('macthd');
                    if(Session::get('macthd'))
                        echo $MACTHD;
                @endphp
                <input type="hidden" name="MACTHD" value="{{$MACTHD}}">
                <div class="avaliacou" align="center">
                    <label for="star1" class="star-icon" data-avaliacao="1">
                        <input type="radio" name="SOSAO" id="star1" value="1">
                        <span class="title-comment-point">Rất tệ</span>
                    </label>
                    <label for="star2" class="star-icon" data-avaliacao="2">
                        <input type="radio" name="SOSAO" id="star2" value="2">
                        <span class="title-comment-point">Tệ</span>
                    </label>
                    <label for="star3" class="star-icon" data-avaliacao="3">
                        <input type="radio" name="SOSAO" id="star3" value="3">
                        <span class="title-comment-point">Tạm ổn</span>
                    </label>
                    <label for="star4" class="star-icon" data-avaliacao="4">
                        <input type="radio" name="SOSAO" id="star4" value="4">
                        <span class="title-comment-point">Tốt</span>
                    </label>
                    <label for="star5" class="star-icon" data-avaliacao="5">
                        <input type="radio" name="SOSAO" id="star5" value="5">
                        <span class="title-comment-point">Rất tốt</span>
                    </label>
                </div>
                <div class="form-group">
                    <textarea id="NOIDUNG" name="NOIDUNG" class="form-control mt-2" placeholder="Mời bạn chia sẻ thêm về cảm nhận..."></textarea>
                </div>
                <input type="submit" value="Gửi đánh giá" class="btn w-100 btn-submit-comment">
            </form>
        </div>
    </div>
</div>
