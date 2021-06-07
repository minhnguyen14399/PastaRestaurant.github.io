@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin tài khoản
        </div>
        
        <div class="table-responsive">
            <?php

            use Illuminate\Support\Facades\Session;

            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert" style="color:red;">' . $message . '</span>';
                Session::put('message', null);
            }
            $i =0;
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên nhân viên</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Phone</th>
                        <th>Chức vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admin as $key => $user)
                    <?php
                    $i++;
                    ?>
                    <tr>
                        <td>{{ $user->admin_name }}</td>
                        <td>{{ $user->admin_email }}</td>
                        <td>{{ $user->admin_password }}</td>
                        <td>{{ $user->admin_phone }}</td>
                        <td>
                        <?php
                            if ($user->admin_role == 0) {
                            echo 'Chưa được cấp quyền';
                            } elseif ($user->admin_role == 1) {
                            echo 'Admin';
                            } elseif ($user->admin_role == 2) {
                            echo 'Quản lý';
                            } elseif ($user->admin_role == 3) {
                            echo 'Nhân viên bán hàng';
                            } elseif ($user->admin_role == 4) {
                            echo 'Nhân viên bếp';
                            }
                        ?>
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{URL::to('/edit-info/'.$user->admin_id)}}">Thay đổi thông tin</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection