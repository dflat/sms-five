<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateTransactionReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('state_transaction_reports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('org_id')->unsigned();
			$table->date('report_date');
			$table->decimal('total');
			
			$table->timestamps();

			$table->foreign('org_id')
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
		Schema::drop('state_transaction_reports');
	}

}
