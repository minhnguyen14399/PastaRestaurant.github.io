<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Exports\ExportsProduct;
use App\Imports\ImportsProduct;
use Maatwebsite\Excel\Facades\Excel;
use App\Banner;
// session_start();
class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    
    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->where('category_status',0)->get();
        
        return view('admin.add_product')->with('cate_product',$cate_product);
    }
    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);
    }
    public function save_product(ProductRequest $request){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_sold'] = 0;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['product_image'] = $request->product_image;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');
        if($get_image != null){
            if($get_image){
                $extendsion = $get_image->getClientOriginalExtension();
                if($extendsion == 'jpg' || $extendsion == 'png')
                {
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/upload/product',$new_image);
                    $data['product_image']= $new_image;
                    DB::table('tbl_product')->insert($data);
                    Session::put('message','Thêm sản phẩm thành công');
                    return Redirect::to('add-product');

                }
                else{
                    Session::put('message','Thêm sản phẩm không thành công - File ảnh không hợp lệ');
                    return Redirect::to('add-product');
                }
            }
        }else{
            Session::put('message','Chưa có ảnh');
            return Redirect::to('add-product');
        }
    }
    public function unactive_product($pro_encryted){
        $pro_decryted = Crypt::decryptString($pro_encryted);
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$pro_decryted)->update(['product_status'=>1]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function active_product($pro_encryted){
        $pro_decryted = Crypt::decryptString($pro_encryted);
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$pro_decryted)->update(['product_status'=>0]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($pro_encryted){
        $pro_decryted = Crypt::decryptString($pro_encryted);
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id',$pro_decryted)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }
    public function update_product(ProductRequest $request,$pro_encryted){
        $pro_decryted = Crypt::decryptString($pro_encryted);
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');
        if($get_image){
            $extendsion = $get_image->getClientOriginalExtension();
            if($extendsion == 'jpg' || $extendsion == 'png')
            {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/upload/product',$new_image);
                $data['product_image']= $new_image;
                DB::table('tbl_product')->where('product_id',$pro_decryted)->update($data);
                Session::put('message','Cập nhật sản phẩm thành công');
                return Redirect::to('all-product');
            }
            else{
                Session::put('message','Cập nhât sản phẩm không thành công - File ảnh không hợp lệ');
                return Redirect::to('all-product');
            }
        }
        DB::table('tbl_product')->where('product_id',$pro_decryted)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function delete_product($pro_encryted){
        $pro_decryted = Crypt::decryptString($pro_encryted);
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$pro_decryted)->delete();
        Session::put('message','Xóa sản phẩm  thành công');
        return Redirect::to('all-product');  
    }
    public function import_product(Request $request){
        $this->AuthLogin();
        $path = $request->file('file')->getRealPath();
        Excel::import(new ImportsProduct, $path);
        return back();

    }
    public function export_product(){
        $this->AuthLogin();
        return Excel::download(new ExportsProduct , 'Product.xlsx');
    }

    //END ADMIN PAGE

    public function detail_product($pro_encryted){
        $banner = Banner::where('banner_status', '0')->orderby('banner_id','DESC')->take(4)->get();
        $pro_decryted = Crypt::decryptString($pro_encryted);
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();

        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->where('tbl_product.product_id',$pro_decryted)->get();
        
        foreach($details_product as $key => $value)
            $category_id = $value->category_id;

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->where('tbl_category_product.category_id',$category_id)->wherenotin('tbl_product.product_id',[$pro_decryted])->take(3)->get();

        return view('pages.product.show_detail')->with('category',$cate_product)->with('product_details',$details_product)
        ->with('relate',$related_product)->with('banner',$banner);
    }
}
