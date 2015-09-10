<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachineInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('machine_invoices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('org_id')->unsigned();
			$table->date('invoice_date');
			$table->decimal('total');
			$table->decimal('total_revenue');
			$table->decimal('total_specials');
			$table->decimal('percent_discount');
			$table->decimal('flat_rate');
			$table->decimal('dollar_discount');
			$table->decimal('total_after_discount');
			$table->boolean('reports_uploaded');
			$table->boolean('has_been_edited');
			$table->boolean('matches_str');
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
		Schema::drop('machine_invoices');
	}

}
