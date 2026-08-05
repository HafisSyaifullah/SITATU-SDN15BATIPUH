<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MutasiSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'siswa_id' => ['required', 'exists:siswa,id'],
            'jenis_mutasi' => ['required', 'in:Masuk,Keluar'],
            'tanggal' => ['required', 'date'],
            'sekolah_tujuan' => ['nullable', 'string', 'max:150'],
            'keterangan' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'siswa_id.required' => 'Siswa wajib dipilih.',
            'siswa_id.exists' => 'Data siswa tidak valid.',
            'jenis_mutasi.required' => 'Jenis mutasi wajib dipilih.',
            'tanggal.required' => 'Tanggal wajib diisi.',
        ];
    }
}
