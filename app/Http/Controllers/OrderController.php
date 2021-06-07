<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Feeship;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Customer;
use App\Product;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facades\PDF;

class OrderController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function print_order($checkout_code){
        $this->AuthLogin();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        $this->AuthLogin();
        $order_details = OrderDetails::where('order_code', $checkout_code)->get();
        $order = Order::where('order_code', $checkout_code)->get();
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();

        $order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();

        foreach ($order_details_product as $key => $or_deta) {
            $product_coupon = $or_deta->product_coupon;
        }
        if($product_coupon != 'Không có mã'){
        $coupon = Coupon::where('coupon_code', $product_coupon)->first();
        $coupon_condition = $coupon->coupon_condition;
        $coupon_number = $coupon->coupon_number;
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
        }

        $created = Carbon::now('Asia/Ho_Chi_Minh');

        $output = '';
        $output.='
        <style>
            body{
                font-family: DeJavu Sans;
            }
            .table-styling{
                border: 1px solid black;  
                width: 100%;
            }
            .table-kyten{
                width: 100%;
            }
            th,td {
                text-align: left;
            }
            p{
                font-size: 15px;
            }
            .td-hd{
                font-size: 15px;
            }
            .td-tt{
                font-size: 15px;
            }
            h3{
                color: blue;
            }
        </style>
        <table class="table-kyten">
                    <thead>
                        <tr>
                            <th><center><h3>MiniDeli - Pasta</h3></center></th>
                            <th><center>Ngày tạo : '.$created.'</center></th>
                        </tr>
                    </thead>
        </table>
        <h2><center>Hóa đơn thanh toán</center></h2>
        <h3>Thông tin khách hàng</h3>
        <table class="table-styling">
                    <thead>
                        <tr>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>'.$customer->customer_name.'</td>
                            <td>'.$customer->customer_phone.'</td>
                            <td>'.$customer->customer_email.'</td>
                        </tr>
                    </tbody>
        </table>
        
        <h3>Thông tin vận chuyển</h3>
        </br>
        <p><strong>Tên người nhận : </strong>'.$shipping->shipping_name.'</p>
        <p><strong>Địa chỉ : </strong>'.$shipping->shipping_address.'</p>
        <p><strong>Số điện thoại : </strong>'.$shipping->shipping_phone.'</p>
        <p><strong>Ghi chú : </strong>'.$shipping->shipping_note.'</p>
        <p><strong>Hình thức thanh toán : </strong>';
                        if ($shipping->shipping_method == 0) {
        $output.='
                            Chuyển khoản';
                        } elseif ($shipping->shipping_method == 1) {
        $output.='          Trả khi nhận hàng';
                        }
        $output.='</p>
        
        <h3>Đơn hàng</h3>
        <table class="table-styling">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Mã giảm</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $i = 0;
                    $total = 0;
                    foreach($order_details as $key => $or_de){
                    $i++;
                    $subtotal = $or_de->product_sales_quantity * $or_de->product_price;
                    $total += $subtotal;
        $output.='        
                        <tr>
                            <td class="td-ht">'.$i.'</td>
                            <td class="td-ht"> '.$or_de->product_name.'</td>
                            <td class="td-ht">'.$or_de->product_sales_quantity.'</td>
                            <td class="td-ht">'.number_format($or_de->product_price,0,',','.').' vnđ</td>
                            <td class="td-ht">'.$or_de->product_coupon.'</td>
                            <td class="td-ht">'.number_format($subtotal,0,',','.').' vnđ</td>
                        </tr>';
                    }
        $output.='      
                        <tr>';
                            
                    $total_after_coupon = 0;
                    $total_coupon = 0;
                    if ($coupon_condition == 1){
                                $total_coupon = ($total/100)*$coupon_number;
                                $total_after_coupon = $total - ($total*$coupon_number)/100;
                                $final = $total_after_coupon + $or_de->product_feeship;
                    }else{
                        $total_coupon = $coupon_number;
                        $total_after_coupon = $total - $coupon_number;
                        $final = $total_after_coupon + $or_de->product_feeship;
                    }
        $output.='                 
                            <td colspan="3"></td>
                            <td colspan="3" class="td-hd">
                            <br/>
                            Tổng hóa đơn : '.number_format($total,0,',','.').' vnđ
                            <br/>
                            Phí ship : '.number_format($or_de->product_feeship,0,',','.').' vnđ
                            <br/>
                            Giảm giá : '.number_format($total_coupon,0,',','.').' vnđ
                            <br/>
                            <strong> Tổng thanh toán : '.number_format($final,0,',','.').' vnđ </strong>
                            </td>
                        </tr>
                    </tbody>
        </table>
        <br/>
        <table class="table-kyten">
                    <thead>
                        <tr>
                            <th><br/><br/><center>Người gửi</center></th>
                            <th><center>
                            <br/><br/>
                            Người nhận</center></th>
                        </tr>
                    </thead>
        </table>
        ';
        return $output;

    }
    public function manage_order(){
        $this->AuthLogin();
        $order = Order::orderby('created_at', 'DESC')->get();
        return view('admin.manage_order')->with(compact('order'));
    }
    public function view_order($order_code){
        $this->AuthLogin();
        $order_details = OrderDetails::where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();

        foreach ($order_details as $key => $or_deta) {
            $product_coupon = $or_deta->product_coupon;
        }
        if($product_coupon != 'Không có mã'){
        $coupon = Coupon::where('coupon_code', $product_coupon)->first();
        $coupon_condition = $coupon->coupon_condition;
        $coupon_number = $coupon->coupon_number;
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
        }
        return view('admin.view_order')->with(compact('order_details', 'customer', 'shipping', 'coupon_number', 'coupon_condition'));
    }
    public function update_status(Request $request, $order_code){
        $this->AuthLogin();
        $data = array();
        $data['order_status'] = $request->order_status;
        DB::table('tbl_order')->where('order_code', $order_code)->update($data);
        $order_details = OrderDetails::where('order_code',$order_code)->get();
            foreach($order_details as $key => $detail ){
            $update_quantity = 0;
            $ord = Order::where('order_code',$detail->order_code)->first();
            $pro = Product::where('product_id',$detail->product_id)->first();
            if($ord->order_status == 3){
                $update_quantity = $pro->product_quantity - $detail->product_sales_quantity;
                $pro->product_quantity = $update_quantity;
                $pro->product_sold = $pro->product_sold + $detail->product_sales_quantity;
                $pro->save();
            }else{
                $update_quantity = $pro->product_quantity ;
            }
        }
        return redirect()->back()->with('message','Cập nhật trạng thái thành công');
    }
}
