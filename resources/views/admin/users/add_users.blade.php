@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm nhân viên
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
                    @foreach($add_roles as $key => $adm)
                    <form role="form" action="{{URL::to('/save-roles/'.$adm->admin_id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Lỗi!</strong> Kiểm tra lại thông tin đã nhập!.
                            <br />
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <p>{{$adm->admin_name}}</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <p>{{$adm->admin_email}}</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <p>{{$adm->admin_phone}}</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chức vụ</label>
                            <select name="admin_role" class="form-control input-sm m-bot15">
                                @if ($adm->admin_role == 2)
                                    <option value="2">Quản lý</option>
                                @elseif ($adm->admin_role == 3)
                                    <option value="3">Nhân viên bán hàng</option>
                                @elseif ($adm->admin_role == 4)
                                    <option value="4">Nhân viên bếp</option>
                                @endif
                                
                                @foreach($ck_roles as $key => $role)
                                <option value="{{$role->roles_id}}">{{$role->roles_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" name="add_roles" class="btn btn-success">Cập nhật chức vụ</button>
                    </form>
                    @endforeach
                </div>

            </div>
        </section>

    </div>

    @endsection
