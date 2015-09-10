<?php 

use App\Organization;
use App\PaperInvoice;
use Illuminate\Database\Seeder;

/**
* 
*/
class PaperInvoicesTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker\Factory::create();
		$organizations = Organization::all()->lists('id');


		foreach (range(1,50) as $index) {
			
			PaperInvoice::create(
				[

				'organization_id' => $faker->randomElement($organizations),
				'sale_date' => $faker->dateTimeBetween('now','+1 year'),

				]);
				
		}
	}
}



