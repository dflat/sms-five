<?php 

use App\PaperProduct;
use App\PaperInventory;
use Illuminate\Database\Seeder;

/**
* 
*/
class PaperInventoryTableSeeder extends Seeder
{
	
	public function run()
	{
		$faker = Faker\Factory::create();
		$tickets = PaperProduct::all()->lists('id');


		foreach (range(1,1000) as $index) {
			
			PaperInventory::create(
				[

				'paper_product_id' => $faker->randomElement($tickets),
				'serial' => $faker->randomNumber(6),
				'permutation' => $faker->randomNumber(3)

				]);
				
		}
	}
}



