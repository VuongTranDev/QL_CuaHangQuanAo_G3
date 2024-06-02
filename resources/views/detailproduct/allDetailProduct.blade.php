@extends('admin_layout')
@section('admin_content')
<style>
  .btn-container {
    display: flex;
    justify-content: center;
}
</style>
<div class="row">
    <div class="col-lg-12">
      
        <section class="panel">
            <header class="panel-heading">
              <?php 
              $message = Session::get('message') ;
              if($message)
                {
                  echo "<span style='color: red;margin-left:30px; font-weight: bold;'>$message</span>";
                  Session::put('message',null); 
                }
              ?>
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
                        <a onclick="return confirm('Bạn chắc chắn xoá nó chứ ?')" href="{{ URL::to('deleteDetailProduct/'.$sp->ID) }}" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                      </td>
                    </tr>
                  @endforeach 
                  </tbody>
                </table>
              </div>
            
              <div class="btn-container" >
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item {{ $allsp->currentPage() == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $allsp->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $allsp->lastPage(); $i++)
                            <li class="page-item {{ $allsp->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $allsp->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ $allsp->currentPage() == $allsp->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $allsp->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
    </div>
@endsection
