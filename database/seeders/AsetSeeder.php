<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aset = new \App\Models\Aset([
            'nama_aset' => 'Aset #1',
            'jenis_aset' => 'Aset #1 jenis aset',
            'merek' => 'Aset #1 merek',
            'model' => 'Aset #1 model',
            'nomor_seri' => 'Aset #1 nomor seri',
            'kondisi' => 'Aset #1 kondisi',
            'lokasi' => 'Aset #1 lokasi',
            'tanggal_pembelian' => '2001/01/01',
            'harga_pembelian'  => '100000',
            'keterangan' => 'Aset #1 keterangan'
        ]);
        $aset->save();

        $aset = new \App\Models\Aset([
            'nama_aset' => 'Aset #2',
            'jenis_aset' => 'Aset #2 jenis aset',
            'merek' => 'Aset #2 merek',
            'model' => 'Aset #2 model',
            'nomor_seri' => 'Aset #2 nomor seri',
            'kondisi' => 'Aset #2 kondisi',
            'lokasi' => 'Aset #2 lokasi',
            'tanggal_pembelian' => '2002/02/02',
            'harga_pembelian'  => '200000',
            'keterangan' => 'Aset #2 keterangan'
        ]);
        $aset->save();

        $aset = new \App\Models\Aset([
            'nama_aset' => 'Aset #3',
            'jenis_aset' => 'Aset #3 jenis aset',
            'merek' => 'Aset #3 merek',
            'model' => 'Aset #3 model',
            'nomor_seri' => 'Aset #3 nomor seri',
            'kondisi' => 'Aset #3 kondisi',
            'lokasi' => 'Aset #3 lokasi',
            'tanggal_pembelian' => '2003/03/03',
            'harga_pembelian'  => '300000',
            'keterangan' => 'Aset #3 keterangan'
        ]);
        $aset->save();
    }
}
