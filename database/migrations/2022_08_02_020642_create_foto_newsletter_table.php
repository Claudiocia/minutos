<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoNewsletterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_newsletter', function (Blueprint $table) {
            $table->unsignedBigInteger('newsletter_id');
            $table->unsignedBigInteger('foto_id');
            $table->foreign('newsletter_id')->references('id')->on('newsletters');
            $table->foreign('foto_id')->references('id')->on('fotos');

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
        Schema::dropIfExists('foto_newsletter');
    }
}
