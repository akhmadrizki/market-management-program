<?php

namespace App\Http\Requests\Pemasukan;

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
            'deskripsi' => 'required|min:3',
            'jumlah'    => 'required|numeric|min:3',
            'tanggal'   => 'required|date',
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
            'deskripsi.min'  => 'Keterangan minimal 3 karakter',
            'jumlah.numeric' => 'Format yang diinputkan salah',
        ];
    }
}
