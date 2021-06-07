@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Banner
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
                    <form role="form" action="{{URL::to('/insert-banner')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Lỗi!</strong> Kiểm tra lại thông tin đã nhập!.
                            <br />
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên banner</label>
                            <input type="text" name="banner_name" value="{{old('banner_name')}}" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">    
                            @error('banner_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh banner</label>
                            <input type="file" name="banner_image" value="{{old('banner_image')}}" class="form-control" id="exampleInputEmail1">
                            @error('banner_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror</div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung banner</label>
                            <textarea style="resize: none" rows="5" value="{{old('banner_desc')}}" class="form-control" name="banner_desc" placeholder="Mô tả sản phẩm"></textarea>
                            @error('banner_desc')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror</div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="banner_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị banner</option>
                                <option value="1">Ẩn banner</option>
                            </select>
                        </div>

                        <button type="submit" name="add_banner" class="btn btn-info">Thêm Banner</button>
                    </form>
                </div>

            </div>
        </section>

    </div>

    @endsection