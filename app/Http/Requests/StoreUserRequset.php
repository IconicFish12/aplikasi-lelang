<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequset extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama_lengkap' => ['required'],
            'email' => ['required', 'email', 'min:4', 'unique:tb_masyarakat,email'],
            'password' => ['required', Password::min('4')->mixedCase(), 'max:20'],
            'telp' => ['required', 'min:4', 'max:15'],
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
            'nama_lengkap.required' => "Input ini harus diisi",
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
