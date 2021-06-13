@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
            </header>
            <div class="panel-body">
                <?php

                use Illuminate\Support\Facades\Session;

                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert" style="width: auto;font-size: 17px;color: #D81B60;">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Lỗi!</strong> Kiểm tra lại thông tin đã nhập!.
                            <br />
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="product_name" value="{{old('product_name')}}" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                            @error('product_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" value="{{old('product_price')}}" class="form-control" id="exampleInputEmail1" placeholder="Giá sản phẩm">
                            @error('product_price')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng tồn</label>
                            <input type="text" name="product_quantity" value="{{old('product_quantity')}}" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                            @error('product_quantity')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                            @error('product_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" rows="5" value="{{old('product_desc')}}" class="form-control" name="product_desc" id="pro" placeholder="Mô tả sản phẩm"></textarea>
                            @error('product_desc')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nguyên vật liệu</label>
                            <textarea style="resize: none" rows="5" value="{{old('product_content')}}" class="form-control" name="product_content" id="pro1" placeholder="Nội dung sản phẩm"></textarea>
                            @error('product_content')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate)
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                </div>

            </div>
        </section>

    </div>

    @endsection
