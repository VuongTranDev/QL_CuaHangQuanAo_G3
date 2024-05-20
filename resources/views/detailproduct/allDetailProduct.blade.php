@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Thông tin nhãn hàng
            </header>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                  <thead>
                    <tr>
                      
                      <th>Mã sản phẩm</th>
                      <th>Tên sản phẩm</th>
                      <th>Hình ảnh </th>
                      <th>Giá</th>
                      <th style="width:30px;"></th>
                    </tr>
                  </thead>
                  <tbody>   
                    @foreach ($allsp as $sp)
                    <tr>    
                      <td>{{ $sp->MASANPHAM }} </td>
                      <td>{{ $sp->TENSANPHAM  }}</td>
                      <td><img style="width : 100px;height : 100px" src="{{ URL('images/' . $sp->HINHANH) }}"></td>
                      <td>{{ $sp->GIA }} VND</td>
                      <td>
                        <a  href="{{ URL::to('editDetailProduct/'.$sp->ID) }}" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                        <a onclick="return confirm('Bạn chắc chắn xoá nó chứ ?')" href="{{ URL::to('deleteBrand/'.$sp->ID) }}" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                      </td>
                    </tr>
                  @endforeach 
                  </tbody>
                </table>
              </div>
            
           
        </section>
    </div>
     
        
    
    
</div>
    
    @endsection