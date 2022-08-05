<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsletterParceiroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_parceiro', function (Blueprint $table) {
            $table->unsignedBigInteger('newsletter_id');
            $table->unsignedBigInteger('parceiro_id');
            $table->foreign('newsletter_id')->references('id')->on('newsletters');
            $table->foreign('parceiro_id')->references('id')->on('parceiros');
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
        Schema::dropIfExists('newsletter_parceiro');
    }
}
