<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExportPeminjaman implements FromCollection, WithHeadings
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
                'ID Peminjaman' => $item->id,
                'nama_peminjam' => $item->nama_peminjam,
                'penanggung_jawab' => $item->user->penanggung_jawab,
                'kelas' => $item->kelas,
                'nama_aset' => $item->aset->nama_aset,
                'jumlah' => $item->jumlah,
                'waktu_meminjam' => $item->waktu_meminjam,
                'status' => $item->status,
                'waktu_pengembalian' => $item->waktu_pengembalian,
                'keterangan' => $item->keterangan,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID Peminjaman', // Replace with actual header names
            'Nama Peminjam',
            'Penanggung Jawab',
            'Kelas',
            'Nama Barang',
            'Jumlah',
            'Waktu Meminjam',
            'Status',
            'Waktu Pengembalian',
            'Keterangan',
        ];
    }
}
