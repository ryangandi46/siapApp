<?php

namespace App\Imports;

use Log;
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
            //     'nama_aset' => $row[1] ?? null,
            //     'merek' => $row[2] ?? null,
            //     'kondisi' => $row[3] ?? null,
            //     'lokasi' => $row[4] ?? null,
            //     'jumlah_satuan' => is_array($row[5]) ? json_encode($row[5]) : ($row[5] ?? null),
            //     'tanggal_pembelian' => $row[6] ?? null,
            //     'harga_pembelian' => $row[7] ?? null,
            //     'keterangan' => $row[8] ?? null,
            //     'timestamps' => [
            //         'created_at' => $row[9] ?? now(),
            //         'updated_at' => $row[10] ?? now(),
            //     ],
            // ]);
                'nama_aset' => is_array($row['nama_aset']) ? implode(', ', $row['nama_aset']) : ($row['nama_aset'] ?? null),
                'merek' => is_array($row['merek']) ? implode(', ', $row['merek']) : ($row['merek'] ?? null),
                'kondisi' => is_array($row['kondisi']) ? implode(', ', $row['kondisi']) : ($row['kondisi'] ?? null),
                'lokasi' => is_array($row['lokasi']) ? implode(', ', $row['lokasi']) : ($row['lokasi'] ?? null),
                'jumlah_satuan' => is_array($row['jumlah_satuan']) ? implode(', ', $row['jumlah_satuan']) : ($row['jumlah_satuan'] ?? null),
                'tanggal_pembelian' => is_array($row['tanggal_pembelian']) ? implode(', ', $row['tanggal_pembelian']) : ($row['tanggal_pembelian'] ?? null),
                'harga_pembelian' => is_array($row['harga_pembelian']) ? implode(', ', $row['harga_pembelian']) : ($row['harga_pembelian'] ?? null),
                'keterangan' => is_array($row['keterangan']) ? implode(', ', $row['keterangan']) : ($row['keterangan'] ?? null),
                // 'timestamps' => [
                //     'created_at' => is_array($row['']) ? implode(', ', $row['']) : ($row[''] ?? now()),
                //     'updated_at' => is_array($row[9]) ? implode(', ', $row[9]) : ($row[9] ?? now()),
                // ],
            ]);
        //     'nama_aset' => isset($row[1]) && is_array($row[1]) ? implode(', ', $row[1]) : ($row[1] ?? null),
        //     'merek' => isset($row[2]) && is_array($row[2]) ? implode(', ', $row[2]) : ($row[2] ?? null),
        //     'kondisi' => isset($row[3]) && is_array($row[3]) ? implode(', ', $row[3]) : ($row[3] ?? null),
        //     'lokasi' => isset($row[4]) && is_array($row[4]) ? implode(', ', $row[4]) : ($row[4] ?? null),
        //     'jumlah_satuan' => isset($row[5]) && is_array($row[5]) ? implode(', ', $row[5]) : ($row[5] ?? null),
        //     'tanggal_pembelian' => isset($row[6]) && is_array($row[6]) ? implode(', ', $row[6]) : ($row[6] ?? null),
        //     'harga_pembelian' => isset($row[7]) && is_array($row[7]) ? implode(', ', $row[7]) : ($row[7] ?? null),
        //     'keterangan' => isset($row[8]) && is_array($row[8]) ? implode(', ', $row[8]) : ($row[8] ?? null),
        //     'timestamps' => [
        //         'created_at' => isset($row[9]) && is_array($row[9]) ? implode(', ', $row[9]) : ($row[9] ?? now()),
        //         'updated_at' => isset($row[10]) && is_array($row[10]) ? implode(', ', $row[10]) : ($row[10] ?? now()),
        //     ],
        // ]);
    }
}
