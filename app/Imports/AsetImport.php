<?php

namespace App\Imports;


use App\Models\Aset;
use Maatwebsite\Excel\Concerns\ToModel;

class AsetImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Aset([
            'nama_aset' => $row[0] ?? null,
            'merek' => $row[1] ?? null,
            'kondisi' => $row[2] ?? null,
            'lokasi' => $row[3] ?? null,
            'jumlah_satuan' => $row[4] ?? null,
            'tanggal_pembelian' =>$row[5] ?? null,
            'jurusan' => $row[6] ?? null,
            'keterangan' => $row[7] ?? null,
            // 'timestamps' => [
            'created_at' => $row[8] ?? now(),
            'updated_at' => $row[9] ?? now(),
            // ],
        ]);        
        // dd($aset);

    }
}
