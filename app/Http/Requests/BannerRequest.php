<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'banner_name'=>'required',
            'banner_image'=>'required|image',
            'banner_desc'=>'required',
        ];
    }
    public function messages()
    {
        return[
            'banner_name.required'=>'Thông tin bắt buộc điền',
            'banner_image.required'=>'Thông tin bắt buộc điền',
            'banner_image.image'=>'Phải là ảnh',
            'banner_desc.required'=>'Thông tin bắt buộc điền',
        ];
    }
}
