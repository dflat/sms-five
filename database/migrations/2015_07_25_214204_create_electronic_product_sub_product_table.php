<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectronicProductSubProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('electoronic_product_sub_product', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('electronic_product_id')->unsigned();
			$table->integer('sub_product_id')->unsigned();
			$table->integer('quantity_contained');


			$table->timestamps();

			$table->foreign('electronic_product_id')
					->references('id')
					->on('electronic_products')
					->onDelete('cascade');

			$table->foreign('sub_product_id')
					->references('id')
					->on('sub_products')
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
		Schema::drop('electoronic_product_sub_product');
	}

}
