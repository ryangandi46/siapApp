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
            'nama_aset' =>  $this->faker->text(70),
            'merek' =>  $this->faker->text(50),
            'kondisi' =>  $this->faker->text(20),
            'lokasi' =>  $this->faker->address(),
            'jumlah_satuan' => $this->faker->numerify(),
            'tanggal_pembelian' =>  $this->faker->date(),
            'harga_pembelian' =>  $this->faker->numerify(),
            'keterangan' =>  $this->faker->text(200)
        ];
    }
}
