<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratMasukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch');

        return [
            'nomor_surat' => ['required', 'string', 'max:100'],
            'tanggal_surat' => ['required', 'date'],
            'pengirim' => ['required', 'string', 'max:150'],
            'perihal' => ['required', 'string', 'max:255'],
            'lampiran' => ['nullable', 'string', 'max:150'],
            'file_pdf' => [$isUpdate ? 'nullable' : 'required', 'file', 'mimes:pdf', 'max:5120'],
            'keterangan' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nomor_surat.required' => 'Nomor surat wajib diisi.',
            'tanggal_surat.required' => 'Tanggal surat wajib diisi.',
            'pengirim.required' => 'Pengirim wajib diisi.',
            'perihal.required' => 'Perihal wajib diisi.',
            'file_pdf.required' => 'File PDF wajib diunggah.',
            'file_pdf.mimes' => 'File harus berformat PDF.',
            'file_pdf.max' => 'Ukuran file maksimal 5MB.',
        ];
    }
}
