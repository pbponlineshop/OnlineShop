<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKodevouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kodevouchers', function (Blueprint $table) {
            $table->bigIncrements('no_seri');
            $table->boolean('status');
            $table->bigInteger('id_voucher');
            $table->foreign('id_voucher')->references('id_voucher')->on('vouchers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kodevouchers');
    }
}
