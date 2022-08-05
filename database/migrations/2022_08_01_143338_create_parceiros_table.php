<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateParceirosTable.
 */
class CreateParceirosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parceiros', function(Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('site');
            $table->string('cnpj');
            $table->string('tele');
            $table->string('end');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('uf');
            $table->string('email');
            $table->string('slogan');
            $table->dateTime('data_ini');
            $table->dateTime('data_fim');
            $table->bigInteger('foto_id')->unsigned()->nullable();
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
		Schema::drop('parceiros');
	}
}
