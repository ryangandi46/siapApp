<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();
        \App\Models\Aset::factory(10)->create();
        \App\Models\Peminjaman::factory(25)->create();
        // $this->call(AsetSeeder::class);
    }
}
