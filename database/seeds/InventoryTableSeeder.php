<?php 

use App\Ticket;
use App\Inventory;
use Illuminate\Database\Seeder;

/**
* 
*/
class InventoryTableSeeder extends Seeder
{
	
	public function run()
	{
		$faker = Faker\Factory::create();
		$tickets = Ticket::all()->lists('id');


		foreach (range(1,3000) as $index) {
			
			Inventory::create(
				[

				'ticket_id' => $faker->randomElement($tickets),
				'serial' => $faker->randomNumber(6)

				]);
				
		}
	}
}



