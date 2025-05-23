<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'sending_postcode' => 'required|regex:/^\d{3}-\d{4}$/',
            'sending_address' => 'required|string|max:255',
            'sending_building' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'お名前を入力してください',
            'sending_postcode.required' => '郵便番号を入力してください',
            'sending_postcode.regex' => '郵便番号は「123-4567」のようにハイフンを入れた8文字入力してください',
            'sending_address.required' => '住所を入力してください',
        ];
    }
}
