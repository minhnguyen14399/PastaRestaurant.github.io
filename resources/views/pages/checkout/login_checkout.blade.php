@extends('layout')
@section('content')   


    <section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tài khoản</h2>
						<?php
						use Illuminate\Support\Facades\Session;

						$message = Session::get('message');
						if ($message) {
							echo '<span class="text-alert" style="width: auto;font-size: 17px;color: #D81B60;">' . $message . '</span>';
							Session::put('message', null);
						}
						?>
						<form action="{{URL::to('/login-customer')}}" method="POST">
							{{csrf_field()}}
							<input type="text" name="email_account" placeholder="Tài khoản" />
							<input type="password" name="password_account" placeholder="Password" />
							
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng kí mới !!!</h2>
						<form action="{{URL::to('/add-customer')}}" method="POST">
                            {{csrf_field()}}
							@if ($errors->any())
							<div class="alert alert-danger">
								<strong>Lỗi!</strong> Kiểm tra lại thông tin đã nhập!.
								<br />
							</div>
							@endif
							<input type="text" name="customer_name" placeholder="Họ tên"/>
								@error('customer_name')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							<input type="email" name="customer_email" placeholder="Địa chỉ Email"/>
								@error('customer_email')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							<input type="password" name="customer_password" placeholder="Mật khẩu"/>
								@error('customer_password')
								<span class="text-danger">{{ $message }}</span>
								@enderror
                            <input type="text" name="customer_phone" placeholder="Số điện thoại"/>
								@error('customer_phone')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

@endsection