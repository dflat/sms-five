<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SyncTicketInvoiceTrigger extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()

    {
    	
         DB::unprepared(
         	'	
         	
            CREATE TRIGGER sync_inventory_and_invoice_ai
			AFTER INSERT ON line_items
			FOR EACH ROW
			BEGIN
				UPDATE ticket_invoices SET total = (SELECT SUM(sale_price) 
				FROM line_items
				WHERE line_items.ticket_invoice_id = ticket_invoices.id);

         		UPDATE inventory SET sold = 1 WHERE inventory.id = new.inventory_id;

         		UPDATE tickets SET qoh = (qoh-1) WHERE tickets.id = (SELECT ticket_id 
         			FROM inventory WHERE inventory.id = new.inventory_id);
         	END'
         
                   );

         DB::unprepared('
            CREATE TRIGGER sync_inventory_and_invoice_ad
			AFTER DELETE ON line_items
			FOR EACH ROW
			BEGIN
				UPDATE ticket_invoices SET total = (SELECT SUM(sale_price) 
				FROM line_items
				WHERE line_items.ticket_invoice_id = ticket_invoices.id);

         		UPDATE inventory SET sold = 0 WHERE inventory.id = old.inventory_id;

         		UPDATE tickets SET qoh = (qoh+1) WHERE tickets.id = (SELECT ticket_id 
         			FROM inventory WHERE inventory.id = old.inventory_id);
         	END'		
                   );
     }


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
    {
         DB::unprepared('DROP TRIGGER sync_inventory_and_invoice_ai');
          DB::unprepared('DROP TRIGGER sync_inventory_and_invoice_ad');
    }

}
