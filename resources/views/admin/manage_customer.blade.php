@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê danh sách khách hàng
        </div>

        <div class="table-responsive">
            <?php

            use Illuminate\Support\Facades\Session;

            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert" style="width: auto;font-size: 17px;color: #D81B60;">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>

                        <th>STT</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    ?>
                    @foreach($customer as $key => $cus)
                    <?php
                    $i++;
                    ?>
                    <tr>
                        <td><i>{{$i}}</i></td>
                        <td>{{ $cus->customer_name }}</td>
                        <td>{{ $cus->customer_email }}</td>
                        <td>{{ $cus->customer_phone }}</td>
                        <td><span class="text-ellipsis">
                                <?php
                                if ($cus->customer_status == 0) {
                                ?>
                                    <a href="{{URL::to('/unactive-customer',$cus->customer_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                                <?php
                                } else {
                                ?>
                                    <a href="{{URL::to('/active-customer',$cus->customer_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                                <?php
                                }
                                ?>
                        </span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection