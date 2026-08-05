<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengaturanSekolahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_sekolah' => ['required', 'string', 'max:150'],
            'npsn' => ['nullable', 'string', 'max:30'],
            'alamat' => ['nullable', 'string'],
            'kepala_sekolah' => ['nullable', 'string', 'max:150'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'email' => ['nullable', 'email', 'max:150'],
            'telepon' => ['nullable', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_sekolah.required' => 'Nama sekolah wajib diisi.',
            'logo.image' => 'File harus berupa gambar.',
            'logo.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
            'logo.max' => 'Ukuran gambar maksimal 2MB.',
            'email.email' => 'Format email tidak valid.',
        ];
    }
}
