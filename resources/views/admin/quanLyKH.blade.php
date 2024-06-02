@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            Quản Lý Thông Tin Khách Hàng
          </div>
          <div class="row w3-res-tb">
            <div class="col-sm-4">
            </div>  
          </div>
          <div class="table-responsive">
            <table class="table table-striped b-t b-light">
              <thead>
                <tr>
                  
                  <th>Tên KH</th>
                  <th>Địa Chỉ</th>
                  <th>Email</th>
                  <th>Số điện thoại</th>
                  <th>Quyền truy cập</th>
                  <th style="width:30px;"></th>
                </tr>
              </thead>
              <tbody>
               @foreach ($data as $sp)
                <tr> 
                  <td> <a href="#"></a>{{ $sp->TENKH }} </td>
                  <td>{{ $sp->DIACHI }}</td>
                  <td>{{ $sp->EMAIL }}</td>
                  <td>{{ $sp->SODIENTHOAI }}</td>
                  <td>{{ $sp->PHANQUYEN }}</td>
                  <td>        
                    <a  href="{{ URL::to('editTTKH/'.$sp->MAUSER)}}" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                    <a onclick="return confirm('Bạn chắc chắn xoá nó chứ ?')" href="{{ URL::to('deleteTTKH/'.$sp->MATKUSER)}}" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                  </td>
                </tr>
              @endforeach
              @foreach ($data1 as $sp)
                <tr> 
                  <td> <a href="#"></a>{{ $sp->TENKH }} </td>
                  <td>{{ $sp->DIACHI }}</td>
                  <td>{{ $sp->EMAIL }}</td>
                  <td>{{ $sp->SODIENTHOAI }}</td>
                  <td>{{ $sp->PHANQUYEN }}</td>
                  <td>
                    <a  href="{{ URL::to('editTTKH/'.$sp->MATKUSER)}}" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                    <a onclick="return confirm('Bạn chắc chắn xoá nó chứ ?')" href="{{ URL::to('deleteTTKH/'.$sp->MATKUSER)}}" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <footer class="panel-footer">
            
          </footer>
        </div>
      </div>      
</div>
    
    @endsection