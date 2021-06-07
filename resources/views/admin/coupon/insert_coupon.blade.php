@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm mã giảm giá
                        </header>
                        <div class="panel-body">
                            <?php
                                use Illuminate\Support\Facades\Session;
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert" style="width: auto;font-size: 17px;color: #D81B60;">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-coupon')}}" method="post">
                                {{ csrf_field() }}
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Lỗi!</strong> Kiểm tra lại thông tin đã nhập!.
                                    <br />
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input type="text" name="coupon_name" value="{{old('coupon_name')}}" class="form-control" id="exampleInputEmail1">
                                    @error('coupon_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã giảm giá</label>
                                    <input type="text" name="coupon_code" value="{{old('coupon_code')}}" class="form-control" id="exampleInputEmail1">
                                    @error('coupon_code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng mã</label>
                                    <input type="text" name="coupon_time" class="form-control" id="exampleInputEmail1">
                                    @error('coupon_time')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tính năng mã giảm</label>
                                    <select name="coupon_condition" class="form-control input-sm m-bot15">
                                        <option value="1">Giảm theo %</option>
                                        <option value="2">Giảm theo tiền</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nhập % hoặc số tiền giảm</label>
                                    <input type="text" name="coupon_number" class="form-control" id="exampleInputEmail1">
                                    @error('coupon_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection