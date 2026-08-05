<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratKeluarRequest extends FormRequest
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
            'tujuan' => ['required', 'string', 'max:150'],
            'perihal' => ['required', 'string', 'max:255'],
            'lampiran' => ['nullable', 'string', 'max:150'],
            'file_pdf' => [$isUpdate ? 'nullable' : 'required', 'file', 'mimes:pdf', 'max:5120'],
            'penandatangan' => ['nullable', 'string', 'max:150'],
            'tanggal_surat' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'nomor_surat.required' => 'Nomor surat wajib diisi.',
            'tujuan.required' => 'Tujuan surat wajib diisi.',
            'perihal.required' => 'Perihal wajib diisi.',
            'file_pdf.required' => 'File PDF wajib diunggah.',
            'file_pdf.mimes' => 'File harus berformat PDF.',
            'file_pdf.max' => 'Ukuran file maksimal 5MB.',
            'tanggal_surat.required' => 'Tanggal surat wajib diisi.',
        ];
    }
}
