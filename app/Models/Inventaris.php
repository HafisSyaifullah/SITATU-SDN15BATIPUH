<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventaris extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inventaris';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_barang_id',
        'jumlah',
        'kondisi',
        'lokasi',
        'tahun_pengadaan',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_barang_id');
    }
}
