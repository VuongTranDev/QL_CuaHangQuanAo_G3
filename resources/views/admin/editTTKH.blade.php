@extends('admin_layout')
<head>
    <!-- SweetAlert2 CSS -->
  
</head>

@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thông tin khách hàng
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach ($data as $sp)
                            <form role="form" action="{{ URL::to('/updateTTKH' . $sp->MAUSER) }}" method="post" enctype="multipart/form-data" class="customer-form">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên khách hàng</label>
                                    <input type="text" name="tenKH" data-id="{{ $sp->MAUSER }}" class="form-control" value="{{ $sp->TENKH }}" id="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" name="emailKH" value="{{ $sp->EMAIL }}" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" rows="4" name="diachiKH" value="{{ $sp->DIACHI }}" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="number" rows="4" name="sodienthoaiKH" value="{{ $sp->SODIENTHOAI }}" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label for="loaiQuyen">Quyền người dùng</label>
                                    <select name="loaiQuyen" class="form-control" id="">
                                        <option value="Khách Hàng" {{ $sp->PHANQUYEN === 'Khách Hàng' ? 'selected' : '' }}>Khách Hàng</option>
                                        <option value="ADMIN" {{ $sp->PHANQUYEN === 'ADMIN' ? 'selected' : '' }}>ADMIN</option>
                                    </select>
                                </div>

                                <button type="submit" name="themTH" class="btn btn-info">Lưu</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    @endsection
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <!-- jQuery (for AJAX requests) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.querySelector('.btn-info').addEventListener('click', function(e) {
            e.preventDefault(); // Ngăn form submit ngay lập tức
            var form = this.closest('form');
            var formData = new FormData(form);

            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Your work has been saved",
                showConfirmButton: false,
                timer: 1500
            }).then((result) => {
                if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
                    $.ajax({
                        url: form.action,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            Swal.fire(
                                'Sửa thành công!',
                                'Thông tin đã được cập nhật.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Lỗi!',
                                'Đã xảy ra lỗi khi cập nhật thông tin.',
                                'error'
                            );
                        }
                    });
                }
            }).catch((err) => {
                console.error(err);
            });
        });
    </script>
