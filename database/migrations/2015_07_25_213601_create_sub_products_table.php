<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sub_products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('electronic_product_id')->unsigned();
			$table->string('name');
			$table->decimal('price');
			$table->integer('quanity');
			$table->boolean('on_str');
			

			$table->timestamps();

			$table->foreign('electronic_product_id')
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
		Schema::drop('sub_products');

	}

}
