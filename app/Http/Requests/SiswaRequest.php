<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $siswaId = $this->route('siswa') ? $this->route('siswa')->id : null;

        return [
            'nis' => ['required', 'string', 'max:30', Rule::unique('siswa', 'nis')->ignore($siswaId)],
            'nisn' => ['required', 'string', 'max:30', Rule::unique('siswa', 'nisn')->ignore($siswaId)],
            'nama' => ['required', 'string', 'max:150'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'alamat' => ['nullable', 'string'],
            'nama_orang_tua' => ['nullable', 'string', 'max:150'],
            'no_hp_orang_tua' => ['nullable', 'string', 'max:20'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'tahun_ajaran_id' => ['required', 'exists:tahun_ajaran,id'],
            'status' => ['required', 'in:Aktif,Pindah,Lulus,Keluar'],
        ];
    }

    public function messages(): array
    {
        return [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'kelas_id.required' => 'Kelas wajib dipilih.',
            'kelas_id.exists' => 'Kelas tidak valid.',
            'tahun_ajaran_id.required' => 'Tahun ajaran wajib dipilih.',
            'tahun_ajaran_id.exists' => 'Tahun ajaran tidak valid.',
            'status.required' => 'Status wajib dipilih.',
        ];
    }
}
