@extends('layouts.showProfile')
@section('renderProfile')
    <h5>Thông tin địa chỉ</h5>
    <p>Quản lý thông tin địa chỉ</p>
    <hr>

    <div id="address-container">
        <label for="addresses" class="mb-3">Địa chỉ hiện tại</label>
        @foreach ($profile as $item)
            <div class="form-group address-container d-flex align-items-center">
                <input type="text" class="form-control" name="address" value="{{ $item->DIACHI }}" autocomplete="off">
                <div class="dropleft" role="group">
                    <button type="button" class="btn btn-secondary dropdown-toggle-split bg-transparent border-0"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v text-dark" style="font-size: 10px"></i>
                    </button>

                    <div class="dropdown-menu">
                        <a class="dropdown-item delete-address" href="#" data-id="{{ $item->ID }}"><i
                                class="fa fa-times text-danger text me-2"></i> Xoá</a>
                        <a class="dropdown-item update-address" href="#" data-id="{{ $item->ID }}"><i
                                class="fa fa-pencil-square-o text-success text-active me-2"></i>Sửa</a>
                    </div>
                </div>
            </div>
        @endforeach
        <button class="btn mt-2" id="create-address">Thêm địa chỉ mới</button>
    </div>

    <div class="form-update-address">
        <div class="box-update-address">
            <button id="close-box-update-address">X</button>
            <form id="update-address-form" class="d-grid" action="{{ route('home.updateAddress') }}" method="POST">
                @csrf
                <input type="hidden" name="ID" id="addressIdToUpdate">
                <label for="" class="mb-3">Cập nhật địa chỉ</label>
                <div id="addresses">
                    <div class="form-group address-container d-flex align-items-center row">
                        <p for="" class="col-3 pt-2">Tỉnh/Thành phố</p>
                        <div class="col-9">
                            <select id="provinceSelect1" class="form-control" name="province">
                                <option value="">Chọn tỉnh/thành phố</option>
                                @if ($provinces)
                                    @foreach ($provinces as $code => $province)
                                        <option value="{{ $code }}">{{ $province->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group address-container d-flex align-items-center row">
                        <p for="" class="col-3 pt-2">Quận/Huyện</p>
                        <div class="col-9">
                            <select id="districtSelect1" class="form-control" name="district">
                                <option value="">Chọn quận/huyện</option>
                            </select>
                        </div>
                    </div>                  
                    <div class="form-group address-container d-flex align-items-center row">
                        <p for="" class="col-3 pt-2">Xã/Phường</p>
                        <div class="col-9">
                            <select id="wardSelect1" class="form-control" name="ward">
                                <option value="" class="col-8">Chọn xã/phường</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group address-container d-flex align-items-center row">
                        <p for="" class="col-3 pt-2">Số nhà/Thôn/Xóm/Ấp</p>
                        <div class="col-9">
                            <div class="form-group address-container d-flex align-items-center">
                                <input type="text" class="form-control" name="SoNhaUpdate" id="SoNhaUpdate" value=""
                                    placeholder="Số nhà, Thôn, Xóm, Ấp" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="provinceNameInputUpdate" name="provinceNameUpdate">
                <input type="hidden" id="districtNameInputUpdate" name="districtNameUpdate">
                <input type="hidden" id="wardNameInputUpdate" name="wardNameUpdate">
                <div class="btn-container">
                    <button type="submit" class="btn btn-add-address">Cập nhật địa chỉ</button>
                </div>
            </form>
        </div>
    </div>

    <div class="form-add-address">
        <div class="box-add-address">
            <button id="close-box-address">X</button>
            <form id="add-address-form" class="d-grid" action="{{ route('home.addAddress') }}" method="POST">
                @csrf
                <label for="" class="mb-3">Thêm địa chỉ mới</label>
                <div id="addresses">
                    <div class="form-group address-container d-flex align-items-center row">
                        <p for="" class="col-3 pt-2">Tỉnh/Thành phố</p>
                        <div class="col-9">
                            <select id="provinceSelect" class="form-control" name="province">
                                <option value="">Chọn tỉnh/thành phố</option>
                                @if ($provinces)
                                    @foreach ($provinces as $code => $province)
                                        <option value="{{ $code }}">{{ $province->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group address-container d-flex align-items-center row">
                        <p for="" class="col-3 pt-2">Quận/Huyện</p>
                        <div class="col-9">
                            <select id="districtSelect" class="form-control" name="district">
                                <option value="">Chọn quận/huyện</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group address-container d-flex align-items-center row">
                        <p for="" class="col-3 pt-2">Xã/Phường</p>
                        <div class="col-9">
                            <select id="wardSelect" class="form-control" name="ward">
                                <option value="" class="col-8">Chọn xã/phường</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group address-container d-flex align-items-center row">
                        <p for="" class="col-3 pt-2">Số nhà/Thôn/Xóm/Ấp</p>
                        <div class="col-9">
                            <div class="form-group address-container d-flex align-items-center">
                                <input type="text" class="form-control" name="SoNha" id="SoNha" value=""
                                    placeholder="Số nhà, Thôn, Xóm, Ấp" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="provinceNameInput" name="provinceName">
                <input type="hidden" id="districtNameInput" name="districtName">
                <input type="hidden" id="wardNameInput" name="wardName">
                <div class="btn-container">
                    <button type="submit" class="btn btn-add-address">Thêm Địa Chỉ</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../../js/js-address.js"></script>
    
@endsection
