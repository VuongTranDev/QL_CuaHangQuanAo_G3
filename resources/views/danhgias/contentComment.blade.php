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

        @php
            $currentUserMAKH = Session::get('makh');
        @endphp

        @if ($dg->MAKH == $currentUserMAKH)
            <div class="dropleft" role="group">
                <button type="button" class="btn btn-secondary dropdown-toggle-split bg-transparent border-0"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v text-dark" style="font-size: 10px"></i>
                </button>

                <div class="dropdown-menu">
                    <a class="dropdown-item delete-comment" href="#" data-id="{{ $dg->ID }}"><i
                            class="fa fa-times text-danger text me-2"></i>
                        Xoá</a>
                </div>
            </div>
        @else
            <div class="dropleft" role="group">
                <button type="button" class="btn btn-secondary dropdown-toggle-split bg-transparent border-0"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v text-dark"></i>
                </button>

                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Báo cáo</a>
                </div>
            </div>
        @endif


    </div>
@endforeach
<script>
    $(document).on('click', '.delete-comment', function(e) {
        e.preventDefault();
        var commentId = $(this).data('id');

        Swal.fire({
            title: 'Bạn có chắc chắn xoá bình luận này chứ?',
            text: "Bạn sẽ không thể hoàn tác hành động này!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vâng, xóa nó!',
            cancelButtonText: 'Hủy bỏ'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/xoaDanhGia/' + commentId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Xóa thành công!',
                                'Đánh giá đã được xóa.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Lỗi!',
                                'Đã xảy ra lỗi khi xóa đánh giá.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Lỗi!',
                            'Đã xảy ra lỗi khi xóa đánh giá.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>
