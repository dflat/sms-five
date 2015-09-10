<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateTransactionLineItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('state_transaction_line_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('line_name');
			$table->integer('str_id')->unsigned();
			$table->integer('electronic_product_id')->unsigned();
			$table->integer('sub_product_id')->unsigned();
			$table->decimal('price');
			$table->integer('sold_count');
			$table->integer('void_count');
			$table->integer('report_code');
			$table->timestamps();

			$table->foreign('str_id')
					->references('id')
					->on('state_transaction_reports')
					->onDelete('cascade');

			$table->foreign('electronic_product_id')
					->references('id')
					->on('electronic_products')
					->onDelete('cascade');

			// $table->foreign('sub_product_id')
			// 		->references('id')
			// 		->on('sub_products')
			// 		->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('state_transaction_line_items');
	}

}
