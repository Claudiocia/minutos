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
            $table->string('site_nome');
            $table->string('title_site')->nullable();
            $table->string('apoio_title')->nullable();
            $table->text('text_abert')->nullable();
            $table->string('site_final')->nullable();
            $table->string('text_botton_site')->nullable();
            $table->string('cancel_one')->nullable();
            $table->string('cancel_two')->nullable();
            $table->string('title_razion')->nullable();
            $table->string('apoio_razion')->nullable();
            $table->string('title_causa')->nullable();
            $table->string('apoio_causa')->nullable();
            $table->text('text_causa')->nullable();
            $table->string('causa_final')->nullable();
            $table->string('title_review')->nullable();
            $table->string('apoio_review')->nullable();
            $table->string('title_cta')->nullable();
            $table->string('apoio_cta')->nullable();
            $table->string('final_cta')->nullable();
            $table->string('title_footer')->nullable();
            $table->text('text_footer')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
