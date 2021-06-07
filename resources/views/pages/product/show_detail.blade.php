@extends('layout')
@section('content')   
@foreach($product_details as $key => $product)
                   <div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('/public/upload/product/'.$product->product_image)}}" alt="" />
								
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="{{url::to('/public/frontend/images/new.jpg')}}" class="newarrival" alt="" />
								<h2>{{$product->product_name}}</h2>
								<form>
									{{ csrf_field() }}
								<span>
									<span>{{number_format($product->product_price)}} VND</span>
									<label>Số lượng:</label>
									<input type="number" min="1" value="1" max="{{$product->product_quantity}}" class="cart_product_qty_{{$product->product_id}}">
									<p>Số lượng tồn : {{$product->product_quantity}}</p>
								</span>
									<input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
									<input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
									<input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
									<input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
									<input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
									
									<button type="button" class="btn btn-fefault add-to-cart" data-id_product="{{$product->product_id}}">
										Thêm giỏ hàng
									</button>
								</form>
								<p><b>Tình trạng:</b> Còn hàng</p>
								<p><b>Điều kiện:</b> Mới</p>
								<p><b>Danh mục:</b> {{$product->category_name}}</p>
								<a href=""><img src="{{URL::to('/public/frontend/images/share.png')}}" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Thông tin nguyên vật liệu</a></li>
								
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p>&nbsp;&nbsp;&nbsp;&nbsp;{!!$product->product_desc!!}</p>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<p>&nbsp;&nbsp;&nbsp;&nbsp;{!!$product->product_content!!}</p>
								
							</div>
							
						</div>
					</div><!--/category-tab-->
@endforeach
					<?php
						use Illuminate\Support\Facades\Crypt;
					?>
                    <div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm liên quan</h2>
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
								@foreach($relate as $key => $rela)
								<?php
									$pro_encrypted = Crypt::encryptString((string)$rela->product_id);
								?>
									<a href="{{URL::to('/chi-tiet-san-pham/'.$pro_encrypted)}}">
									<div class="col-sm-4">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="../public/upload/product/{{$rela->product_image}}" height="255px" alt="" />
												<h2>{{number_format($rela->product_price)}} VNĐ</h2>
												<p>{{$rela->product_name}}</p>
												<form action="{{URL::to('/save-cart')}}" method="POST">
													{{ csrf_field() }}
													<input name="qty" type="hidden" value="1" />
													<input name="productid_hidden" type="hidden" value="{{$rela->product_id}}" />
													<button style="height:35px; width:150px;" type="submit" class="btn btn-fefault cart">
														<i class="fa fa-shopping-cart"></i>
														Add to cart
													</button>&nbsp; &nbsp; &nbsp;
												</form>
											</div>
										</div>
									</div>
									</a>	
                                @endforeach
								</div>
								<div class="item">	
								@foreach($relate as $key => $rela)
								<?php
									$pro_encrypted = Crypt::encryptString((string)$rela->product_id);
								?>
									<a href="{{URL::to('/chi-tiet-san-pham/'.$pro_encrypted)}}">
									<div class="col-sm-4">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="../public/upload/product/{{$rela->product_image}}" height="255px" alt="" />
												<h2>{{number_format($rela->product_price)}} VNĐ</h2>
												<p>{{$rela->product_name}}</p>
												<form action="{{URL::to('/save-cart')}}" method="POST">
													{{ csrf_field() }}
													<input name="qty" type="hidden" value="1" />
													<input name="productid_hidden" type="hidden" value="{{$rela->product_id}}" />
													<button style="height:35px; width:150px;" type="submit" class="btn btn-fefault cart">
														<i class="fa fa-shopping-cart"></i>
														Add to cart
													</button>&nbsp; &nbsp; &nbsp;
												</form>
											</div>
										</div>
									</div>
									</a>	
                                @endforeach
								</div>
							</div>   
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
@endsection