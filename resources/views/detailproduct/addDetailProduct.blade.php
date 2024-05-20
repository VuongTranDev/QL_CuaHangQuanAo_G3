@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Thông tin sản phẩm
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
                    <form role="form" action="{{ URL::to('/saveDetailProduct') }}" method="post" enctype="multipart/form-data "  >
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="exampleInputPassword1">Mã sản phẩm</label>
                          <input type="text" name = "maSP" class="form-control" id="exampleInputPassword1" placeholder="Password">
                      </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input style="width:" type="text" name="tenSP" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá</label>
                            <input style="width:" type="number" name="giaSP" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chất liệu</label>
                            <textarea style="resize:none" rows="4" name="chatlieuSP" class="form-control" id="" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Hình ảnh</label>
                            <input name="hinhanh" type="file" id="exampleInputFile">
                            <p class="help-block">Hình ảnh của sản phẩm.</p>
                        </div>
                        <div class="form-group">
                            <label for="tenLSP">Loại sản phẩm</label>
                            <select name="tenLSP" class="form-control" id="">
                                <option value="">Chọn loại sản phẩm </option>    
                                @foreach($product as $pr)\
                               
                                    <option value="{{ $pr->MALOAI }}">{{ $pr->TENLOAI }}</option>
                                @endforeach 
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tenNH">Thương hiệu</label>
                            <select name="tenNH" class="form-control" id="">
                                <option value="">Chọn thương hiệu</option>                           
                               @foreach($brand as $br)
                                    <option value="{{ $br->MANH }}">{{ $br->TENNH }}</option>
                                @endforeach 
                            </select>
                        </div>
                        <button type="submit" name="themTH" class="btn btn-info">Thêm sản phẩm</button>  
                    </form>
                </div>
            </div>
        </section>
    </div>
    
    @endsection