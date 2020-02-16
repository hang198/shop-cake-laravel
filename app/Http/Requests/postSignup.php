<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postSignup extends FormRequest
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
            'email' => 'required|email',
            'full_name' => 'required|max:50',
            'password' => 'required',
            're_password' => 'required|same:password',
            'address' => 'required',
            'phone' => 'required|regex:/(0)[0-9]{9}/'
        ];
    }
    public function messages()
    {
        return [
          'email.required'=>'Email không được để trống',
            'email.email'=> 'Email không đúng định dạng',
            'address.required' => 'Địa chỉ không được để trống',
            'full_name.required' => 'Họ và tên không được để trống',
            'full_name.max' => 'Họ và tên có tối đa 50 kí tự',
            'password.required' => 'Mật khẩu không được để trống',
            're_password.required' =>'Nhập lại mật khẩu',
            're_password.same' => 'Mật khẩu nhập lại không đúng',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.regex' => 'Số điện thoại không đúng định dạng'
        ];
    }
}
