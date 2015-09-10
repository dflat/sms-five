<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
		$this->call('OrganizationsTableSeeder');
		$this->call('TicketAndPaperInvoicesTableSeeder');
		$this->call('TicketTableSeeder');
		$this->call('PaperProductsTableSeeder');
		$this->call('PaperInventoryTableSeeder');
		$this->call('InventoryTableSeeder');
		$this->call('LineItemsTableSeeder');
		$this->call('PaperLineItemsTableSeeder');
		$this->call('ElectronicProductsTableSeeder');

	}

}

