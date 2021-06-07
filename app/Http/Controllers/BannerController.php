<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Banner;
use Illuminate\Support\Facades\Crypt;

class BannerController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function manage_banner(){
        $this->AuthLogin();
        $all_banner = Banner::orderby('banner_id','DESC')->get();
        return view('admin.banner.list_banner')->with(compact('all_banner'));
    }
    public function add_banner(){
        $this->AuthLogin();
        return view('admin.banner.add_banner');
    }
    public function insert_banner(Request $request){
        $this->AuthLogin();
        $data = $request->all();

        $get_image = $request->file('banner_image');
        if($get_image){
            $extendsion = $get_image->getClientOriginalExtension();
            if($extendsion == 'jpg' || $extendsion == 'png')
            {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/upload/banner',$new_image);
                
                $banner = new Banner();
                $banner->banner_name = $data['banner_name'];
                $banner->banner_image = $new_image;
                $banner->banner_desc = $data['banner_desc'];
                $banner->banner_status = $data['banner_status'];
                $banner->save();
                Session::put('message','Thêm banner thành công');
                return Redirect::to('add-banner');
               
            }
            else{
                Session::put('message','Thêm banner không thành công - File ảnh không hợp lệ hoặc chưa có');
                return Redirect::to('add-banner');
            }
            
        }
    }
    public function unactive_banner($banner_id){
        $this->AuthLogin();
        DB::table('tbl_banner')->where('banner_id',$banner_id)->update(['banner_status'=>1]);
        Session::put('message','Không kích hoạt banner thành công');
        return Redirect::to('manage-banner');
    }
    public function active_banner($banner_id){
        $this->AuthLogin();
        DB::table('tbl_banner')->where('banner_id',$banner_id)->update(['banner_status'=>0]);
        Session::put('message','Kích hoạt banner thành công');
        return Redirect::to('manage-banner');
    }
    public function delete_banner($banner_id){
        $this->AuthLogin();
        $banner = Banner::where('banner_id',$banner_id)->first();
        $banner->delete();
        Session::put('message','xóa banner thành công');
        return Redirect::to('manage-banner');
    }
    public function edit_banner($banner_id){
        $this->AuthLogin();
        $banner = Banner::where('banner_id',$banner_id)->get();
        return view('admin.banner.edit_banner')->with(compact('banner'));
    }
    public function update_banner(Request $request,$banner_id){
        $this->AuthLogin();
        $data = array();
        $data['banner_name'] = $request->banner_name;
        $data['banner_desc'] = $request->banner_desc;
        $data['banner_status'] = $request->banner_status;

        $get_image = $request->file('banner_image');
        if($get_image){
            $extendsion = $get_image->getClientOriginalExtension();
            if($extendsion == 'jpg' || $extendsion == 'png')
            {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/upload/banner',$new_image);
                $data['banner_image']= $new_image;
                DB::table('tbl_banner')->where('banner_id',$banner_id)->update($data);
                Session::put('message','Cập nhật banner thành công');
                return Redirect::to('manage-banner');
            }
            else{
                Session::put('message','Cập nhât banner không thành công - File ảnh không hợp lệ');
                return Redirect::to('manage-banner');
            }
        }
        DB::table('tbl_banner')->where('banner_id',$banner_id)->update($data);
        Session::put('message','Cập nhật banner thành công');
        return Redirect::to('manage-banner');
    }
}
