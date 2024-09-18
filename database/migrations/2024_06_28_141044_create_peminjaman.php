<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            // $table->string('penanggung_jawab');
            $table->string('kelas');
            // $table->string('nama_aset');
            $table->foreignId('nama_aset')->constrained('asets')->onDelete('cascade');
            $table->foreignId('penanggung_jawab')->constrained('users')->onDelete('cascade');
            $table->string('jumlah');
            $table->string('kondisi_dipinjam');
            $table->string('kondisi_dikembalikan')->nullable();
            $table->string('status');           
            $table->string('keterangan')->nullable();
            $table->timestamp('waktu_meminjam');
            $table->timestamp('waktu_pengembalian')->nullable();
            $table->timestamps();

            // $table->foreign('nama_aset')->references('id')->on('asets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
