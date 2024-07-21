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
            'nama_aset' => $this->faker->randomElement(['Laptop', 'Proyektor', 'Kamera']), // 3 kata digabung menjadi satu string
            'merek' => $this->faker->company, // Nama perusahaan sebagai merek
            'kondisi' => $this->faker->randomElement(['Bagus', 'Rusak Sedang', 'Rusak Berat']), // Pilihan kondisi
            'lokasi' => $this->faker->address, // Alamat lengkap
            'jumlah_satuan' => $this->faker->numberBetween(1, 100), // Angka antara 1 dan 100
            'tanggal_pembelian' => $this->faker->date('Y-m-d'), // Format tanggal 'YYYY-MM-DD'
            'jurusan' => $this->faker->randomElement(['TKJ', 'AKL']), // Harga dengan 2 desimal antara 1000 dan 1000000
            'keterangan' => $this->faker->sentence(20) // Kalimat dengan 20 kata
        ];        
    }
}
