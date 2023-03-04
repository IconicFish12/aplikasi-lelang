<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StorePetugasRequest extends FormRequest
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
            'nama_petugas' => ['required'],
            'email' => ['required', 'email', 'min:4', 'unique:tb_petugas,email'],
            'password' => ['required', Password::min('4')->mixedCase(), 'max:20'],
            'telp' => ['required', 'min:4', 'max:15'],
            'role' => ['required']
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
            'nama_petugas.required' => "Input ini harus diisi",
            'email.unique'=> 'Nilai Dari Input ini harus unik',
            'password.required' => "Input ini harus diisi",
            'telp.required' => "Input ini harus diisi",
            'email.required' => "Input ini harus diisi",
            'password.max' => "Panjang Maksimal 20 Karakter",
            'email.min' => "Panjang Maksimal 4 Karakter",
            'telp.min' => "Panjang Maksimal 4 Karakter",
        ];
    }
}
