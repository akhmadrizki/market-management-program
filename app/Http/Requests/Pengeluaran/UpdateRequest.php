<?php

namespace App\Http\Requests\Pengeluaran;

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
            'desc'    => 'required|min:3',
            'total'   => 'required|numeric|min:3',
            'tanggal' => 'required|date',
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
            'desc.min'      => 'Keterangan minimal 3 karakter',
            'total.numeric' => 'Format yang diinputkan salah',
        ];
    }
}
