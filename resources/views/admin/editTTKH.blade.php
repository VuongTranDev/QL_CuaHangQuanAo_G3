@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Thông tin khách hàng
            </header>
            <div class="panel-body">
                <div class="position-center">
                    @foreach($data as $sp)
                    <form role="form" action="{{ URL::to('/updateTTKH'.$sp->MAUSER) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                       
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên khách hàng</label>
                            <input type="text" name="tenKH" class="form-control" value="{{ $sp->TENKH }}" id="">
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
