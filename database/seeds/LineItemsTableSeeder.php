<?php 

use App\Ticket;
use App\TicketInvoice;
use App\Inventory;
use App\LineItem;
use Illuminate\Database\Seeder;

/**
* 
*/
class LineItemsTableSeeder extends Seeder
{
	


	public function run()
	{
		$faker = Faker\Factory::create();

		$ticket_invoices = TicketInvoice::all()->lists('id');

		$inventory = Inventory::all()->lists('id');



		foreach (range(1, count($ticket_invoices)*12) as $index) {
			
			$inventory_id = $faker->unique()->randomElement($inventory);
			$ticket_id = Inventory::where('id',$inventory_id)->pluck('ticket_id');
			$sale_price = Ticket::where('id', $ticket_id)->pluck('price');
			$sale_cost = Ticket::where('id', $ticket_id)->pluck('cost');
			$ticket_invoice_id = $faker->randomElement($ticket_invoices);
			$created_at = TicketInvoice::where('id',$ticket_invoice_id)->pluck('sale_date');

			LineItem::create(
				[

				'ticket_invoice_id' => $ticket_invoice_id,
				'inventory_id' => $inventory_id,
				'sale_price' => $sale_price,
				'sale_cost' => $sale_cost,
				'created_at' => $created_at

				]);
				
		}
	}
}



