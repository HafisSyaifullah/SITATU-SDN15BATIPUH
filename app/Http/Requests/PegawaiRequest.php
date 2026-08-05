<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PegawaiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $pegawaiId = $this->route('pegawai') ? $this->route('pegawai')->id : null;

        return [
            'nip' => ['required', 'string', 'max:30', Rule::unique('pegawai', 'nip')->ignore($pegawaiId)],
            'nama' => ['required', 'string', 'max:150'],
            'jabatan' => ['nullable', 'string', 'max:100'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
            'status' => ['required', 'in:Aktif,Nonaktif'],
        ];
    }

    public function messages(): array
    {
        return [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ];
    }
}
