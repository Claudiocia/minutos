<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateNewsletterNoticiasTable.
 */
class CreateNewsletterNoticiasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('newsletter_noticias', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('editoria');
            $table->unsignedBigInteger('newsletter_id');
            $table->unsignedBigInteger('noticia_id');
            $table->foreign('newsletter_id')->references('id')->on('newsletters');
            $table->foreign('noticia_id')->references('id')->on('noticias');
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
		Schema::drop('newsletter_noticias');
	}
}
