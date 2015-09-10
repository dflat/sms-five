<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachineReportLineItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('machine_report_line_items', function(Blueprint $table)
		{
			$table->increments('id');
				$table->integer('machine_report_id')->unsigned();
				$table->integer('electronic_product_id')->unsigned();
				$table->integer('report_code');
				$table->integer('sold_count');
				$table->integer('void_count');
				$table->integer('net_count');
				$table->decimal('sold_sales');
				$table->decimal('void_sales');
				$table->decimal('net_sales');

				$table->timestamps();

				$table->foreign('machine_report_id')
						->references('id')
						->on('machine_reports')
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
			Schema::drop('machine_report_line_items');
	}

}
