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
            'kelas' => $row[1] ?? null,
            'penanggung_jawab' => $row[2] ?? null,            
            'nama_aset' => $row[3] ?? null,
            'jumlah' => $row[4] ?? null,
            'status' => $row[5] ?? null,
            'keterangan' => $row[6] ?? null,
            'waktu_meminjam' => $row[7] ?? null,
            'waktu_pengembalian' => $row[8] ?? null,
            'created_at' => $row[9] ?? now(),
            'updated_at' => $row[10] ?? now(),
        ]);
        // dd($data);
    }
}
