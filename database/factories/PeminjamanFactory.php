<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Aset;
use App\Models\User;

class PeminjamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_peminjam' => $this->faker->name,
            'penanggung_jawab' => User::factory(),
            'kelas' => $this->faker->randomElement(['X', 'XI', 'XII']), // Example classes
            'nama_aset' => Aset::factory(), // Example assets
            'jumlah' => $this->faker->randomDigit,
            'status' => $this->faker->randomElement(['Dipinjam', 'Dikembalikan']),
            'kondisi_dipinjam' => $this->faker->randomElement(['Bagus', 'Rusak Sedang', 'Rusak Berat']),
            'kondisi_dikembalikan' => $this->faker->randomElement(['Bagus', 'Rusak Sedang', 'Rusak Berat']),
            // 'waktu_meminjam' => $this->faker->dateTimeBetween('-1 month', 'now'),
            // 'waktu_pengembalian' => $this->faker->dateTimeBetween('now', '+1 month'), // Assuming return date is after borrow date
            'waktu_meminjam' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i'),
            'waktu_pengembalian' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d H:i'), // Assuming return date is after borrow date
            'keterangan' => $this->faker->sentence,
        ];
    }
}
