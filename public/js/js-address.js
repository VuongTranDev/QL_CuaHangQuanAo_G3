$(document).ready(function() {
    $('#add-address-form').submit(function(event) {
        event.preventDefault();
        var provinceName = $('#provinceNameInput').val();
        var districtName = $('#districtNameInput').val();
        var wardName = $('#wardNameInput').val();
        var SoNha = $('#SoNha').val();

        if (!provinceName || !districtName || !wardName || !SoNha) {
            Swal.fire({
                icon: 'info',
                title: 'Vui lòng điền đầy đủ thông tin!',
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    popup: 'custom-swal-size',
                    title: 'custom-swal-title',
                    icon: 'custom-swal-icon'
                }
            });
        } else {
            $.ajax({
                type: 'POST',
                url: $('#add-address-form').attr('action'),
                data: $('#add-address-form').serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thêm địa chỉ thành công!',
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            popup: 'custom-swal-size',
                            title: 'custom-swal-title',
                            icon: 'custom-swal-icon'
                        }
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Đã xảy ra lỗi!',
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            popup: 'custom-swal-size',
                            title: 'custom-swal-title',
                            icon: 'custom-swal-icon'
                        }
                    });
                }
            });
        }
    });

    $('#update-address-form').submit(function(event) {
        event.preventDefault();
        var provinceName1 = $('#provinceNameInputUpdate').val();
        var districtName1 = $('#districtNameInputUpdate').val();
        var wardName1 = $('#wardNameInputUpdate').val();
        var SoNha1 = $('#SoNhaUpdate').val();

        if (!provinceName1 || !districtName1 || !wardName1 || !SoNha1) {
            Swal.fire({
                icon: 'info',
                title: 'Vui lòng điền đầy đủ thông tin!',
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    popup: 'custom-swal-size',
                    title: 'custom-swal-title',
                    icon: 'custom-swal-icon'
                }
            });
        } else {
            $.ajax({
                type: 'POST',
                url: $('#update-address-form').attr('action'),
                data: $('#update-address-form').serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Cập nhật địa chỉ thành công!',
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            popup: 'custom-swal-size',
                            title: 'custom-swal-title',
                            icon: 'custom-swal-icon'
                        }
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Đã xảy ra lỗi!',
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            popup: 'custom-swal-size',
                            title: 'custom-swal-title',
                            icon: 'custom-swal-icon'
                        }
                    });
                }
            });
        }
    });

    $('#provinceSelect').change(function() {
        var provinceName = $(this).children("option:selected").text();
        $('#provinceNameInput').val(provinceName);
        console.log(provinceName);
        var provinceId = $(this).val();
        if (provinceId) {
            $.ajax({
                type: "GET",
                url: "/api/districts/" + provinceId,
                success: function(res) {
                    console.log(res);
                    if (res && res.length) {
                        $("#districtSelect").empty();
                        $("#districtSelect").append(
                            '<option value="">Chọn quận/huyện</option>');
                        $.each(res, function(key, value) {
                            $("#districtSelect").append('<option value="' +
                                value.code + '">' + value.name + '</option>'
                            );
                        });
                        $("#wardSelect").empty();
                        $("#wardSelect").append(
                            '<option value="">Chọn xã/phường</option>');
                    } else {
                        $("#districtSelect").empty();
                        $("#districtSelect").append(
                            '<option value="">Không có dữ liệu</option>');
                    }
                }
            });
        } else {
            $("#districtSelect").empty();
            $("#districtSelect").append('<option value="">Chọn quận/huyện</option>');
            $("#wardSelect").empty();
            $("#wardSelect").append('<option value="">Chọn xã/phường</option>');
        }
    });

    $('#districtSelect').change(function() {
        var districtName = $(this).children("option:selected").text();
        $('#districtNameInput').val(districtName);
        console.log(districtName);
        var districtId = $(this).val();
        if (districtId) {
            $.ajax({
                type: "GET",
                url: "/api/wards/" + districtId,
                success: function(res) {
                    console.log(res);
                    if (res && res.length) {
                        $("#wardSelect").empty();
                        $("#wardSelect").append(
                            '<option value="">Chọn xã/phường</option>');
                        $.each(res, function(key, value) {
                            $("#wardSelect").append('<option value="' + value
                                .code + '">' + value.name + '</option>');
                        });
                    } else {
                        $("#wardSelect").empty();
                        $("#wardSelect").append(
                            '<option value="">Không có dữ liệu</option>');
                    }
                }
            });
        } else {
            $("#wardSelect").empty();
            $("#wardSelect").append('<option value="">Chọn xã/phường</option>');
        }
    });

    $('#wardSelect').change(function() {
        var wardName = $(this).children("option:selected").text();
        $('#wardNameInput').val(wardName);
        console.log(wardName);
    });

    $('#provinceSelect1').change(function() {
        var provinceName1 = $(this).children("option:selected").text();
        $('#provinceNameInputUpdate').val(provinceName1);
        console.log(provinceName1);
        var provinceId1 = $(this).val();
        if (provinceId1) {
            $.ajax({
                type: "GET",
                url: "/api/districts/" + provinceId1,
                success: function(res) {
                    console.log(res);
                    if (res && res.length) {
                        $("#districtSelect1").empty();
                        $("#districtSelect1").append(
                            '<option value="">Chọn quận/huyện</option>');
                        $.each(res, function(key, value) {
                            $("#districtSelect1").append('<option value="' +
                                value.code + '">' + value.name + '</option>'
                            );
                        });
                        $("#wardSelect1").empty();
                        $("#wardSelect1").append(
                            '<option value="">Chọn xã/phường</option>');
                    } else {
                        $("#districtSelect1").empty();
                        $("#districtSelect1").append(
                            '<option value="">Không có dữ liệu</option>');
                    }
                }
            });
        } else {
            $("#districtSelect1").empty();
            $("#districtSelect1").append('<option value="">Chọn quận/huyện</option>');
            $("#wardSelect1").empty();
            $("#wardSelect1").append('<option value="">Chọn xã/phường</option>');
        }
    });

    $('#districtSelect1').change(function() {
        var districtName1 = $(this).children("option:selected").text();
        $('#districtNameInputUpdate').val(districtName1);
        console.log(districtName1);
        var districtId1 = $(this).val();
        if (districtId1) {
            $.ajax({
                type: "GET",
                url: "/api/wards/" + districtId1,
                success: function(res) {
                    console.log(res);
                    if (res && res.length) {
                        $("#wardSelect1").empty();
                        $("#wardSelect1").append(
                            '<option value="">Chọn xã/phường</option>');
                        $.each(res, function(key, value) {
                            $("#wardSelect1").append('<option value="' + value
                                .code + '">' + value.name + '</option>');
                        });
                    } else {
                        $("#wardSelect1").empty();
                        $("#wardSelect1").append(
                            '<option value="">Không có dữ liệu</option>');
                    }
                }
            });
        } else {
            $("#wardSelect1").empty();
            $("#wardSelect1").append('<option value="">Chọn xã/phường</option>');
        }
    });

    $('#wardSelect1').change(function() {
        var wardName1 = $(this).children("option:selected").text();
        $('#wardNameInputUpdate').val(wardName1);
        console.log(wardName1);
    });

    $(document).ready(function() {
        $(document).on('click', '.delete-address', function(e) {
            e.preventDefault();
            var addressId = $(this).data('id');
    
            Swal.fire({
                title: 'Bạn có chắc chắn?',
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
                        url: '/deleteAddress/' + addressId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log('Response:', response);
                            if (response.success) {
                                Swal.fire(
                                    'Xóa thành công!',
                                    'Đã xoá địa chỉ thành công.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Lỗi!',
                                    'Đã xảy ra lỗi khi xóa địa chỉ.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            console.log('Error:', xhr);
                            Swal.fire(
                                'Lỗi!',
                                'Đã xảy ra lỗi khi xóa địa chỉ.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
    

});



function handleUpdateAddress() {
    var addressUpdateBtns = document.querySelectorAll('.update-address');
    var addressUpdateBox = document.querySelector('.form-update-address');
    var boxUpdateAddress = document.querySelector('.box-update-address');

    addressUpdateBtns.forEach(function(btn) {
        btn.addEventListener('click', function(event) {
            event.preventDefault();
            boxUpdateAddress.classList.add('zoom-in');
            boxUpdateAddress.classList.remove('zoom-out');
            addressUpdateBox.classList.toggle('show');
            var addressId = btn.getAttribute('data-id');
            document.getElementById('addressIdToUpdate').value = addressId;
            console.log(addressId);
        });
    });
}

function handleCreateAddress() {
    var addressBtn = document.getElementById('create-address');
    var addressBox = document.querySelector('.form-add-address');
    var boxAddAddress = document.querySelector('.box-add-address')

    addressBtn.addEventListener('click', function() {
        boxAddAddress.classList.add('zoom-in');
        boxAddAddress.classList.remove('zoom-out');
        addressBox.classList.toggle('show');
    });
}

function handleCloseAddressBox() {
    document.getElementById('close-box-address').addEventListener('click', function() {
        var addressBox = document.querySelector('.form-add-address');
        var boxAddAddress = document.querySelector('.box-add-address')
        boxAddAddress.classList.add('zoom-out');
        boxAddAddress.classList.remove('zoom-in');
        setTimeout(function() {
            addressBox.classList.remove('show');
        }, 300);
    });
}

function handleCloseUpdateAddressBox() {
    document.getElementById('close-box-update-address').addEventListener('click', function() {
        var addressUpdateBox = document.querySelector('.form-update-address');
        var boxUpdateAddress = document.querySelector('.box-update-address');
        boxUpdateAddress.classList.add('zoom-out');
        boxUpdateAddress.classList.remove('zoom-in');
        setTimeout(function() {
            addressUpdateBox.classList.remove('show');
        }, 300);
    });
}


document.addEventListener('DOMContentLoaded', function() {
    handleCreateAddress();
    handleCloseAddressBox()
    handleUpdateAddress();
    handleCloseUpdateAddressBox();
});

