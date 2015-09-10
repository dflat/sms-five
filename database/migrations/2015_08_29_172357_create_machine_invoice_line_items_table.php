<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachineInvoiceLineItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('machine_invoice_line_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('line_name');
			$table->integer('machine_invoice_id')->unsigned();
			$table->integer('electronic_product_id')->unsigned();
			$table->integer('sub_product_id')->unsigned();
			$table->decimal('price');
			$table->integer('sold_count');
			$table->boolean('is_fee');
			$table->timestamps();

			$table->foreign('machine_invoice_id')
					->references('id')
					->on('machine_invoices')
					->onDelete('cascade');

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
		Schema::drop('machine_invoice_line_items');
	}

}
