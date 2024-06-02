@extends('admin_layout')
@section('admin_content')

<div class = "container-fluid">
    <style type="text/css">
    p.title_thongke
    {
        text-align: center ;
        font-size: 20px;
        font-weight: bold ;
    }
    </style>
<div class="row">
    <p class="title_thongke">Thống kê đơn hàng theo doanh số</p>
    <form autocomplete="off">
        @csrf    
        <div class="col-md-2">
            <p>Từ ngày : <input type="text" id ="datepicker" class="form-control"></p>
            <input type="button" id ="btn" class="btn btn-primary btn-sm" value="Lọc kết quả">
        </div>
        <div class="col-md-2">
            <p>Đến ngày<input type="text" id ="datepicker2" class="form-control"></p>
        </div>
    </form>
    <div class="col-md-12">
        <div id = "chart" style="height: 250px;">
        </div>
    </div>

    <div></div>
</div>
</div>

@endsection