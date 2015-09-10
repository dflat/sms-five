<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SyncMachineInvoiceTrigger extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    	
         DB::unprepared(
         	'	
         	
            CREATE TRIGGER sync_machine_invoice_ai
			AFTER INSERT ON state_transaction_line_items
			FOR EACH ROW
			BEGIN
				UPDATE state_transaction_reports SET total = (SELECT SUM(price * sold_count - price * void_count) 
				FROM state_transaction_line_items
				WHERE state_transaction_line_items.str_id = state_transaction_reports.id);

         	END'
         
                   );

         DB::unprepared('
            CREATE TRIGGER sync_machine_invoice_ad
			AFTER DELETE ON state_transaction_line_items
			FOR EACH ROW
			BEGIN
				UPDATE state_transaction_reports SET total = (SELECT SUM(price * sold_count - price * void_count) 
				FROM state_transaction_line_items
				WHERE state_transaction_line_items.str_id = state_transaction_reports.id);

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
         DB::unprepared('DROP TRIGGER sync_machine_invoice_ai');
          DB::unprepared('DROP TRIGGER sync_machine_invoice_ad');
    }

}
