@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-14">
        <section class="panel">
            <header class="panel-heading">
                Phản hồi đánh giá
            </header>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                  <thead>
                    <tr>
                      <th>Tình trạng</th>
                      <th>Người gửi</th>
                      <th>Tên sản phẩm</th>
                      <th style="white-space: nowrap;">Nội dung</th>
                      <th>Số sao</th>
                      <th style="width:30px;"></th>
                    </tr>
                  </thead>
                  <tbody>   
                    @foreach ($data as $sp)
                    <tr>    
                        <td>
                            @if($sp->TINHTRANG == 0)
                            <input type="button" class="btn btn-primary btn-xs comment_status_btn" data-id="{{ $sp->ID }}"  value="Duyệt">
                            @else
                            <input type="button" class="btn btn-danger btn-xs comment_status_btn" data-id="{{ $sp->ID }}" value="Bỏ duyệt">
                            @endif
                        </td>
                        <td>{{ $sp->TENKH }}</td>
                        <td>{{ $sp->TENSANPHAM }}</td>
                        <td style="white-space: nowrap;">{{ $sp->NOIDUNG }}
                            @if($sp->TINHTRANG == 1)
                            @php $replyCount = 0; @endphp <!-- Khởi tạo biến đếm -->
                            @foreach($data1 as $sp1)
                                @if($sp->MADANHGIA == $sp1->MADANHGIA)
                                    @php $replyCount++; @endphp <!-- Tăng biến đếm nếu có phản hồi -->
                                    <textarea class="form-control " rows="3">{{$sp1->NOIDUNG}}</textarea>
                                @endif
                            @endforeach 
                            @if($replyCount == 0) <!-- Hiển thị khung textarea nếu không có phản hồi -->
                            <textarea class="form-control reply_comment" rows="3"></textarea>
                            <button class="btn btn-primary-default btn-xs btn-reply-comment" data-id="{{ $sp->ID }}" data-madg="{{ $sp->MADANHGIA }}">Trả lời</button>
                            @endif
                            @endif
                        </td>
                        <td>{{ $sp->SOSAO }}</td>
                        <td>
                            <a href="" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <a onclick="return confirm('Bạn chắc chắn xoá nó chứ?')" href="" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
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
