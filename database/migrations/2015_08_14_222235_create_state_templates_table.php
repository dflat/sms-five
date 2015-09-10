<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('state_templates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('org_id')->unsigned();
			$table->string('line_name');
			$table->integer('electronic_product_id')->unsigned();
			$table->integer('sub_product_id')->unsigned();
			$table->decimal('price');
			$table->timestamps();

			$table->foreign('org_id')
					->references('id')
					->on('organizations')
					->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('state_templates');
	}

}
