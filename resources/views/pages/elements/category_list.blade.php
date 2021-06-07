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
			
			<div class="shipping text-center"><!--shipping-->
				<img src="{{URL::to('/public/frontend/images/shipping.jpg')}}" alt="" />
			</div><!--/shipping-->
		
		</div>
	</div>