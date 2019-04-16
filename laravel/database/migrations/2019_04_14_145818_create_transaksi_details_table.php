<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->bigIncrements('id_transdetail');
            $table->float('harga_satuan');
            $table->bigInteger('jumlah_barang');
            $table->bigInteger('id_trans');
            $table->bigInteger('id_produk');
            $table->foreign('id_trans')->references('id_trans')->on('transaksis');
            $table->foreign('id_produk')->references('id_produk')->on('produks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_details');
    }
}
