
<!DOCTYPE html>
<head>
<title>Trang chủ Admin</title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="{{ asset('../css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{ asset('../css/style2.css')}}" rel='stylesheet' type='text/css' />
<link href="{{ asset('../css/style-responsive.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{ asset('../css/font.css')}}" type="text/css"/>
<link href="{{ asset('../css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<!-- calendar -->
<link rel="stylesheet" href="{{ asset('../css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{ asset('../js/jquery2.0.3.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            {{-- <input type="text" class="form-control search" placeholder=" Search"> --}}
            
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
             {{-- <img alt="" src="{{ asset('../images/2.png') }}"> --}}
             
                <span class="username">
					<?php 
						$name = Session::get('ten') ;		
						if($name)
						{	
						echo $name ;}	
					?>
				</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Thông tin</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Cài đặt</a></li>
                <li><a href="{{ URL::to('logout') }}"><i class="fa fa-key"></i> Đăng xuất</a></li>
            </ul>
        </li>
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->


<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{ URL::to('/admin_layout') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Loại sản phẩm / Thương hiệu</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{ URL::to('/addCategoryProduct') }}">Loại sản phẩm</a></li>
						<li><a href="{{ URL::to('/addbrands') }}">Thương hiệu</a></li>
                    </ul>
                </li>
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-credit-card"></i>
                        <span>Chi tiết sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{ URL::to('/addDetailProduct') }}">Thêm sản phẩm</a></li>
						<li><a href="{{ URL::to('/allDetailProduct') }}">Liệt kê sản phẩm</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ URL::to('/quanLyKH') }}">	
                        <i class="fa  fa-users"></i>
                        <span>Quản lý Khách Hàng</span>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::to('/phanHoiKH') }}">	
                        <i class="fa  fa-comments-o"></i>
                        <span>Phản Hồi Khách Hàng</span>
                    </a>
                </li>
				<li>
                    <a href="{{ URL::to('/thongKeDS') }}">	
                        <i class="fa fa-bar-chart"></i>
                        <span>Thống kê doanh thu</span>
                    </a>
                </li>
            </ul>           
		 </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		@yield('admin_content')	
	</section>
</section>
<script src="{{ asset('../js/bootstrap.js')}}"></script>
<script src="{{ asset('../js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{ asset('../js/scripts.js')}}"></script>
<script src="{{ asset('../js/jquery.slimscroll.js')}}"></script>
<script src="{{ asset('../js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javasc
    ript" src="{{ asset('../js/flot-chart/excanvas.min.js')}}"></script><![endif]-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('../js/jquery.scrollTo.js')}}"></script>
<!-- morris JavaScript -->	

<script type="text/javascript">

$(document).ready(function() {
    $('.comment_status_btn').click(function() {
        var commentId = $(this).data('id');
        var button = $(this);
        $.ajax({
            url: '{{ url("/updateComment") }}',
            method: 'POST',
            data: {
                comment_id: commentId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    if (button.val() == "Duyệt") {
                        button.val("Bỏ duyệt").removeClass("btn-primary").addClass("btn-danger");
                    } else {
                        button.val("Duyệt").removeClass("btn-danger").addClass("btn-primary");
                    }
                } else {
                    alert("Cập nhật tình trạng thất bại!");
                }
            
            },
            error: function(xhr, status, error) {
                console.error('Đã xảy ra lỗi: ' + error);
            }
        });
    });
   
});


</script>

<script>
    $(document).ready(function() {
     $('.btn-reply-comment').click(function() {
        var comment = $('.reply_comment').val();
        var commentMDG = $(this).data('madg');
        var button = $(this);
     
        $.ajax({
            url: '{{ url("/replyComment") }}',
            method: 'POST',
            data: {
                comment_dg: commentMDG,
                reply_content: comment,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    alert("Đã trả lời thành công!");
                    location.reload(); 
                   
                }
            },
            error: function(xhr, status, error) {
                alert("Trả lời thất bại!");
                console.error('Đã xảy ra lỗi: ' + error);
            }
        });
    });
}) ;
</script>
<script type="text/javascript">

	$(function(){
	   $("#datepicker").datepicker({
		   prevText: "Tháng trước",
		   nextText: "Tháng sau",
		   dateFormat: "yy-mm-dd",
		   duration: "slow"
	   });
	   $("#datepicker2").datepicker({
		   prevText: "Tháng trước",
		   nextText: "Tháng sau",
		   dateFormat: "yy-mm-dd",
		   duration: "slow"
	   });
   });
 </script>
<script>
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	</script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script>
  $( function() {
	$( "#datepicker" ).datepicker();
  } );
  </script>
  <script>
	  $( function() {
		$( "#datepicker2" ).datepicker();
	  } );
	  </script>

  <script type="text/javascript">
  $(document).ready(function() {
    $('#btn').click(function() {
        var _token = $('input[name="_token"]').val();
        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
        
        $.ajax({
            url: "{{url('/thongKeSanLuong')}}",
            method: "POST",
            dataType: "JSON",
            data: {from_date: from_date, to_date: to_date, _token: _token},
            success: function(data) {
                console.log(data);

                // Xóa biểu đồ cũ
                $('#chart').empty();

                // Khởi tạo lại biểu đồ với dữ liệu mới
                new Morris.Bar({
                    element: 'chart',
                    lineColors: ['#819C79', '#fc8710', '#FF6541'],
                    parseTime: false,
                    xkey: 'thoiGian',
                    ykeys: ['soLuong', 'tongTien'],
                    labels: ['Số Lượng', 'Tổng Tiền'],
                    data: data
                });
            }
        });
    });
});

  </script>

  <script type="text/javascript">

	 $(function(){
        $("#datepicker").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            duration: "slow"
        });
        $("#datepicker2").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            duration: "slow"
        });
    });
  </script>


 
<script>
    $(document).ready(function(){
        var count = 0; // Biến đếm số lượng input đã hiển thị

        // Xử lý sự kiện click vào dấu cộng
        $('.plus-icon').click(function(){
            count++; // Tăng biến đếm
            var newInput = '<div class="input-group mb-3">' +
                                '<input style="margin-top: 10px" type="text" name="mota[]" class="form-control" id="exampleInputEmail1">' +
                           '</div>';
            $('.hidden-inputs').append(newInput); // Thêm input mới vào trong div ẩn
            $('.hidden-inputs').show(); // Hiển thị div chứa input mới
        });
    });
</script>
</body>
</html>
