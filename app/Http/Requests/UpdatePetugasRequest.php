<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePetugasRequest extends FormRequest
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
            'tgl_lahir' => ['required', 'date'],
            'alamat' => ['required', 'max:50'],
            'email' => ['required', 'email', 'min:4'],
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
            'tgl_lahir.required' => "Input ini harus diisi",
            'telp.required' => "Input ini harus diisi",
            'email.required' => "Input ini harus diisi",
            'alamat.required' => "Input ini harus diisi",
            'telp.max' => "Panjang Maksimal 15 Karakter",
            'alamat.max' => "Panjang Maksimal 50 Karakter",
            'email.min' => "Panjang Maksimal 4 Karakter",
            'telp.min' => "Panjang Maksimal 4 Karakter",
            
        ];
    }
}
