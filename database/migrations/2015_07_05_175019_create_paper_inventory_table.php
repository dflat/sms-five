<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaperInventoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paper_inventory', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('paper_product_id')->unsigned();
			$table->string('serial');
			$table->string('permutation');
			$table->boolean('sold');
			$table->timestamps();

			$table->foreign('paper_product_id')
					->references('id')
					->on('paper_products')
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
		Schema::drop('paper_inventory');

	}

}
