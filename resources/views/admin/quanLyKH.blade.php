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
                  <th style="width:30px;"></th>
                </tr>
              </thead>
              <tbody>
               @foreach ($data as $sp)
                <tr> 
                  <td> <a href="{{url::to('ThongTinKH/').$sp->iD}}"></a>{{ $sp->TENKH }} </td>
                  <td>{{ $sp->DIACHI }}</td>
                  <td>{{ $sp->SODIENTHOAI }}</td>
                  <td>
                    <a  href="{{ URL::to('editCategoryProduct/'.$sp->ID) }}" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                    <a onclick="return confirm('Bạn chắc chắn xoá nó chứ ?')" href="{{ URL::to('deleteCategoryProduct/'.$sp->ID) }}" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <footer class="panel-footer">
            <div class="row">
              {{-- <div class="col-sm-7 text-right text-center-xs">                
                <ul class="pagination pagination-sm m-t-none m-b-none">
                  <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                  <li><a href="">1</a></li>
                  <li><a href="">2</a></li>
                  <li><a href="">3</a></li>
                  <li><a href="">4</a></li>
                  <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                </ul>
              </div> --}}
            </div>
          </footer>
        </div>
      </div>      
</div>
    
    @endsection