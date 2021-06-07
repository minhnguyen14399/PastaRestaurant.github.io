@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê đơn hàng
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
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tình trạng đơn hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    ?>
                    @foreach($order as $key => $ord)
                    <?php
                    $i++;
                    ?>
                    <tr>
                        <td><i>{{$i}}</i></td>
                        <td>{{ $ord->order_code }}</td>
                        <td>{{ $ord->created_at }}</td>
                        <td>
                            <?php
                            if ($ord->order_status == 1) {
                                echo 'Đang chờ xác nhận';
                            } elseif ($ord->order_status == 2) {
                                echo 'Đã xác nhận';
                            } elseif ($ord->order_status == 3) {
                                echo 'Đã hoàn thành';
                            } elseif ($ord->order_status == 0) {
                                echo 'Đã hủy';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-eye text-success text-active"></i></a>
                            </br>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection