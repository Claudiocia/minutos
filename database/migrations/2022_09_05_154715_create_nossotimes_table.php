<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateNossotimesTable.
 */
class CreateNossotimesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nossotimes', function(Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('funcao');
            $table->text('texto');
            $table->string('twitter')->nullable();
            $table->string('face')->nullable();
            $table->string('insta')->nullable();
            $table->string('linked')->nullable();
            $table->enum('ativo', ['s', 'n'])->default('n');
            $table->unsignedBigInteger('foto_id')->nullable();
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
		Schema::drop('nossotimes');
	}
}
