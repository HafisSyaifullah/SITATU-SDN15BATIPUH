<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumniRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'siswa_id' => ['nullable', 'exists:siswa,id'],
            'nama' => ['required', 'string', 'max:150'],
            'tahun_lulus' => ['required', 'digits:4'],
            'pekerjaan' => ['nullable', 'string', 'max:150'],
            'alamat' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'siswa_id.exists' => 'Data siswa tidak valid.',
            'nama.required' => 'Nama alumni wajib diisi.',
            'tahun_lulus.required' => 'Tahun lulus wajib diisi.',
            'tahun_lulus.digits' => 'Tahun lulus harus 4 digit angka.',
        ];
    }
}
