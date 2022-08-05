<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateFotosTable.
 */
class CreateFotosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fotos', function(Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('foto_path');
            $table->string('origin_name');
            $table->string('foto_thumb');
            $table->string('using');
            $table->string('legenda')->nullable();
            $table->string('credito')->nullable();
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
		Schema::drop('fotos');
	}
}
