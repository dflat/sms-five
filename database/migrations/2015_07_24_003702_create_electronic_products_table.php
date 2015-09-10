<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectronicProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('electronic_products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('org_id')->unsigned();
			$table->string('name');
			$table->string('search_term');
			$table->decimal('price');
			$table->string('report_to_search');
			$table->boolean('on_str');
			
			

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
		Schema::drop('electronic_products');
	}

}
