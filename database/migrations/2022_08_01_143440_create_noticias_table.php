<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateNoticiasTable.
 */
class CreateNoticiasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('noticias', function(Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('resumo');
            $table->text('texto');
            $table->string('fonte');
            $table->string('link')->nullable();
            $table->dateTime('data_cria');
            $table->dateTime('data_edit')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('noticias');
	}
}
