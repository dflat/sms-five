<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('line_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ticket_invoice_id')->unsigned();
			$table->integer('inventory_id')->unsigned();
			$table->decimal('sale_price');
			$table->decimal('sale_cost');


			$table->timestamps();

			$table->foreign('ticket_invoice_id')
					->references('id')
					->on('ticket_invoices')
					->onDelete('cascade');

			$table->foreign('inventory_id')
					->references('id')
					->on('inventory')
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
		Schema::drop('line_items');
	}

}
