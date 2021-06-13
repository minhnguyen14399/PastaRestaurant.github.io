<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'admin_name'=>'required',
            'admin_email'=>'required|email|unique:tbl_customer',
            'admin_password'=>'required',
            'admin_phone'=>'required|numeric|digits_between:10,11',
        ];
    }
    public function messages()
    {
        return[
            'admin_name.required'=>'Thông tin bắt buộc điền',
            
            'admin_email.required'=>'Thông tin bắt buộc điền',
            'admin_email.email'=>'Nhập đúng email',
            'admin_email.unique'=>'Email đã được sử dụng',
            'admin_password.required'=>'Thông tin bắt buộc điền',
            'admin_phone.required'=>'Thông tin bắt buộc điền',
            'admin_phone.numeric'=>'Phải là số',
            'admin_phone.digits_between'=>'Vui lòng nhập đủ số',
        ];
    }
}
