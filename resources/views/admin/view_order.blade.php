@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
            Thông tin khách hàng
            </div>  
            <div class="table-responsive">
                <?php
                    use Illuminate\Support\Facades\Session;
                    use App\Product;
                    use App\Order;
                    use Illuminate\Support\Facades\Crypt;
                    $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert" style="width: auto;font-size: 17px;color: #D81B60;">'.$message.'</span>';
                        Session::put('message',null);
                    }
                ?>
            <table class="table table-striped b-t b-light">
                <thead>
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$customer->customer_name}}</td>
                    <td>{{$customer->customer_phone}}</td>
                    <td>{{$customer->customer_email}}</td>
                    <td>
                        @if($customer->customer_status == 0)
                            <?php
                                echo 'Bình thường';
                            ?>
                        @elseif($customer->customer_status == 1)
                            <?php
                                echo 'Đã khóa';
                            ?>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <br>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
            Thông tin vận chuyển
            </div>
            
            <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                <tr>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Ghi chú</th>
                    <th>Hình thức thanh toán</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$shipping->shipping_name}}</td>
                    <td>{{$shipping->shipping_address}}</td>
                    <td>{{$shipping->shipping_phone}}</td>
                    <td>{{$shipping->shipping_note}}</td>
                    <td>
                        <?php
                            if ($shipping->shipping_method == 0) {
                                echo 'Chuyển khoản';
                            } elseif ($shipping->shipping_method == 1) {
                                echo 'Trả khi nhận hàng';
                            }
                        ?>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <br><br>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
            Liệt kê chi tiết đơn hàng
            </div>
            
            <div class="table-responsive">
                <?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert" style="width: auto;font-size: 17px;color: #D81B60;">'.$message.'</span>';
                        Session::put('message',null);
                    }
                ?>
            <table class="table table-striped b-t b-light">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng tồn</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Mã giảm giá</th>
                    <th>Tổng tiền</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $i = 0;
                    $total = 0;
                ?>
                @foreach($order_details as $key => $detail )
                <?php
                    $i++;
                    $subtotal = $detail->product_sales_quantity * $detail->product_price;
                    $total += $subtotal;
                    $ord = Order::where('order_code',$detail->order_code)->first();
                    $pro = Product::where('product_id',$detail->product_id)->first();
                    $pro_encryted = Crypt::encryptString((string)$detail->product_id);
                ?>
                <tr>
                    <td><i>{{$i}}</i></td>
                    <td><a href="{{URL::to('/material-details/'.$pro_encryted)}}">{{$detail->product_name}}</a></td>
                    <td>{{$pro->product_quantity}}</td>
                    <td>{{$detail->product_sales_quantity}}</td>
                    <td>{{number_format($detail->product_price,0,',','.')}} vnđ</td>
                    <td>{{$detail->product_coupon}}</td>
                    <td>{{number_format($subtotal,0,',','.')}} vnđ</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                        <?php
                            $total_after_coupon = 0;
                            $total_coupon = 0;
                        ?>
                        @if ($coupon_condition == 1)
                            <?php
                                $total_coupon = ($total/100)*$coupon_number;
                                $total_after_coupon = $total - ($total*$coupon_number)/100;
                                $final = $total_after_coupon + $detail->product_feeship;
                            ?>
                        @else
                            <?php
                                $total_coupon = $coupon_number;
                                $total_after_coupon = $total - $coupon_number;
                                $final = $total_after_coupon + $detail->product_feeship;
                            ?>
                        @endif
                        Tồng hóa đơn : {{number_format($total,0,',','.')}} vnđ
                        <?php 
                            echo '</br>';
                        ?>
                        Phí ship : {{number_format($detail->product_feeship,0,',','.')}} vnđ
                        <?php 
                            echo '</br>';
                        ?>
                        Giảm giá : {{number_format($total_coupon,0,',','.')}} vnđ
                        <?php 
                            echo '</br>';
                        ?>
                        <strong> Tổng thanh toán : {{number_format($final,0,',','.')}} vnđ </strong>
                    </td>
                    <td colspan="3">
                        <strong>Trạng thái đơn hàng:</strong>
                        <form role="form" action="{{URL::to('/update-status/'.$ord->order_code)}}" method="post">
                        {{ csrf_field() }}
                        @if(($ord->order_status == 1) || ($ord->order_status == 2))
                        <select name="order_status" class="form-control input-sm m-bot15 order_details">
                            <option value="{{$ord->order_status}}">
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
                            </option>
                            <option value="1">Đang chờ xác nhận</option>
                            <option value="2">Đã xác nhận</option>
                            <option value="3">Đã hoàn thành</option>
                            <option value="0">Đã hủy</option>
                        </select>
                        <button type="submit" name="update_material" class="btn btn-info">Cập nhật trạng thái</button>
                        </form>
                        @else
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
                        @endif
                    <td colspan="2">
                        </br>
                        </br>
                        @if($customer->customer_status == 0)
                        <a target="_blank" href="{{url('/print-order/'.$detail->order_code)}}" class="btn btn-success">In đơn hàng</a>
                        @else
                            Khách hàng đang trong trạng thái khóa, không thể in đơn hàng
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
            
            </div>
            
        </div>
    </div>
@endsection