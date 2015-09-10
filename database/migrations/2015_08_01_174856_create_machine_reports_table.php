<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachineReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('machine_reports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('org_id')->unsigned();
			$table->integer('machine_invoice_id')->unsigned();
			$table->decimal('total');
			$table->date('report_date');

			$table->timestamps();

			$table->foreign('org_id')
					->references('id')
					->on('organizations')
					->onDelete('cascade');

			$table->foreign('machine_invoice_id')
					->references('id')
					->on('machine_invoices')
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
		Schema::drop('machine_reports');
	}

}
