<?php 

use App\ElectronicProduct;
use Illuminate\Database\Seeder;

/**
* 
*/
class ElectronicProductsTableSeeder extends Seeder
{
	protected $file_dir = "http://salesmanager.dev/files/";
	protected $report_code;
	protected $start_term;
	protected $end_term;
	protected $source_file;
	protected $org_id;
	protected $priceOnReport;


	public function run()
	{
		$faker = Faker\Factory::create();

		//initialize configuration for Admissions
		$this->org_id = 1; 
		$this->report_code = 112;
		$this->start_term = "POS Buttons";
		$this->end_term = "Sub-Total:";
		$this->source_file = "112data.csv";
		$this->priceOnReport = true;

		//generate seed records
		$this->loadDataFromFile();

		//initialize configuration for Specials
		$this->org_id = 1; 
		$this->report_code = 113;
		$this->start_term = "Sales - Progressive Bingo";
		$this->end_term = "Sub-Total:";
		$this->source_file = "113data.csv";
		$this->priceOnReport = false;

		//generate seed records
		$this->loadDataFromFile();

		$this->org_id = 2; 
		$this->report_code = 112;
		$this->start_term = "POS Buttons";
		$this->end_term = "Sub-Total:";
		$this->source_file = "112_cbt_data.csv";
		$this->priceOnReport = true;

		//generate seed records
		$this->loadDataFromFile();

		//initialize configuration for Specials
		$this->org_id = 2; 
		$this->report_code = 113;
		$this->start_term = "Progressive ";
		$this->end_term = "Sub-Total:";
		$this->source_file = "113_cbt_data.csv";
		$this->priceOnReport = false;

		//generate seed records
		$this->loadDataFromFile();

		$this->org_id = 2; 
		$this->report_code = 222;
		$this->start_term = "POS Buttons";
		$this->end_term = "Sub-Total:";
		$this->source_file = "Distrib_data_csv.csv";
		$this->priceOnReport = true;

		//generate seed records
		$this->loadDataFromFile();
		
			
	}

	private function loadDataFromFile()
	{
		$rows = [];
		$file = fopen($this->file_dir . $this->source_file, "r");
		while(! feof($file))
		  {
		  $rows[]=(fgetcsv($file));
		  }

		fclose($file);

		$start_reading = false;
		$stop_reading = false;
	
		foreach ($rows as $row){

			if($row[0] == $this->start_term){$start_reading = true; continue;}
			if($start_reading && $row[0] == $this->end_term){$stop_reading = true; break;}

			if($start_reading)
			{
				ElectronicProduct::create(
				[
				'org_id' => $this->org_id,
				'name' => $row[0],
				'search_term' => $row[0],
				'price' => $this->priceOnReport ? str_replace('$','',$row[1]) : 1.0,
				'report_to_search' => $this->report_code
				]);
			}

		}
	}
	
}



