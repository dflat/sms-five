<?php 

use App\Organization;
use App\TicketInvoice;
use App\PaperInvoice;
use App\MachineInvoice;
use App\MachineReport;
use App\StateTransactionReport;
use Illuminate\Database\Seeder;

/**
* 
*/
class TicketAndPaperInvoicesTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker\Factory::create();
		$organizations = Organization::all()->lists('id');


		foreach (range(1,50) as $index) {
			
			$org_id = $faker->randomElement($organizations);
			$sale_date = $faker->dateTimeBetween('now','+1 year');

			TicketInvoice::create(
				[

				'organization_id' => $org_id,
				'sale_date' => $sale_date,

				]);
			PaperInvoice::create(
				[

				'organization_id' => $org_id,
				'sale_date' => $sale_date,

				]);
			MachineInvoice::create(
				[

				'org_id' => $org_id,
				'invoice_date' => $sale_date,

				]);
			MachineReport::create(
				[

				'org_id' => $org_id,
				'report_date' => $sale_date,
				'machine_invoice_id' => $index,

				]);
			StateTransactionReport::create(
				[

				'org_id' => $org_id,
				'report_date' => $sale_date,

				]);
				
		}
	}
}



