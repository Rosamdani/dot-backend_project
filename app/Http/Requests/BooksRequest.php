<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BooksRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'deskripsi' => 'required',
            'author_id' => 'required|exists:authors,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul harus diisi',
            'deskripsi.required' => 'Deskripsi harus diisi',
            'author_id.required' => 'Author harus diisi',
            'author_id.exists' => 'Author tidak ditemukan',
        ];
    }
}
