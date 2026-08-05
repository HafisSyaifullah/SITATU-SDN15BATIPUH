<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanSekolah extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_sekolah';

    protected $fillable = [
        'nama_sekolah',
        'npsn',
        'alamat',
        'kepala_sekolah',
        'logo',
        'email',
        'telepon',
    ];
}
