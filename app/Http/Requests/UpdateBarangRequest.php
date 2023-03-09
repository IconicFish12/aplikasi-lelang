<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBarangRequest extends FormRequest
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
            'nama_barang' => [Rule::requiredIf(request()->has("nama_barang"))],
            'nama_user' => [Rule::requiredIf(request()->has("nama_user"))],
            'tgl_pelelangan' => [Rule::requiredIf(request()->has("tgl_pelelangan")), "date_format:Y-m-d"],
            "kategori_id" => [Rule::requiredIf(request()->has("kategori_id")), 'integer'],
            'harga_barang' => [Rule::requiredIf(request()->has("harga_barang")), "integer"],
            "deskripsi_barang" => [Rule::requiredIf(request()->has("deskripsi_barang"))],
            "status_lelang" => [Rule::requiredIf(request()->has("status_lelang"))],
            "foto" => ["image", "max:10000", "mimes:png,jpg,jpeg"]
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
            'tgl_pelelangan' => 'Format Tanggal Harus Sesuai',
            'kategori_id' => "Value harus valid",
            'foto.image' => "File Harus Berupa Gambar",
            'foto.max' => 'Ukuran File Maksimal 10 MB',
            'foto.mimes' => 'format yang diper bolehkan png, jpg, dan jpeg',
            'harga_barang.integer' => 'Harga Barang Harus berupa angka',
        ];
    }
}
