@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chỉnh sửa thông tin
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
                    @foreach($admin as $key => $adm)
                    <form role="form" action="{{URL::to('/change-info/'.$adm->admin_id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Lỗi!</strong> Kiểm tra lại thông tin đã nhập!.
                            <br />
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên nhân viên</label>
                            <input type="text" name="admin_name" class="form-control" id="exampleInputEmail1" value="{{$adm->admin_name}}">
                            @error('admin_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="admin_email" class="form-control" id="exampleInputEmail1" value="{{$adm->admin_email}}">
                            @error('admin_email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password (đã mã hóa)</label>
                            <input type="text" name="admin_password" class="form-control" id="exampleInputEmail1" value="{{$adm->admin_password}}">
                            @error('admin_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" name="admin_phone" class="form-control" id="exampleInputEmail1" value="{{$adm->admin_phone}}">
                            @error('admin_phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" name="change_info" class="btn btn-success">Cập nhật thông tin</button>
                    </form>
                    @endforeach
                </div>

            </div>
        </section>

    </div>

    @endsection