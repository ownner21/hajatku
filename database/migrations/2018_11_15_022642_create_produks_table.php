<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_member');
            $table->integer('id_kategori');
            $table->string('nama_produk');
            $table->string('slug_produk');
            $table->text('deskripsi');
            $table->text('lokasi')->nullable();
            $table->string('min_pemesanan')->nullable();
            $table->string('max_pemesanan')->nullable();
            $table->string('harga');
            $table->string('kode_produk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
}
