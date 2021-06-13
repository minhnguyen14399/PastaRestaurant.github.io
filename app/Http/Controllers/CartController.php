<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Banner;
// session_start();
class CartController extends Controller
{
    /// CART AJAX
    public function gio_hang()
    {
        $banner = Banner::where('banner_status', '0')->orderby('banner_id','DESC')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        return view('pages.cart.cart_ajax')->with('category', $cate_product)->with('banner',$banner);
    }
    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart'); // null
        if ($cart !== null) {
            $check = 0;
            foreach ($cart as $key => $val)
                if ($val['product_id'] == $data['cart_product_id']) {
                    if(($val['product_qty'] + $data['cart_product_qty'])< $data['cart_product_quantity']){
                        $check = 1;
                        $cart[$key] = array(
                            'session_id' => $val['session_id'],
                            'product_name' => $val['product_name'],
                            'product_id' => $val['product_id'],
                            'product_image' => $val['product_image'],
                            'product_qty' => $val['product_qty'] + $data['cart_product_qty'],
                            'product_price' => $val['product_price'],
                            'product_quantity' => $val['product_quantity'],
                        );
                        Session::put('cart', $cart);
                    }else{
                        dd('Thêm sản phẩm không thành công');
                    }
                }
            if ($check == 0) {
                $item_cart = [
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                    'product_quantity' => $data['cart_product_quantity'],
                ];
                array_push($cart, $item_cart);
                Session::put('cart', $cart);
            }
        } else {
            $cart = [];
            $item_cart = [
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                'product_quantity' => $data['cart_product_quantity'],
            ];
            array_push($cart, $item_cart);
            Session::put('cart', $cart);
        }
        Session::save('cart', $cart);
    }
    public function del_product($session_id){
        $cart = Session::get('cart');
        if($cart !== null){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');
        }else{
            return redirect()->back()->with('message','Xóa sản phẩm không thành công');
        }
        
    }
    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart !== null){
            $messege = '';
            foreach($data['cart_qty'] as $key => $qty){
                $i=0;
                foreach($cart as $session => $val){
                    $i++;
                    if($val['session_id'] == $key && $qty <= $cart[$session]['product_quantity']){
                        $cart[$session]['product_qty'] = $qty;
                        $messege.='<p style="color:blue">'.$i.') Cập nhật số lượng: "'.$cart[$session]['product_name'].'" thành công</p>';
                    }elseif($val['session_id'] == $key && $qty > $cart[$session]['product_quantity']){
                        $messege.='<p style="color:red">'.$i.') Cập nhật số lượng: "'.$cart[$session]['product_name'].'" thất bại. Phải nhỏ hơn '.$cart[$session]['product_quantity'].'</p>';
                    }
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message',$messege);
        }else{
            return redirect()->back()->with('message','Cập nhật số lượng không thành công');
        }
    }
    public function del_all_product(){
        $cart = Session::get('cart');
        if($cart !== null){
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa giỏ hàng thành công');
        }else{
            return redirect()->back()->with('message','Xóa giỏ hàng không thành công');
        }
    }
    /// CART - Shopping cart 5.8
    public function save_cart(Request $request)
    {

        // $productId = $request->productid_hidden;
        // $quantity = $request->qty;
        // $product_info = DB::table('tbl_product')->where('product_id', $productId)->first();

        // $data['id'] = $product_info->product_id;
        // $data['qty'] = $quantity;
        // $data['name'] = $product_info->product_name;
        // $data['price'] = $product_info->product_price;
        // $data['weight'] = '0';
        // $data['options']['image'] = $product_info->product_image;
        // Cart::add($data);
        // return redirect()->back();
        Cart::destroy();
    }
    public function show_cart()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();

        return view('pages.cart.show_cart')->with('category', $cate_product);
    }
    public function delete_to_cart($rowId)
    {
        Cart::update($rowId, 0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');
    }

    //// Coupon
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon > 0){
                $session_coupon = Session::get('coupon');
                if($session_coupon !== null){
                    $check = 0;
                    if($check == 0){
                        $cou = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }
        }else{
            return redirect()->back()->with('message','Mã giảm giá không tồn tại');
        }
    }

}
