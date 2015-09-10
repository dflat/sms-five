<?php 

use App\PaperProduct;
use App\PaperInvoice;
use App\PaperInventory;
use App\PaperLineItem;
use Illuminate\Database\Seeder;

/**
* 
*/
class PaperLineItemsTableSeeder extends Seeder
{
	


	public function run()
	{
		$faker = Faker\Factory::create();

		$paper_invoices = PaperInvoice::all()->lists('id');

		$inventory = PaperInventory::all()->lists('id');



		foreach (range(1, count($paper_invoices)*6) as $index) {
			
			$inventory_id = $faker->unique()->randomElement($inventory);
			$paper_product_id = PaperInventory::where('id',$inventory_id)->pluck('paper_product_id');
			$sale_price = PaperProduct::where('id', $paper_product_id)->pluck('price');
			$sale_cost = PaperProduct::where('id', $paper_product_id)->pluck('cost');
			$paper_invoice_id = $faker->randomElement($paper_invoices);
			$created_at = PaperInvoice::where('id',$paper_invoice_id)->pluck('sale_date');

			PaperLineItem::create(
				[

				'paper_invoice_id' => $paper_invoice_id,
				'inventory_id' => $inventory_id,
				'sale_price' => $sale_price,
				'sale_cost' => $sale_cost,
				'created_at' => $created_at

				]);
				
		}
	}
}



