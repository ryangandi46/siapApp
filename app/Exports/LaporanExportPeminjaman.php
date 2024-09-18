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
                'penanggung_jawab' => $item->penanggung_jawab,
                'kelas' => $item->kelas,
                'nama_aset' => $item->aset->nama_aset,
                'jumlah' => $item->jumlah,
                'kondisi_dipinjam' => $item->kondisi_dipinjam,
                'waktu_meminjam' => $item->waktu_meminjam,
                'status' => $item->status,
                'waktu_pengembalian' => $item->waktu_pengembalian ? $item->waktu_pengembalian : 'Belum Dikembalikan',
                'kondisi_dikembalikan' => $item->kondisi_dikembalikan ? $item->kondisi_dikembalikan : 'Belum Dikembalikan',
                'berita_acara' => $item->berita_acara ? $item->berita_acara : 'Tidak Ada Berita Acara',
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
            'kondisi_dipinjam',
            'Waktu Meminjam',
            'Status',
            'Waktu Pengembalian',
            'kondisi_dikembalikan',
            'berita_acara',
            'Keterangan',
        ];
    }
}
