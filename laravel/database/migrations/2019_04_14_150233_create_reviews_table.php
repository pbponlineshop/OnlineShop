<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id_rev');
            $table->bigInteger('rating');
            $table->text('deskripsi');
            $table->bigInteger('id_trans');
            $table->bigInteger('id_produk');
            $table->timestamps();
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
        Schema::dropIfExists('reviews');
    }
}
