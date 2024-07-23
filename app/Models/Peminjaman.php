<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    // protected $fillable = [
    //     'nama_peminjam', 
    //     'kelas', 
    //     'nama_aset', 
    //     'jumlah', 
    //     'waktu_meminjam', 
    //     'keterangan',
    //     'status'
    // ];

    protected $guarded = [];

    public function aset()
    {
        // belongs to untuk memberi tahu bahwa model peminjaman dimiliki aset
        return $this->belongsTo(Aset::class,'nama_aset');
    }
    public function user()
    {
        // belongs to untuk memberi tahu bahwa model peminjaman dimiliki user
        return $this->belongsTo(User::class,'penanggung_jawab');
    }
}
