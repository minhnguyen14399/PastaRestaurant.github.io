@extends('layout')
@section('content')

<section id="cart_items">
	<div class="container clearfix">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				<li class="active">Giỏ hàng của bạn</li>
			</ol>
		</div>
		<?php

		use Illuminate\Support\Facades\Session;

		$session_cart = Session::get('cart');
		$session_coupon = Session::get('coupon');
		$session_customer = Session::get('customer_id');
		$message = Session::get('message');
		if ($message) {
			echo ' <div class="alert alert-success col-sm-10 clearfix"> 
					<span class="text-alert" style="width: auto;font-size: 17px;">' . $message . '</span>
				   </div>';
			Session::put('message', null);
		}
		?>
		<div class="col-sm-10 clearfix">
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
				<form action="{{URL::to('/update-cart')}}" method="POST">
				{{csrf_field()}}
					<thead>
						<tr class="cart_menu">
							<td class="image col-sm-2">Hình ảnh</td>
							<td class="description col-sm-2">Tên sản phẩm</td>
							<td class="price col-sm-2">Giá sản phẩm</td>
							<td class="quantity col-sm-2">Số lượng</td>
							<td class="total col-sm-2">Thành tiền tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					@if($session_cart !== null)
						<?php
						$total = 0;
						?>
						@foreach($session_cart as $key => $cart)
						<?php
						$subtotal = $cart['product_price'] * $cart['product_qty'];
						$total += $subtotal;
						?>
						<tr>
							<td class="cart_product col-sm-2">
								<a href=""><img src="{{URL::to('/public/upload/product/'.$cart['product_image'])}}" width="70px" height="70px" alt=""></a>
							</td>
							<td class="cart_description col-sm-2">
								<h4><a style="font-size: 17px;" href="">{{$cart['product_name']}}</a></h4>
							</td>
							<td class="cart_price col-sm-2">
								<p style="font-size: 17px;">{{number_format($cart['product_price'],0,',','.')}} vnđ</p>
							</td>
							<td class="cart_quantity col-sm-2">
								<div class="cart_quantity_button">
									<input style="width: 150px;" class="cart_quantity_" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" autocomplete="off" size="2">
								</div>
							</td>
							<td class="cart_total col-sm-2">
								<p style="font-size: 17px;" class="cart_total_price">{{number_format($subtotal,0,',','.')}}vnđ</p>
							</td>
							<td class="cart_delete" style="padding-top: 30px;">
								<a class="cart_quantity_delete" href="{{URL::to('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						<tr>
							<td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out" /></td>
							<td><a class="btn btn-default check_out" href="{{URL::to('/del-all-product')}}">Xóa tất cả sản phẩm</a></td>
							@if($session_coupon !== null)
							<td><a class="btn btn-default check_out" href="{{URL::to('/unset-coupon')}}">Xóa mã giảm giá</a></td>
							@endif

							@if($session_customer !== null)
							<td><a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Đặt hàng</a></td>
							@else
							<td><a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Đặt hàng</a></td>
							@endif

							<td colspan="2">
								<li>Tổng tiền: <span>{{number_format($total,0,',','.')}} vnđ</span></li>
								@if($session_coupon !== null)
							<li>
									@if($session_coupon['coupon_condition']==1)
										Mã giảm : {{$session_coupon['coupon_number']}} %
										<p>
											@php 
											$total_coupon = ($total*$session_coupon['coupon_number'])/100;
											echo '<p><li>Tổng giảm:'.number_format($total_coupon,0,',','.').' vnđ</li></p>';
											@endphp
										</p>
										<p><li>Tổng đã giảm :{{number_format($total-$total_coupon,0,',','.')}} vnđ</li></p>
									@elseif($session_coupon['coupon_condition']==2)
										Mã giảm : {{number_format($session_coupon['coupon_number'],0,',','.')}} vnđ
										<p>
											@php 
											$total_coupon = $total - $session_coupon['coupon_number'];
											@endphp
										</p>
										<p><li>Tổng đã giảm : {{number_format($total_coupon,0,',','.')}} vnđ</li></p>
									@endif
							</li>
							@endif 
								<!-- <li>Thuế <span> 0 VNĐ</span></li>
								<li>Phí vận chuyển <span>Free</span></li>
								<li>Tiền sau giảm<span> VNĐ</span></li> -->
							</td>
						</tr>
					@else
						<tr><td colspan="5">
							<?php
								echo 'Không có sản phẩm trong giỏ hàng';
							?>
						</td></tr>
					@endif
					</tbody>
				</form>
				@if($session_cart !== null)
				<tr>
					<td>
						<form action="{{URL::to('/check-coupon')}}" method="POST">
							{{csrf_field()}}
							<input type="text" class="form=control" name="coupon" placeholder="Nhập mã giảm giá" >
							<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Thêm mã giảm giá">
						</form>
					</td>
				</tr>
				@endif
				</table>
				
			</div>
		</div>
	</div>
</section>
<!--/#cart_items-->


@endsection