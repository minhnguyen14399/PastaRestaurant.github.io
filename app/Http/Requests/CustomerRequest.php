<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'customer_name'=>'required',
            'customer_email'=>'required|email|unique:tbl_customer',
            'customer_password'=>'required',
            'customer_phone'=>'required|numeric|digits_between:10,11',
        ];
    }
    public function messages()
    {
        return[
            'customer_name.required'=>'Thông tin bắt buộc điền',
            'customer_email.required'=>'Thông tin bắt buộc điền',
            'customer_email.email'=>'Nhập đúng email',
            'customer_email.unique'=>'Email đã có người sử dụng',
            'customer_password.required'=>'Thông tin bắt buộc điền',
            'customer_phone.required'=>'Thông tin bắt buộc điền',
            'customer_phone.numeric'=>'Phải là số',
            'customer_phone.digits_between'=>'Vui lòng nhập đủ số',
        ];
    }
}
