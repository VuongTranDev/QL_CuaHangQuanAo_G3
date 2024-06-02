@extends('layouts.app')
@section('renderBody')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tất cả bình luận</li>
            </ol>
        </nav>

        <div class="show-comment-group" data-aos="fade-up">
            <div class="p-3">
                <div class="w-100 p-3" style="border: 1px solid #d5d5d5;">
                    @foreach ($danhgia as $dg)
                        <div class="d-flex justify-content-between">
                            <div class="d-grid mb-3 w-100" style="border-bottom: 1px dashed #d5d5d5;">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="https://theme.hstatic.net/1000233137/1000650361/14/no_avatar.gif?v=75124"
                                        height="20px" width="20px">
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
                                <!-- Dropdown for delete and edit -->
                                <div class="dropleft" role="group">
                                    <button type="button"
                                        class="btn btn-secondary dropdown-toggle-split bg-transparent border-0"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v text-dark" style="font-size: 10px"></i>
                                    </button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item delete-comment" href="#"
                                            data-id="{{ $dg->ID }}"><i class="fa fa-times text-danger text me-2"></i>
                                            Xoá</a>
                                    </div>
                                </div>
                            @else
                                <!-- Dropdown for report -->
                                <div class="dropleft" role="group">
                                    <button type="button"
                                        class="btn btn-secondary dropdown-toggle-split bg-transparent border-0"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v text-dark" style="font-size: 10px"></i>
                                    </button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Báo cáo</a>
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endforeach
                </div>
            </div>

            <div class="btn-container">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item {{ $danhgia->currentPage() == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $danhgia->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $danhgia->lastPage(); $i++)
                            <li class="page-item {{ $danhgia->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $danhgia->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ $danhgia->currentPage() == $danhgia->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $danhgia->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>

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


        $(document).ready(function() {
            $('.pagination .page-item.previous').click(function(e) {
                e.preventDefault();
                var previousUrl = $(this).find('a').attr('href');
                if (previousUrl) {
                    window.location.href = previousUrl;
                }
            });

            $('.pagination .page-item.next').click(function(e) {
                e.preventDefault();
                var nextUrl = $(this).find('a').attr('href');
                if (nextUrl) {
                    window.location.href = nextUrl;
                }
            });
        });
    </script>
@endsection
