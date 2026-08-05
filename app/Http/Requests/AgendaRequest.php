<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:150'],
            'tanggal' => ['required', 'date'],
            'jam' => ['required'],
            'tempat' => ['nullable', 'string', 'max:150'],
            'keterangan' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul agenda wajib diisi.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'jam.required' => 'Jam wajib diisi.',
        ];
    }
}
