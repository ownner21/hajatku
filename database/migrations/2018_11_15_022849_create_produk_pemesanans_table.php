<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukPemesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_pemesanans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_member');
            $table->integer('id_produk')->nullable();
            $table->integer('id_paket')->nullable();
            $table->integer('harga_produk');
            $table->integer('jumlah_produk')->default('1');
            $table->integer('total_bayar');
            $table->timestamp('waktu_pesan')->nullable();
            $table->timestamp('waktu_bayar')->nullable();
            $table->timestamp('waktu_konfirmasi')->nullable();
            $table->enum('status',['Pesan', 'Lunas', 'Konfirmasi'])->default('Pesan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_pemesanans');
    }
}
