<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRazionsTable.
 */
class CreateRazionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('razions', function(Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->string('texto');
            $table->string('title')->nullable();
            $table->enum('priori', ['s', 'n'])->default('n');
            $table->enum('ativo', ['s','n'])->default('n');
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->softDeletes();
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
		Schema::drop('razions');
	}
}
