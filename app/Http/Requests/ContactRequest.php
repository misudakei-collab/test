<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'last_name'   => ['required'],
            'first_name'  => ['required'],
            'gender'      => ['required'],
            'email'       => ['required', 'email'],
            'tel_1'       => ['required', 'numeric', 'digits_between:1,5'],
            'tel_2'       => ['required', 'numeric', 'digits_between:1,5'],
            'tel_3'       => ['required', 'numeric', 'digits_between:1,5'],
            'address'     => ['required'],
            'category_id' => ['required'],
            'detail'      => ['required', 'max:120'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            'tel_1.required'       => '電話番号を入力してください',
            'tel_1.numeric'        => '電話番号は半角英数字で入力してください',
            'tel_1.digits_between' => '電話番号は5桁まで数字で入力してください',
            'tel_2.required'       => '電話番号を入力してください',
            'tel_2.numeric'        => '電話番号は半角英数字で入力してください',
            'tel_2.digits_between' => '電話番号は5桁まで数字で入力してください',
            'tel_3.required'       => '電話番号を入力してください',
            'tel_3.numeric'        => '電話番号は半角英数字で入力してください',
            'tel_3.digits_between' => '電話番号は5桁まで数字で入力してください',
            'address.required'     => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required'      => 'お問い合わせ内容を入力してください',
            'detail.max'           => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
