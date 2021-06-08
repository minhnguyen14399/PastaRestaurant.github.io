<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-----SEO------>
    <base href="https://minideli-restaurant.herokuapp.com/">
	<meta name="description" content="">
	<link rel="canonical" href="https://minideli-restaurant.herokuapp.com/trang-chu" />
	<meta name="keywords" content="Pasta Restaurant,Nhà hàng Pasta,Pasta"/>
	<meta name="robots" content="INDEX,FOLLOW"/>
    <meta name="author" content="">
	<link  rel="icon" type="image/x-icon" href="" />
	<title>MiniDeli | Pasta Restaurant</title>
	<!-----SEO------->
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
	
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{URL::to('/public/frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<?php
		use Illuminate\Support\Facades\Session;
	?>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +84 342 550 714</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> minideli@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="{{URL::to('/public/frontend/images/logo.png')}}" alt="" /></a>
						</div>
						
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
								<?php
									$customer_id = Session::get('customer_id');
									$shipping_id = Session::get('shipping_id');
									if($customer_id != null && $shipping_id == null){
								?>
									<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
								}elseif($customer_id != null && $shipping_id != null){
								?>
									<li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
								}else{
								?>
									<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
								}
								?>
								<li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								<?php
									
									$customer_id = Session::get('customer_id');
									if($customer_id != null){
								?>
									<li><a href="{{URL::to('/show-order/'.$customer_id)}}"><i class="fa fa-archive"></i> Đơn hàng</a></li>
									<li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
								<?php
								}else{
								?>
									<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
								<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
								<li><a href="{{URL::to('/product-view')}}">Sản phẩm</a></li> 
								<li><a href="{{URL::to('/gio-hang')}}">Giỏ hàng</a></li>
								<li class="dropdown"><a href="{{URL::to('/chinh-sach')}}">Chính sách<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu">
										<li><a href="{{URL::to('/huong-dan-dat-hang')}}">Hướng dẫn đặt hàng</a></li>
										<li><a href="{{URL::to('/chinh-sach')}}">Chính sách & Qui định chung</a></li>
									</ul>
								</li> 
								<li class="dropdown"><a href="{{URL::to('/thong-tin')}}">Liên hệ<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu">
										<li><a href="{{URL::to('/thong-tin')}}">Thông tin</a></li>
										<li><a href="{{URL::to('/chi-nhanh')}}">Chi Nhánh</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<form action="{{URL::to('/tim-kiem')}}" method="POST">
						{{csrf_field()}}
						<div class="search_box pull-right">
							<input type="text" name="keywords_submit" placeholder="Tìm kiếm"/>
							<button type="submit" style="height:34px; width:34px; margin-top:0px;" name="search_items" class="glyphicon glyphicon-search">
						</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
						<?php
							$i = 0;
						?>
						@foreach($banner as $key => $ban)
						<?php
							$i++;
						?>
							<div class="item {{ $i ==1 ? 'active' : ''}}">
								<div class="col-sm-6 clearfix">
									<h1><span>MiniDeli</span>-Pasta</h1>
									<h2>{{ $ban->banner_name }}</h2>
									<p>{{ $ban->banner_desc }}</p>
									<button type="button" class="btn btn-default get">Đặt hàng ngay</button>
								</div>
								<div class="col-sm-6">
									<img alt="Quảng cáo" src="https://minideli-restaurant.herokuapp.com/public/upload/banner/{{$ban->banner_image}}" class="img img-responsive" alt="" />
									
								</div>
							</div>
						@endforeach
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar" >
						<h2>Danh mục sản phẩm</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach($category as $key => $cate)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">
									{{$cate->category_name}}</a></h4>
								</div>
							</div>
							@endforeach
						</div><!--/category-products-->
					
						<!-- <div class="brands_products">
							<h2>Thương hiệu</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
								</ul>
							</div>
						</div> -->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="{{URL::to('/public/frontend/images/shipping.jpg')}}" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					
					@yield('content')
					
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer">
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Dịch vụ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Trợ giúp</a></li>
								<li><a href="#">Liên hệ</a></li>
								<li><a href="#">Hướng dẫn</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Danh mục </h2>
							<ul class="nav nav-pills nav-stacked">
								@foreach($category as $key => $cate)
								<li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></li>
								@endforeach
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Các chính sách</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Nhân viên</a></li>
								<li><a href="#">Khách hàng</a></li>
								<li><a href="#">Chất lượng</a></li>
								<li><a href="#">An toàn</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Về Chúng tôi</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Nhà hàng Pasta</a></li>
								<li><a href="#">Chi nhánh</a></li>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2021 MiniDeli-Pasta Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Minh Nguyễn</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script> -->
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
	<script src="{{asset('public/frontend/js/sweetalert.js')}}"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : "{{url('/select-delivery-home')}}",
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        });
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.send_order').click(function(){
			swal({
				title: "Xác nhận đặt hàng",
				text: "Đơn hàng sẽ được đặt, bạn có muốn thực hiện không ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-success",
				confirmButtonText: "Mua hàng",
				cancelButtonText: "Suy nghĩ thêm",
				closeOnConfirm: false,
				closeOnCancel: false
				},
				function(isConfirm) {
				if (isConfirm) {
					var shipping_email = $('.shipping_email').val();
					var shipping_name = $('.shipping_name').val();
					var shipping_address = $('.shipping_address').val();
					var shipping_phone = $('.shipping_phone').val();
					var shipping_note = $('.shipping_note').val();
					var shipping_method = $('.payment_select').val();
					var order_fee = $('.order_fee').val();
					var order_coupon = $('.order_coupon').val();
					var _token = $('input[name="_token"]').val();
					$.ajax({
						url: "{{URL::to('/confirm-order')}}",
						method: 'POST',
						data:{
							shipping_email:shipping_email,
							shipping_name:shipping_name,
							shipping_address:shipping_address,
							shipping_phone:shipping_phone,
							shipping_note:shipping_note,
							shipping_method:shipping_method,
							order_fee:order_fee,
							order_coupon:order_coupon,
							_token:_token},
						success:function(){
							swal("Hoàn tất!", "Đơn hàng của bạn đã được đặt thành công!", "success");
						},
					});
					window.setTimeout(function(){
						location.reload();
					},3000)
				} else {
					swal("Thật buồn!", "Đơn hàng của bạn đã không được đặt", "error");
				}
			});
		})
    });
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.add-to-cart').click(function(){
			var id = $(this).data('id_product');
			var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
			var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
			var _token = $('input[name="_token"]').val();
			if( parseInt(cart_product_qty) > parseInt(cart_product_quantity)){
				alert('Không còn đủ sản phẩm để cung cấp, hãy đặt ít hơn!');
			}else{
				$.ajax({
					url: "{{URL::to('/add-cart-ajax')}}",
					method: 'POST',
					data:{
						cart_product_id:cart_product_id,
						cart_product_name:cart_product_name,
						cart_product_image:cart_product_image,
						cart_product_price:cart_product_price,
						cart_product_quantity:cart_product_quantity,
						cart_product_qty:cart_product_qty,
						_token:_token},
					success:function(data){
						swal({
							title: "Đã thêm sản phẩm vào giỏ hàng",
							text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
							showCancelButton: true,
							cancelButtonText: "Xem tiếp",
							confirmButtonClass: "btn-success",
							confirmButtonText: "Đi đến giỏ hàng",
							closeOnConfirm: false
							},
							function(){
								window.location.href = "{{URL::to('/gio-hang')}}";
						});
					},
				});
			}
		})
    });
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.calculate_delivery').click(function(){
			var matp = $('.city').val();
			var maqh = $('.province').val();
			var xaid = $('.wards').val();
			var _token = $('input[name="_token"]').val();
			if( matp == '' && maqh == '' && xaid ==''){
				alert('Làm ơn chọn thông tin địa chỉ để tính phí vận chuyển');
			}else{
				$.ajax({
                url : "{{url('/calculate-fee')}}",
                method: 'POST',
                data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
               		success:function(){
                 	  location.reload();     
                	}
            	});
			}
		});
	});
	</script>
</body>
</html>
