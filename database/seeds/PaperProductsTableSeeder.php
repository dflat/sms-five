<?php 

use App\PaperProduct;
use Illuminate\Database\Seeder;

/**
* 
*/
class PaperProductsTableSeeder extends Seeder
{
	public function run()
	{
		$faker = Faker\Factory::create();

		$rows = [];

		$publicPath = public_path();

		$file = fopen($publicPath . "/files/db csv files/Paper Information.txt","r");
		// while(! feof($file))
		//   {
		  while($rows[]=(fgetcsv($file))){};
		  // }

		fclose($file);

		foreach ($rows as $row){

			$price = substr($row[6],1);

			PaperProduct::create(
			[
			'name' => $row[1],
			'form' => $row[0],
			'price' => (float)$price,
			'cost' => 4.99,
			'sheet_count' => (int)$row[5],
			'sheets_up' => $row[2],
			'faces_on' => $row[3],
			'color' => $row[4],
			'qoh' => 0
			]);
		}
			
	}
	
}



