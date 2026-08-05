<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KategoriBarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('kategori_barang') ? $this->route('kategori_barang')->id : null;

        return [
            'nama_kategori' => ['required', 'string', 'max:100', Rule::unique('kategori_barang', 'nama_kategori')->ignore($id)],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
        ];
    }
}
