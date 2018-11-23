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
            $table->integer('id_penjual');
            $table->string('nama_produk')->nullable();
            $table->string('nama_paket')->nullable();
            $table->text('produk')->nullable();
            $table->integer('harga');
            $table->integer('qty')->default('1');
            $table->integer('total_bayar');
            $table->timestamp('waktu_pesan')->nullable();
            $table->timestamp('waktu_konfirmasi')->nullable();
            $table->timestamp('waktu_kembali')->nullable();
            $table->timestamp('waktu_pengerjaan')->nullable();
            $table->timestamp('waktu_Pengiriman')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->enum('status',['Pesan', 'Konfirmasi','Pengerjaan','Pengiriman', 'Kembali', 'Selesai'])->default('Pesan');
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
