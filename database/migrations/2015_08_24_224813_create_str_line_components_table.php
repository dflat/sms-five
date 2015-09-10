<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStrLineComponentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('str_line_components', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('state_template_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->integer('product_count');
			$table->timestamps();

			$table->foreign('state_template_id')
					->references('id')
					->on('state_templates')
					->onDelete('cascade');

			$table->foreign('product_id')
					->references('id')
					->on('electronic_products')
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
		Schema::drop('str_line_components');
	}

}
