<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengajuan_lelangRequest extends FormRequest
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
            'user_id' => ['required'],
            'nama_barang' => ['required'],
            'kategori_id' => ['required'],
            'harga_barang' => ['required', 'integer'],
            'harga_lelang' => ['required', 'integer'],
            'lelang_dimulai' => ['required', 'date'],
            'lelang_diakhiri' => ['required', 'date'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'Input ini harus diisi',
            'nama_barang.required' => 'Input ini harus diisi',
            'kategori_id.required' => 'Input ini harus diisi',
            'harga_barang.required' => 'Input ini harus diisi',
            'harga_barang.integer' => 'Input ini harus berupa angka',
            'harga_lelang.required' => 'Input ini harus diisi',
            'harga_lelang.integer' => 'Input ini harus berupa angka',
            'lelang_dimulai.required' => 'Input ini harus diisi',
            'lelang_dimulai.date' => 'Input ini harus berupa tanggal',
            'lelang_diakhiri.required' => 'Input ini harus diisi',
            'lelang_diakhiri.date' => 'Input ini harus berupa tanggal',
        ];
    }
}
