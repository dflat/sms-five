<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SyncPaperInvoiceTrigger extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()

    {
    	
         DB::unprepared(
         	'	
         	
            CREATE TRIGGER sync_paper_inventory_and_invoice_ai
			AFTER INSERT ON paper_line_items
			FOR EACH ROW
			BEGIN
				UPDATE paper_invoices SET total = (SELECT SUM(sale_price) 
				FROM paper_line_items
				WHERE paper_line_items.paper_invoice_id = paper_invoices.id);

         		UPDATE paper_inventory SET sold = 1 WHERE paper_inventory.id = new.inventory_id;

         		UPDATE paper_products SET qoh = (qoh-1) WHERE paper_products.id = (SELECT paper_product_id 
         			FROM paper_inventory WHERE paper_inventory.id = new.inventory_id);
         	END'
         
                   );

         DB::unprepared('
            CREATE TRIGGER sync_paper_inventory_and_invoice_ad
			AFTER DELETE ON paper_line_items
			FOR EACH ROW
			BEGIN
				UPDATE paper_invoices SET total = (SELECT SUM(sale_price) 
				FROM paper_line_items
				WHERE paper_line_items.paper_invoice_id = paper_invoices.id);

         		UPDATE paper_inventory SET sold = 0 WHERE paper_inventory.id = old.inventory_id;

         		UPDATE paper_products SET qoh = (qoh+1) WHERE paper_products.id = (SELECT paper_product_id 
         			FROM paper_inventory WHERE paper_inventory.id = old.inventory_id);
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
         DB::unprepared('DROP TRIGGER sync_paper_inventory_and_invoice_ai');
          DB::unprepared('DROP TRIGGER sync_paper_inventory_and_invoice_ad');
    }

}
