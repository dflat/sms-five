<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaperLineItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paper_line_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('paper_invoice_id')->unsigned();
			$table->integer('inventory_id')->unsigned();
			$table->decimal('sale_price');
			$table->decimal('sale_cost');


			$table->timestamps();

			$table->foreign('paper_invoice_id')
					->references('id')
					->on('paper_invoices')
					->onDelete('cascade');

			$table->foreign('inventory_id')
					->references('id')
					->on('paper_inventory')
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
		Schema::drop('paper_line_items');
	}

}
