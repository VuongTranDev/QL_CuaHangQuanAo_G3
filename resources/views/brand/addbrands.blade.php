@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Thông tin nhãn hàng
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
                    <form role="form" action="{{ URL::to('/saveBrand') }}" method="post" >
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="exampleInputPassword1">Mã thương hiệu</label>
                          <input type="text" name = "maTH" class="form-control" id="exampleInputPassword1" placeholder="Password">
                      </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input style="width:" type="text" name="tenTH" class="form-control" id="exampleInputEmail1">
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
                        <button type="submit" name="themTH" class="btn btn-info">Thêm thương hiệu</button>  
                    </form>
                    
                </div>
            </div>
        </section>
    </div>
     <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            Thông tin thương hiệu của cửa hàng
          </div>
          <div class="row w3-res-tb">
            <div class="col-sm-4">
            </div>
            
          </div>
          <div class="table-responsive">
            <table class="table table-striped b-t b-light">
              <thead>
                <tr>
                  
                  <th>Mã thương hiệu</th>
                  <th>Tên thương hiệu</th>
                  <th>Quốc gia</th>
                  <th>Số lượng sản phẩm</th>
                  <th style="width:30px;"></th>
                </tr>
              </thead>
              <tbody>   
                @foreach ($allsp as $sp)
                <tr> 
                  <td>{{ $sp->MANH }} </td>
                  <td>{{ $sp->TENNH }}</td>
                  <td>{{ $sp->QUOCGIA }}</td>
                  <td>{{ $sp->SOLUONG }}</td>
                  <td>
                    <a  href="{{ URL::to('editBrand/'.$sp->ID) }}" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                    <a onclick="return confirm('Bạn chắc chắn xoá nó chứ ?')" href="{{ URL::to('deleteBrand/'.$sp->ID) }}" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                  </td>
                </tr>
              @endforeach 
              </tbody>
            </table>
          </div>
        </div>
      </div>       
    
</div>
    
    @endsection