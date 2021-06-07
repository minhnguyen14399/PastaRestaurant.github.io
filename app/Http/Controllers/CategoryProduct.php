<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Exports\ExcelExports;
use App\Imports\ExcelImports;
use Maatwebsite\Excel\Facades\Excel;
use App\Category;
use App\Banner;
// session_start();
class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->AuthLogin();
        
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
    }
    public function save_category_product(CategoryRequest $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }
    public function active_category_product($cate_encrypted){
        $cate_decrypted = Crypt::decryptString($cate_encrypted);
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$cate_decrypted)->update(['category_status'=>1]);
        Session::put('message','Không kích hoạt danh mục tài khoản thành công');
        return Redirect::to('all-category-product');
    }
    public function unactive_category_product($cate_encrypted){
        $cate_decrypted = Crypt::decryptString($cate_encrypted);
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$cate_decrypted)->update(['category_status'=>0]);
        Session::put('message','Kích hoạt danh mục tài khoản thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($cate_encrypted){
        $cate_decrypted = Crypt::decryptString($cate_encrypted);
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$cate_decrypted)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }
    public function update_category_product(CategoryRequest $request,$cate_encrypted){
        $cate_decrypted = Crypt::decryptString($cate_encrypted);
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;

        DB::table('tbl_category_product')->where('category_id',$cate_decrypted)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm  thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($cate_encrypted){
        $cate_decrypted = Crypt::decryptString($cate_encrypted);
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$cate_decrypted)->delete();
        Session::put('message','Xóa danh mục sản phẩm  thành công');
        return Redirect::to('all-category-product');  
    }
    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return back();

    }
    public function export_csv(){
        $this->AuthLogin();
        return Excel::download(new ExcelExports , 'Category_product.xlsx');
    }
    
    //End function admin pages

    public function show_category_home($category_id){
        $banner = Banner::where('banner_status', '0')->orderby('banner_id','DESC')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();

        $category_by_id = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_product.category_id',$category_id)->get();

        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
        return view('pages.category.show_category')->with('category',$cate_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('banner',$banner);
    }
}
