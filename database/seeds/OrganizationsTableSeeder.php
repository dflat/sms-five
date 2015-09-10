<?php 

use App\Organization;
use Illuminate\Database\Seeder;

/**
* 
*/
class OrganizationsTableSeeder extends Seeder
{
	public function run()
	{
		$faker = Faker\Factory::create();

		$rows = [];

		$file = fopen("http://salesmanager.dev/files/db csv files/Charity.txt","r");
		while(! feof($file))
		  {
		  $rows[]=(fgetcsv($file));
		  }

		fclose($file);

		foreach ($rows as $row){
			Organization::create(
			[
			'name' => $row[0],
			'address' => $row[2],
			'city' => $row[3],
			'state' => $row[4],
			'zip' => $row[5],
			'license' => $row[6],
			'dcg' => $row[7],
			'discount' => $row[8],

			]);
		}
	}

	// public function run()
	// {
			
	// 		Organization::create(
	// 			[

	// 			'name' => 'Jerusalem Connection',
	// 			'license' => 'L1245',
	// 			'address' => '123 Fake Street',
	// 			'zip' => '23220'

	// 			]);
	// 		Organization::create(
	// 			[

	// 			'name' => 'CBT',
	// 			'license' => 'L1245',
	// 			'address' => '123 Fake Street',
	// 			'zip' => '23220'

	// 			]);
	// 		Organization::create(
	// 			[

	// 			'name' => 'Richmond Gymnastics',
	// 			'license' => 'L1245',
	// 			'address' => '123 Fake Street',
	// 			'zip' => '23220'

	// 			]);
	// 		Organization::create(
	// 			[

	// 			'name' => 'VIGS',
	// 			'license' => 'L1245',
	// 			'address' => '123 Fake Street',
	// 			'zip' => '23220'

	// 			]);
	// 		Organization::create(
	// 			[

	// 			'name' => 'St. Joseph',
	// 			'license' => 'L1245',
	// 			'address' => '123 Fake Street',
	// 			'zip' => '23220'

	// 			]);
	// 		Organization::create(
	// 			[

	// 			'name' => 'Ahepa',
	// 			'license' => 'L1245',
	// 			'address' => '123 Fake Street',
	// 			'zip' => '23220'

	// 			]);
	// 		Organization::create(
	// 			[

	// 			'name' => 'FC Richmond',
	// 			'license' => 'L1245',
	// 			'address' => '123 Fake Street',
	// 			'zip' => '23220'

	// 			]);
				
	// }
}




