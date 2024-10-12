<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'no_telp' => 'required|max_digits:12|regex:/^0[0-9]{9,12}$/',
            'email' => 'required|email',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi',
            'no_telp.required' => 'No Telp harus diisi',
            'no_telp.max_digits' => 'No Telp harus 12 digit',
            'no_telp.regex' => 'No Telp harus angka',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus valid',
        ];
    }
}