<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
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
            'nama_barang' => ["required"],
            'nama_user' => ["required"],
            "kategori_id" => ["integer"],
            'harga_barang' => ["required", "integer"],
            "deskripsi_barang" => ["required"],
            "foto" => ["required", "image", "max:10000", "mimes:png,jpg,jpeg"]
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
            'nama_barang.required' => 'Nama Barang Harus diisi',
            'nama_user.required' => 'Nama Barang Harus diisi',
            'harga_barang.required' => 'Harga Barang Harus diisi',
            'deskripsi_barang.required' => 'Deskripsi Barang Harus diisi',
            'foto.required' => 'Foto Barang Harus diisi',
            'kategori_id' => "Value harus valid",
            'foto.image' => "File Harus Berupa Gambar",
            'foto.max' => 'Ukuran File Maksimal 10 MB',
            'foto.mimes' => 'format yang diper bolehkan png, jpg, dan jpeg',
            'harga_barang.integer' => 'Harga Barang Harus berupa angka',
        ];
    }
}
