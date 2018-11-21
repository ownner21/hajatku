<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStokProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok_produks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_produk');
            $table->integer('stok_awal')->nullable();
            $table->integer('debit')->nullable();
            $table->integer('kredit')->nullable();
            $table->integer('stok_akhir');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('stok_produks');
    }
}
