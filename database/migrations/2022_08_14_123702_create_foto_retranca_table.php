<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoRetrancaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_retranca', function (Blueprint $table) {
            $table->unsignedBigInteger('foto_id');
            $table->foreign('foto_id')->references('id')->on('fotos');
            $table->unsignedBigInteger('retranca_id');
            $table->foreign('retranca_id')->references('id')->on('retrancas');
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
        Schema::dropIfExists('foto_retranca');
    }
}
