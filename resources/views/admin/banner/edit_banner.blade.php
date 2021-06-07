@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật Banner
            </header>
            <div class="panel-body">
                <?php

                use Illuminate\Support\Facades\Session;
                use Illuminate\Support\Facades\Crypt;

                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert" style="width: auto;font-size: 17px;color: #D81B60;">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <div class="position-center">
                    @foreach($banner as $key => $pro)
                    <?php
                    $encrypted = Crypt::encryptString((string)$pro->banner_id);
                    ?>
                    <form role="form" action="{{URL::to('/update-banner/'.$pro->banner_id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Lỗi!</strong> Kiểm tra lại thông tin đã nhập!.
                            <br />
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Banner</label>
                            <input type="text" name="banner_name" class="form-control" id="exampleInputEmail1" value="{{$pro->banner_name}}">
                            @error('banner_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh Banner</label>
                            <input type="file" name="banner_image" class="form-control" id="exampleInputEmail1">
                            <img src="{{URL::to('public/upload/banner/'.$pro->banner_image)}}" height="100" width="100">
                            @error('banner_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Banner</label>
                            <textarea style="resize: none" rows="5" class="form-control" name="banner_desc" id="pro2">{{$pro->banner_desc}}</textarea>
                            @error('banner_desc')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="banner_status" class="form-control input-sm m-bot15">
                                <option value="{{$pro->banner_status}}">
                                    <?php
                                    if ($pro->banner_status == 1) {
                                        echo 'Ẩn';
                                    } else {
                                        echo 'Hiển thị';
                                    }
                                    ?>
                                </option>
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" name="add_banner" class="btn btn-info">Cập nhật Banner</button>
                    </form>
                    @endforeach
                </div>

            </div>
        </section>

    </div>

    @endsection