<?php

namespace App\Http\Requests\Penyewa;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'     => 'required|min:3',
            'contact'  => 'required|regex:/^([0-9\s\(\)]*)$/',
            'address'  => 'nullable|min:4',
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
            'name.min'      => 'Nama minimal 3 karakter',
            'contact.regex' => 'Nomor tidak sesuai (gunakan 6281...)',
        ];
    }
}
