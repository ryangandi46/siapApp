<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AsetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_aset' => $this->faker->words(3, true), // 3 kata digabung menjadi satu string
            'merek' => $this->faker->company, // Nama perusahaan sebagai merek
            'kondisi' => $this->faker->randomElement(['Baru', 'Bekas', 'Rusak']), // Pilihan kondisi
            'lokasi' => $this->faker->address, // Alamat lengkap
            'jumlah_satuan' => $this->faker->numberBetween(1, 100), // Angka antara 1 dan 100
            'tanggal_pembelian' => $this->faker->date('Y-m-d'), // Format tanggal 'YYYY-MM-DD'
            'harga_pembelian' => $this->faker->randomFloat(2, 1000, 1000000), // Harga dengan 2 desimal antara 1000 dan 1000000
            'keterangan' => $this->faker->sentence(20) // Kalimat dengan 20 kata
        ];        
    }
}
