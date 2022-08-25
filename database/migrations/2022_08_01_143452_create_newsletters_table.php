<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateNewslettersTable.
 */
class CreateNewslettersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('newsletters', function(Blueprint $table) {
            $table->id();
            $table->text('abertura');
            $table->integer('num_seq')->nullable();
            $table->string('numb_edicao');
            $table->dateTime('data_edicao');
            $table->enum('enviada', ['s', 'n'])->default('n');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('newsletters');
	}
}
