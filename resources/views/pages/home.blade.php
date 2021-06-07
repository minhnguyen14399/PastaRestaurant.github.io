@extends('layout')
@section('content')
<div class="features_items">
	<!--features_items-->
	<?php

	use Illuminate\Support\Facades\Crypt;
	?>
	<h2 class="title text-center">Sản phẩm mới nhất</h2>
	@foreach($all_product as $key => $product)
	<?php
	$pro_encrypted = Crypt::encryptString((string)$product->product_id);
	?>
	<div class="col-sm-4">
		<div class="product-image-wrapper">
			<div class="single-products">
				<div class="productinfo text-center">
					<form>
					@csrf
					<input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
					<input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
					<input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
					<input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
					<input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
					<input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
					<a href="{{URL::to('/chi-tiet-san-pham/'.$pro_encrypted)}}">
						<img src="public/upload/product/{{$product->product_image}}" height="255px" alt="" />
						<h2>{{number_format($product->product_price)}} VNĐ</h2>
						<div style="height: 50px;">
							<p>{{$product->product_name}}</p>
						</div>
					</a>
					<button type="button" class="btn btn-fefault add-to-cart" data-id_product="{{$product->product_id}}">
						Thêm giỏ hàng
					</button>
					</form>
				</div>
			</div>
			<div class="choose">
				<ul class="nav nav-pills nav-justified">
					<li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
					<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
				</ul>
			</div>
		</div>
	</div>
	@endforeach

</div>
<!--features_items-->
@endsection