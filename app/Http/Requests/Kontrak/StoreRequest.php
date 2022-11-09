<?php

namespace App\Http\Requests\Kontrak;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'id_penyewa'    => 'required',
            'id_jenis_toko' => 'required',
            'jenis_kontrak' => 'required',
            'tanggal'       => 'required',
            'biaya_sewa'    => 'required|numeric|min:3',
            'tunggakan'     => 'nullable|numeric|min:3',
            'no_toko'       => 'required',
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
            'id_penyewa.required'    => 'Nama pedagang tidak boleh kosong',
            'id_jenis_toko.required' => 'Jenis pasar tidak boleh kosong',
            'jenis_kontrak.required' => 'Jenis kontrak tidak boleh kosong',
            'tanggal.required'       => 'Tanggal tidak boleh kosong',
            'biaya_sewa.required'    => 'Biaya sewa tidak boleh kosong',
            'no_toko.required'       => 'Nomor toko tidak boleh kosong',
        ];
    }
}
