@foreach ($danhgia as $dg)
    <div class="d-flex justify-content-between">
        <div class="d-grid mb-3 w-100" style="border-bottom: 1px dashed #d5d5d5;">
            <div class="d-flex align-items-center mb-2">
                <img src="https://theme.hstatic.net/1000233137/1000650361/14/no_avatar.gif?v=75124" height="20px"
                    width="20px">
                <span class="ms-2">{{ $dg->TENKH }}</span>
            </div>

            @php
                $stars = $dg->SOSAO;
            @endphp

            <div class="avaliacou justify-content-start" style="height: 35px;" align="center">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $stars)
                        <label for="star{{ $i }}" class="star"
                            data-avaliacao="{{ $i }}"></label>
                    @else
                        <label for="star{{ $i }}" class="star1"
                            data-avaliacao="{{ $i }}"></label>
                    @endif
                @endfor
            </div>
            <p>{{ $dg->NOIDUNG }}</p>
        </div>

        <div class="dropleft" role="group">
            <button type="button" class="btn btn-secondary dropdown-toggle-split bg-transparent border-0"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v text-dark"></i>
            </button>

            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Xoá</a>
                <a class="dropdown-item" href="#">Sửa</a>
            </div>
        </div>

    </div>
@endforeach
