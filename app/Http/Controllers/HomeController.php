<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\Paginator;
use App\Product;
use App\Banner;
use App\Order;
// session_start();

class HomeController extends Controller
{
    public function index()
    {
        $banner = Banner::where('banner_status', '0')->orderby('banner_id','DESC')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $all_product = DB::table('tbl_product')->where('product_status', '0')->orderby('product_id', 'desc')->limit(6)->get();

        return view('pages.home')->with('category', $cate_product)->with('all_product', $all_product)->with('banner',$banner);
    }
    public function login()
    {
        return view('admin_login');
    }
    public function search(Request $request)
    {
        $banner = Banner::where('banner_status', '0')->orderby('banner_id','DESC')->take(4)->get();
        $keywords = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();

        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keywords . '%')->get();

        return view('pages.product.search')->with('category', $cate_product)->with('search_product', $search_product)->with('banner',$banner);
    }
    public function send_mail()
    {
        $to_name = "MiniDeli Pasta Restaurant";
        $to_email = "minhnguyenbester1999@gmail.com";

        $data = array("name" => "Mail từ tài khoản khách hàng", "body" => "Mail gửi về vấn đề đặt hàng");
        Mail::send('pages.send_mail', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email)->subject('Test thử mail gửi Google');
            $message->from($to_email, $to_name);
        });
        return redirect('/trang-chu');
    }
    public function huong_dan()
    {
        return view('pages.huongdan');
    }
    public function chinh_sach()
    {
        return view('pages.chinhsach');
    }
    public function thong_tin()
    {
        return view('pages.thongtin');
    }
    public function chi_nhanh()
    {
        return view('pages.chinhanh');
    }
    public function product_view()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $all_product = Product::paginate(6);
        return view('pages.product')->with('category', $cate_product)->with('all_product', $all_product);
    }
    public function show_order($customer_id){
        $banner = Banner::where('banner_status', '0')->orderby('banner_id','DESC')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $order = Order::where('customer_id',$customer_id)->orderby('created_at','DESC')->get();
        return view('pages.show_order')->with('order',$order)->with('category', $cate_product)->with('banner',$banner);
    }
    public function del_order(Request $request,$order_code){
        $order = Order::where('order_code',$order_code)->first();
        $order->order_status = 0;
        $order->save();
        return redirect()->back()->with('message','Hủy đơn hàng thành công');
    }
}
