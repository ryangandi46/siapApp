<?php

namespace App\Imports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\ToModel;

class PeminjamanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Peminjaman([
            'nama_peminjam' => $row[0] ?? null,
            'penanggung_jawab' => $row[1] ?? null,            
            'kelas' => $row[2] ?? null,
            'nama_aset' => $row[3] ?? null,
            'jumlah' => $row[4] ?? null,
            'kondisi_dipinjam' => $row[5] ?? null,
            'status' => $row[6] ?? null,
            'keterangan' => $row[7] ?? null,
            'waktu_meminjam' => $row[8] ?? null,
            'waktu_pengembalian' => $row[9] ?? null,
            'kondisi_dikembalikan' => $row[10] ?? null,
            'berita_acara' => $row[11] ?? null,
            'created_at' => $row[12] ?? now(),
            'updated_at' => $row[13] ?? now(),
        ]);
        // dd($data);
    }
}
