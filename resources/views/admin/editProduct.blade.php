@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Cập nhật loại sản phẩm
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
                @foreach($editloaiSP as $key)
                <div class="position-center">
                    <form role="form" action=" {{ URL::to('/updateCategoryProduct'.$key->ID) }}" method="post" >
                        {{ csrf_field() }}              
                        <div class="form-group">
                          <label for="exampleInputPassword1">Mã Loại</label>
                          <input type="text" name = "maLoai" class="form-control" id="exampleInputPassword1" value="{{ $key->MALOAI }}" placeholder="Password">
                      </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên loại sản phẩm</label>
                            <input style="width:" type="text" name="loaiSP" value="{{ $key->TENLOAI }}" class="form-control" id="exampleInputEmail1">
                        </div>
                        <button type="submit" name="capnhatSP" class="btn btn-info">Cập nhật loại sản phẩm</button>  
                    
                    </form>
                    
                </div>
                @endforeach
            </div>
        </section>
    </div>
    @endsection