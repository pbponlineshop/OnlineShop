<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id_trans');
            $table->float('ongkir');
            $table->timestamp('tgl_trans');
            $table->string('status');
            $table->bigInteger('id_cust');
            $table->bigInteger('no_seri');
            $table->foreign('id_cust')->references('id_cust')->on('customers');
            $table->foreign('no_seri')->references('no_seri')->on('kodevouchers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
