<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTemplateComponentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_template_components', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('invoice_template_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->integer('product_count');
			$table->timestamps();

			$table->foreign('invoice_template_id')
					->references('id')
					->on('invoice_templates')
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
		Schema::drop('invoice_template_components');
	}

}
