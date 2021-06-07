@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê Nhân viên
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
                        <th>STT</th>
                        <th>Tên nhân viên</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Chức vụ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nhanvien as $key => $user)
                    <?php
                    $i++;
                    ?>
                    <tr>
                        <td><label>{{ $i }}</label></td>
                        <td>{{ $user->admin_name }}</td>
                        <td>{{ $user->admin_email }}</td>
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
                            <a class="btn btn-info" href="{{URL::to('/add-roles/'.$user->admin_id)}}">Cấp quyền</a>
                            <a class="btn btn-success" href="{{URL::to('/del-roles/'.$user->admin_id)}}">Hủy quyền</a>
                            <a onclick="return confirm('Bạn có chắc muốn xóa mã này không?')" class="btn btn-danger" href="{{URL::to('/del-user/'.$user->admin_id)}}">Xóa nhân viên</a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"> <!-- IMPORT DATA -->
                        <form action="{{url('import-user')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" accept=".xlsx"><br>
                            <input type="submit" value="Nhập danh sách Nhân viên" name="import_csv" class="btn btn-warning">
                        </form>
                        </td>
                        <td colspan="4"> <!-- EXPORT DATA -->
                        <form action="{{url('export-user')}}" method="POST">
                            @csrf
                            <input type="submit" value="Xuất danh sách Nhân viên" name="export_csv" class="btn btn-success">
                        </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection