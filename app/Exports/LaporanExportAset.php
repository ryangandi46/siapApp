<?php

namespace App\Exports;

use App\Models\Aset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExportAset implements FromCollection, WithHeadings
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Peminjaman::all();
    // }
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function($item) {
            return [
                'ID Aset' => $item->id,
                'nama_aset' => $item->nama_aset,
                'merek' => $item->merek,
                'lokasi' => $item->lokasi,
                'jumlah_satuan' => $item->jumlah_satuan,
                'tanggal_pembelian' => $item->tanggal_pembelian,
                'jurusan' => $item->jurusan,
                'kondisi' => $item->kondisi,
                'keterangan' => $item->keterangan,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID Aset', // Replace with actual header names
            'Nama Aset',
            'Merek',
            'Lokasi',
            'Jumlah',
            'Tanggal Pembelian',
            'Jurusan',
            'Kondisi',
            'Keterangan',
        ];
    }
}
