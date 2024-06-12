<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_aset',
        'jenis_aset',
        'merek',
        'model',
        'nomor_seri',
        'kondisi',
        'lokasi',
        'tanggal_pembelian',
        'harga_pembelian',
        'keterangan'
    ];
}
