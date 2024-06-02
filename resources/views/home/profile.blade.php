@extends('layouts.showProfile')

@section('renderProfile')
    <h5>Hồ sơ của tôi</h5>
    <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
    <hr>

    @foreach ($profile as $item)
        <form id="profile-form" action="{{ route('profile.updateProfile') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="ID" value="{{ $item->ID }}" hidden>

            <table class="tbl-profile">
                <tr class="w-100">
                    <td style="width: 25%;">Tên đăng nhập</td>
                    <td style="width: 100%;">{{ $item->TENTK }}</td>
                </tr>
                <tr>
                    <td>Tên</td>
                    <td>
                        <input class="form-control mb-2" type="text" name="TENKH" value="{{ $item->TENKH }}" required>
                        @error('TENKH')
                            <span class="text-danger ms-2 mt-2">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input class="form-control mb-2" type="text" name="EMAIL" value="{{ $item->EMAIL }}" required>
                        @error('EMAIL')
                            <span class="text-danger ms-2 mt-2">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td>
                        <input class="form-control mb-2" type="text" name="SODIENTHOAI" value="{{ $item->SODIENTHOAI }}"
                            required>
                        @error('SODIENTHOAI')
                            <span class="text-danger ms-2 mt-2">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
            </table>
            <div class="btn-container">
                <button type="submit" id="dialog-update-profile"
                    class="btn btn-update-profile pe-3 ps-3 pt-2 pb-2 mt-3">Cập nhật</button>
            </div>
        </form>
    @endforeach

    <script>
        const initialValues = {
            TENKH: document.querySelector('input[name="TENKH"]').value,
            EMAIL: document.querySelector('input[name="EMAIL"]').value,
            SODIENTHOAI: document.querySelector('input[name="SODIENTHOAI"]').value,
        };

        document.getElementById("profile-form").addEventListener('submit', function(event) {
            event.preventDefault();

            const currentValues = {
                TENKH: document.querySelector('input[name="TENKH"]').value,
                EMAIL: document.querySelector('input[name="EMAIL"]').value,
                SODIENTHOAI: document.querySelector('input[name="SODIENTHOAI"]').value,
            };

            let errorMessages = [];

            if (!currentValues.TENKH.trim()) {
                errorMessages.push('Tên không được để trống.');
            }
            if (!currentValues.EMAIL.trim() || !/^\S+@\S+\.\S+$/.test(currentValues.EMAIL)) {
                errorMessages.push('Email không hợp lệ.');
            }
            if (!currentValues.SODIENTHOAI.trim() || !/^\d{10}$/.test(currentValues.SODIENTHOAI)) {
                errorMessages.push('Số điện thoại không hợp lệ.');
            }

            if (errorMessages.length > 0) {
                Swal.fire({
                    icon: 'error',
                    html: errorMessages.join('<br>'),
                    showConfirmButton: true
                });
                return;
            }

            if (JSON.stringify(initialValues) === JSON.stringify(currentValues)) {
                Swal.fire({
                    icon: 'info',
                    title: 'Bạn chưa thay đổi gì cả!',
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        popup: 'custom-swal-size',
                        title: 'custom-swal-title',
                        icon: 'custom-swal-icon'
                    }
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Cập nhật thông tin thành công!',
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        popup: 'custom-swal-size',
                        title: 'custom-swal-title',
                        icon: 'custom-swal-icon'
                    }
                }).then(() => {
                    event.target.submit();
                });
            }
        });
    </script>
@endsection
