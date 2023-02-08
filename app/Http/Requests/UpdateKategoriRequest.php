<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKategoriRequest extends FormRequest
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
            'nama_kategori' => ["required", 'unique:tb_kategori', 'max:100']
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
            'nama_kategori.required' => 'Nama Kategori Harus diisi',
            'nama_kategori.unique' => 'Nama Kategori Harus Unik',
            'nama_kategori.max' => 'Panjang Maksimal 100 Karakter',
        ];
    }
}
