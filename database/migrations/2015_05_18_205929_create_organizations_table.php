<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('organizations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('license');
			$table->string('address');
			$table->string('city');
			$table->string('state');
			$table->string('zip');
			$table->string('dcg');
			$table->decimal('discount');
			$table->string('start_term_112');
			$table->string('start_term_113');
			$table->string('start_term_222');
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
		Schema::drop('organizations');
	}

}
