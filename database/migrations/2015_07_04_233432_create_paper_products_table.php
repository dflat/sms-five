<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaperProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paper_products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('faces_on');
			$table->string('sheets_up');
			$table->string('color');
			$table->string('form')->unique();
			$table->decimal('price');
			$table->decimal('cost');
			$table->integer('sheet_count');
			$table->integer('qoh');
			$table->integer('reorder_point');
			$table->string('vendor');
			

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
			Schema::drop('paper_products');
	}

}
