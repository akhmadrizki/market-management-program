<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required|alpha_dash|unique:users',
            'contact'  => 'required|regex:/^([0-9\s\(\)]*)$/'
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
            'username.unique'     => 'Username sudah terdaftar, mohon gunakan username lain',
            'username.alpha_dash' => 'Inputan tidak boleh menggunakan space',
            'contact.regex'       => 'Nomor tidak sesuai (gunakan 6281...)',
        ];
    }
}
