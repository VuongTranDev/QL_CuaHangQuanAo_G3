@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Cập nhật sản phẩm
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
                @foreach($editSP as $key)
                <div class="position-center">
                 
                    <form role="form" action="{{ URL::to('/updateDetailProduct'.$key->ID) }}" method="post" >
                        {{ csrf_field() }}              
                        <div class="form-group">
                          <label for="exampleInputPassword1">Mã sản phẩm</label>
                          <input type="text" name = "maSP" class="form-control" id="exampleInputPassword1" value="{{ $key->MASANPHAM }}" placeholder="Password">
                      </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input style="width:" type="text" name="tenSP" value="{{ $key->TENSANPHAM }}" class="form-control" id="exampleInputEmail1">
                        </div>
                        {{-- <div class="form-group">
                            <i class="fa fa-plus-square plus-icon"></i>
                            <label for="exampleInputEmail1">Mô tả</label>
                            <div class="input-group-append">
                            </div>
                            @foreach($mota as $index => $pr) 
                                <div class="input-group mb-3">
                                    <input style="margin-top: 10px" type="text" name="mota[]" value="{{ $pr->MOTA }}" class="form-control" id="exampleInputEmail1">
                                    
                                    <input type="hidden" name="mota_id[]" value="{{ $pr->ID }}">
                                </div>
                            @endforeach
                            <div class="hidden-inputs" style="display:none">
                                <!-- Input mới sẽ được thêm vào đây -->
                            </div>
                        </div> --}}
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá </label>
                            <input style="width:" type="text" name="giaSP" value="{{ $key->GIA }}" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chất liệu</label>
                            <input style="width:" type="text" name="chatlieuSP" value="{{ $key->CHATLIEU  }}" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Hình ảnh</label>
                            <img src="{{ URL('images/' . $key->HINHANH) }}" alt="Hình ảnh sản phẩm" style="max-width: 100px; max-height: 100px;">
                            <input name="hinhanh"  type="file" id="exampleInputFile">
                            <p class="help-block">Hình ảnh của sản phẩm.</p>
                        </div>
                        <div class="form-group">
                            <label for="tenLSP">Loại sản phẩm</label>
                            <select name="tenLSP" class="form-control" id="">
                                <option value="">Chọn loại sản phẩm</option>
                                @foreach($product as $pr)
                                    @if($pr->MALOAI == $key->MALOAI)
                                        <option value="{{ $pr->MALOAI }}" selected>{{ $pr->TENLOAI }}</option>
                                    @else
                                        <option value="{{ $pr->MALOAI }}">{{ $pr->TENLOAI }}</option>
                                    @endif
                                @endforeach 
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tenNH">Thương hiệu</label>
                            <select name="tenNH" class="form-control" id="">
                                <option value="">Chọn thương hiệu</option>
                                @foreach($brand as $br)
                                    @if($br->MANH == $key->MANH)
                                        <option value="{{ $br->MANH }}" selected>{{ $br->TENNH }}</option>
                                    @else
                                        <option value="{{ $br->MANH }}">{{ $br->TENNH }}</option>
                                    @endif
                                @endforeach 
                            </select>
                        </div>
                        
                        <button type="submit" name="capnhatSP" class="btn btn-info">Cập nhật sản phẩm</button>  
                    
                    </form>
                    
                </div>
                @endforeach
            </div>
        </section>
    </div>
    
    @endsection