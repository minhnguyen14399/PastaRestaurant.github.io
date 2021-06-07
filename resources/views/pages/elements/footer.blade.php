<footer id="footer">
		<?php
			use App\Category;
			$category = Category::orderby('category_id','DESC')->get();
		?>
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