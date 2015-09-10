<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticket_invoices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('organization_id')->unsigned();
			$table->date('sale_date');
			$table->decimal('total');
			$table->timestamps();

			$table->foreign('organization_id')
					->references('id')
					->on('organizations')
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
		Schema::drop('ticket_invoices');
	}

}
