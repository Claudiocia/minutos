<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSitesTable.
 */
class CreateSitesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sites', function(Blueprint $table) {
            $table->id();
            $table->string('title_site');
            $table->string('apoio_title');
            $table->text('text_abert');
            $table->string('site_final');
            $table->string('text_botton_site');
            $table->string('cancel_one');
            $table->string('cancel_two');
            $table->string('title_razion');
            $table->string('apoio_razion')->nullable();
            $table->string('title_causa');
            $table->string('apoio_causa');
            $table->text('text_causa');
            $table->string('causa_final');
            $table->string('title_review');
            $table->string('apoio_review')->nullable();
            $table->string('title_cta');
            $table->string('apoio_cta')->nullable();
            $table->string('title_footer');
            $table->text('text_footer');
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
		Schema::drop('sites');
	}
}
