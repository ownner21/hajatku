<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemesananVerifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_verifikasis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pemesan');
            $table->integer('id_penjual');
            $table->integer('nomor_invoice');
            $table->string('nama_produk');
            $table->integer('harga_satuan');
            $table->integer('kapasitas');
            $table->integer('total_bayar');
            $table->timestamp('waktu_pemesanan')->nullable();
            $table->timestamp('waktu_pembayaran')->nullable();
            $table->timestamp('waktu_konfirmasi_penjual')->nullable();
            $table->timestamp('waktu_pengiriman')->nullable();
            $table->timestamp('waktu_penerimaan')->nullable();
            $table->enum('status', ['Pesan', 'Konfirmasi', 'Proses', 'Pengiriman', 'Diterima'])->default('Pesan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanan_verifikasis');
    }
}
