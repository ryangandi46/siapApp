<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Aset;

class AsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 3; $i++) {
            $aset = new Aset([
                'nama_aset' => $faker->words(3, true), // 3 kata digabung menjadi satu string
                'merek' => $faker->company, // Nama perusahaan sebagai merek
                'kondisi' => $faker->randomElement(['Baru', 'Bekas', 'Rusak']), // Pilihan kondisi
                'lokasi' => $faker->address, // Alamat lengkap
                'jumlah_satuan' => $faker->numberBetween(1, 100), // Angka antara 1 dan 100
                'tanggal_pembelian' => $faker->date('Y-m-d'), // Format tanggal 'YYYY-MM-DD'
                'harga_pembelian' => $faker->randomFloat(2, 1000, 1000000), // Harga dengan 2 desimal antara 1000 dan 1000000
                'keterangan' => $faker->sentence(20) // Kalimat dengan 20 kata
            ]);
            $aset->save();
        }
    }
}
