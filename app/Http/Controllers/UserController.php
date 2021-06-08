<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Roles;
use App\Admin;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;
use App\Exports\ExportsUser;
use App\Imports\ImportsUser;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function all_user()
    {
        $this->AuthLogin();
        $admin = Admin::orderBy('admin_id','DESC')->paginate(5);
        $nhanvien = $admin->whereNotin('admin_role',1);
        $nhanvien->all();
        return view('admin.users.all_users')->with(compact('admin','nhanvien'));
    }
    public function insert_user()
    {
        $this->AuthLogin();
        return view('admin.users.insert_users');
    }
    public function del_user($admin_id){
        $this->AuthLogin();
        $admin = Admin::where('admin_id',$admin_id)->first();
        $admin->delete();
        
        return redirect()->back()->with('message','Xóa nhân viên thành công');
    }
    public function del_roles($admin_id){
        $this->AuthLogin();
        $admin = Admin::where('admin_id',$admin_id)->first();
        $admin->admin_role=0;
        $admin->save();
        Session::put('message','Thu hồi quyền thành công');
        return Redirect::to('all-user');
    }
    public function add_roles($admin_id){
        $this->AuthLogin();
        $roles = Roles::orderby('roles_id')->get();
        $ck_roles = $roles->wherenotin('roles_name','admin')->all();
        $add_roles = Admin::where('admin_id',$admin_id)->get();
        $add_users = view('admin.users.add_users')->with(compact('ck_roles','add_roles'));
        return view('admin_layout')->with('admin.users.add_users',$add_users);

    }
    public function save_roles(Request $request,$admin_id){
        $this->AuthLogin();
        $data = $request->all();
        $admin = Admin::where('admin_id',$admin_id)->first();
        $admin->admin_role = $data['admin_role'];
        $admin->save();
        Session::put('message','Cấp quyền thành công');
        return Redirect::to('all-user');
    }
    public function show_info($admin_id)
    {
        $this->AuthLogin();
        $admin = Admin::where('admin_id',$admin_id)->get();
        return view('admin.users.show_info')->with(compact('admin'));
    }
    public function edit_info($admin_id)
    {
        $this->AuthLogin();
        $admin = Admin::where('admin_id',$admin_id)->get();
        return view('admin.users.edit_info')->with(compact('admin'));
    }
    public function change_info(AdminRequest $request,$admin_id){
        $this->AuthLogin();
        $data = $request->all();
        $admin = Admin::where('admin_id',$admin_id)->first();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        if($admin->admin_password == $data['admin_password']){
            $admin->admin_password = $admin->admin_password;
        }else{
        $admin->admin_password = md5($data['admin_password']);
        }
        $admin->admin_role = $admin->admin_role;
        $admin->save();
        return redirect()->back()->with('message','Cập nhật thông tin thành công');
    }
    public function save_user(AdminRequest $request){
        $this->AuthLogin();
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->admin_role = 0;
        $admin->save();
        Session::put('message','Thêm thành viên thành công');
        return Redirect::to('all-user');
    }
    public function import_user(Request $request){
        $this->AuthLogin();
        $path = $request->file('file')->getRealPath();
        Excel::import(new ImportsUser, $path);
        return back();

    }
    public function export_user(){
        $this->AuthLogin();
        return Excel::download(new ExportsUser , 'User.xlsx');
    }

}
