@extends('layout')
@section('content')

<section id="cart_items">
	<div class="container col-sm-12 clearfix">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				<li class="active">Giỏ hàng của bạn</li>
			</ol>
		</div>
		<div class="register-req">
			<p>Đăng ký hoặc đăng nhập để thanh toán</p>
		</div>
		<?php

		use Illuminate\Support\Facades\Session;

		$session_cart = Session::get('cart');
		$session_coupon = Session::get('coupon');
		$session_fee = Session::get('fee');

		$message = Session::get('message');
		if ($message) {
			echo ' <div class="alert alert-success col-sm-10 clearfix"> 
						<span class="text-alert" style="width: auto;font-size: 17px;">' . $message . '</span>
				   		</div>';
			Session::put('message', null);
		}
		?>

		<!--/register-req-->

		<div class="shopper-informations">
			<div class="row">

				<div class="col-sm-12">
					<div class="bill-to">
						<p>Thông tin đặt hàng</p>
						<div class="form-one">
							<form method="POST">
								{{ csrf_field()}}
								<input type="text" name="shipping_email" class="shipping_email" placeholder="Email*">
								<input type="text" name="shipping_name" class="shipping_name" placeholder="Tên*">
								<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ">
								<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại">
								<textarea name="shipping_note" class="shipping_note" placeholder="Ghi chú cho đơn hàng" rows="5"></textarea>
								
								@if($session_fee !== null)
									<input type="hidden" name="order_fee" class="order_fee" value="{{$session_fee}}">
								@else
									<input type="hidden" name="order_fee" class="order_fee" value="15000">
								@endif

								@if($session_coupon !== null)
									<input type="hidden" name="order_coupon" class="order_coupon" value="{{$session_coupon['coupon_code']}}">
								@else
									<input type="hidden" name="order_coupon" class="order_coupon" value="Không có mã">
								@endif
									
								<div class="form-group">
									<label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
									<select name="payment_select" class="form-control input-sm m-bot15 payment_select">
										<option value="0">Chuyển khoản</option>
										<option value="1">Trả khi nhận hàng</option>
									</select>
								</div>
								<input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-small send_order" />
							</form>
						</div>
						<div class="form-two">
							<form role="form">
								{{ csrf_field() }}

								<div class="form-group">
									<label for="exampleInputPassword1">Chọn thành phố</label>
									<select name="city" id="city" class="form-control input-sm m-bot15 choose city">
										<option value="">----Chọn tỉnh/thành phố----</option>
										@foreach($city as $key => $ct)
										<option value="{{$ct->matp}}">{{$ct->name_city}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Chọn quận/huyện</label>
									<select name="province" id="province" class="form-control input-sm m-bot15 choose province ">
										<option value="">----Chọn quận/huyện----</option>
									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Chọn xã/phường</label>
									<select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
										<option value="">----Chọn xã/phường----</option>
									</select>
								</div>
								<input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-primary btn-small calculate_delivery" />
							</form>
							@if($session_cart !== null)
							<br/>
							<br/>
							<br/>
							<form action="{{URL::to('/check-coupon')}}" method="POST">
								{{csrf_field()}}
								<input type="text" class="form=control" name="coupon" placeholder="Nhập mã giảm giá">
								<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Thêm mã giảm giá">
							</form>
							@endif
						</div>

					</div>
				</div>

				<div class="col-sm-12">
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
											<p style="font-size: 17px;" class="cart_total_price">{{number_format($subtotal,0,',','.')}} vnđ</p>
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
										<td colspan="3">
											<li>Tổng tiền: <span>{{number_format($total,0,',','.')}} vnđ</span></li>
											@if($session_coupon !== null)
											<li>
												@if($session_coupon['coupon_condition']==1)
													Mã giảm : {{$session_coupon['coupon_number']}} %
													
													<?php
														$total_coupon = ($total*$session_coupon['coupon_number'])/100;
														$total_after_coupon = $total - $total_coupon;
													?>
												
												@elseif($session_coupon['coupon_condition']==2)
													Mã giảm : {{number_format($session_coupon['coupon_number'],0,',','.')}} vnđ
													
													<?php
														$total_coupon = $total - $session_coupon['coupon_number'];
														$total_after_coupon = $total_coupon;
													?>
												
												@endif
											</li>
											@endif

											@if($session_fee !== null)
											<li>Phí vận chuyển : <span> {{number_format($session_fee,0,',','.')}} vnđ</span>
												<a class="cart_quantity_delete" href="{{URL::to('/del-fee')}}"><i class="fa fa-times"></i></a>
												<?php
													$total_after_fee = $total + $session_fee;
												?>
											</li>
											@else
												<?php
													$fee = 15000;
												?>
											<li>Phí vận chuyển : <span> {{number_format($fee,0,',','.')}} vnđ</span>
												
												<?php
													$total_after_fee = $total + $fee;
												?>
											</li>
											@endif

											<li> Tổng thanh toán :
												<?php
													if(($session_fee !== null) && ($session_coupon == null)){
														$total_after = $total_after_fee;
														echo number_format($total_after,0,',','.').' vnđ';
													}elseif(($session_fee == null) && ($session_coupon !== null)){
														$total_after = $total_after_coupon + $fee;
														echo number_format($total_after,0,',','.').' vnđ';
													}elseif(($session_fee !== null) && ($session_coupon !== null)){
														$total_after = $total_after_coupon + $session_fee;
														echo number_format($total_after,0,',','.').' vnđ';
													}elseif(($session_fee == null) && ($session_coupon == null)){
														$total_after = $total + $fee;
														echo number_format($total_after,0,',','.').' vnđ';
													}
												?>
											</li>
										</td>
									</tr>
									@else
									<tr>
										<td colspan="5">
											<?php
											echo 'Không có sản phẩm trong giỏ hàng';
											?>
										</td>
									</tr>
									@endif

								</tbody>
							</form>
						</table>

					</div>
				</div>
			</div>
		</div>

	</div>
</section>
<!--/#cart_items-->
@endsection
