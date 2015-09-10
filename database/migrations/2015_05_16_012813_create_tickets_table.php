<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('name');
			$table->string('form')->unique();
			$table->decimal('cost');
			$table->decimal('price');
			$table->integer('ticket_count');
			$table->decimal('take_in');
			$table->decimal('pay_out');
			$table->integer('qoh');
			$table->integer('reorder_point');
			$table->string('vendor');

			$table->timestamps();

			$table->foreign('user_id')
					->references('id')
					->on('users')
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
		Schema::drop('tickets');
	}

}
