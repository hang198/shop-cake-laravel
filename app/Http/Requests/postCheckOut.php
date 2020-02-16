<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postCheckOut extends FormRequest
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
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'address' => 'required|max:255',
            'phone' => 'required|regex:/(0)[0-9]{9}/',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=> 'Tên không được để trống',
            'gender.required'=> 'Chưa chọn giới tính',
            'email.required'=> 'Email không được để trống',
            'email.email'=> 'Email không đúng định dạng',
            'address.required'=> 'Địa chỉ là bắt buộc',
            'address.max'=> 'Địa chỉ tối đa là 255 kí tự',
            'phone.required'=> 'Số điện thoại không được để trống',
            'phone.regex'=> 'Số điện thoại không đúng định dạng',
        ];
    }
}
