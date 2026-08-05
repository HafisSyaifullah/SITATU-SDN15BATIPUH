<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InventarisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('inventaris') ? $this->route('inventaris')->id : null;

        return [
            'kode_barang' => ['required', 'string', 'max:50', Rule::unique('inventaris', 'kode_barang')->ignore($id)],
            'nama_barang' => ['required', 'string', 'max:150'],
            'kategori_barang_id' => ['required', 'exists:kategori_barang,id'],
            'jumlah' => ['required', 'integer', 'min:0'],
            'kondisi' => ['required', 'in:Baik,Rusak Ringan,Rusak Berat'],
            'lokasi' => ['nullable', 'string', 'max:150'],
            'tahun_pengadaan' => ['nullable', 'digits:4'],
        ];
    }

    public function messages(): array
    {
        return [
            'kode_barang.required' => 'Kode barang wajib diisi.',
            'kode_barang.unique' => 'Kode barang sudah terdaftar.',
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'kategori_barang_id.required' => 'Kategori wajib dipilih.',
            'kategori_barang_id.exists' => 'Kategori tidak valid.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah tidak boleh negatif.',
            'kondisi.required' => 'Kondisi wajib dipilih.',
            'tahun_pengadaan.digits' => 'Tahun pengadaan harus 4 digit angka.',
        ];
    }
}
