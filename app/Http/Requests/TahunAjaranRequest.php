<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TahunAjaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tahun' => ['required', 'string', 'max:20'],
            'semester' => ['required', 'in:Ganjil,Genap'],
            'status_aktif' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'tahun.required' => 'Tahun ajaran wajib diisi.',
            'semester.required' => 'Semester wajib dipilih.',
        ];
    }
}
