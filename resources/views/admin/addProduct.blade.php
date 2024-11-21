@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Thêm loại sản phẩm
            </header>
            <?php 
              $message = Session::get('message') ;
              if($message)
                {
                  echo "<span style='color: red;margin-left:30px; font-weight: bold;'>$message</span>";
                  Session::put('message',null); 
                }
              ?>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ URL::to('/saveCategoryProduct') }}" method="post" >
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="exampleInputPassword1">Mã Loại</label>
                          <input type="text" name = "maLoai" class="form-control" id="exampleInputPassword1" placeholder="Password">
                      </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên loại sản phẩm</label>
                            <input style="width:" type="text" name="loaiSP" class="form-control" id="exampleInputEmail1">
                        </div>
                        <button type="submit" name="themSP" class="btn btn-info">Thêm sản phẩm</button>  
                    </form>
                    
                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            Thông tin loại sản phẩm của cửa hàng
          </div>
          <div class="row w3-res-tb">
            <div class="col-sm-4">
            </div>
            
          </div>
          <div class="table-responsive">
            <table class="table table-striped b-t b-light">
              <thead>
                <tr>
                  
                  <th>Mã Loại</th>
                  <th>Tên loại</th>
                  <th>Số lượng sản phẩm</th>
                  <th style="width:30px;"></th>
                </tr>
              </thead>
              <tbody>
               @foreach ($allsp as $sp)
                <tr> 
                  <td>{{ $sp->MALOAI }} </td>
                  <td>{{ $sp->TENLOAI }}</td>
                  <td>{{ $sp->SOLUONG }}</td>
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
            </div>
          </footer>
        </div>
      </div>      
</div>
@endsection