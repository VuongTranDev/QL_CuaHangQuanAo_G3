@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Cập nhật thương hiệu
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
                @foreach($editTH as $key)
                <div class="position-center">
                    <form role="form" action=" {{ URL::to('/updateBrand'.$key->ID) }}" method="post" >
                        {{ csrf_field() }}              
                        <div class="form-group">
                          <label for="exampleInputPassword1">Mã thương hiệu</label>
                          <input type="text" name = "maTH" class="form-control" id="exampleInputPassword1" value="{{ $key->MANH }}" placeholder="Password">
                      </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input style="width:" type="text" name="tenTH" value="{{ $key->TENNH }}" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                          <label for="quocgia">Quốc gia</label>
                          <select name="tenQG" class="form-control" id="quocgia">
                              <option value="">Chọn quốc gia</option>                           
                              @if(isset($countries) && !empty($countries))
                              @foreach($countries as $country)
                              <option value="{{ $country['country'] }}">{{ $country['country'] }}</option>
                              @endforeach
                          @else
                              <li>Không có dữ liệu quốc gia</li>
                          @endif
                          </select>
                      </div>
                        <button type="submit" name="capnhatSP" class="btn btn-info">Cập nhật thương hiệu</button>  
                    
                    </form>
                    
                </div>
                @endforeach
            </div>
        </section>
    </div>
    @endsection