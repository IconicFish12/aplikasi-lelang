<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => ['required', 'email', 'min:4'],
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
            'telp.required' => "Input ini harus diisi",
            'email.required' => "Input ini harus diisi",
            'email.min' => "Panjang Maksimal 4 Karakter",
            'telp.min' => "Panjang Maksimal 4 Karakter",
        ];
    }
}
