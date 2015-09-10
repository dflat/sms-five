<?php namespace App\library {

use App\StateTemplate;
use App\MachineReportLineItem;

    class StateReportGenerator {

    	protected $str_template;
    	protected $sales_data;
    	protected $org_id;
    	protected $invoice_no;

    	public function __construct($org_id, $invoice_no){
    		//$org_id=2;

    		$this->org_id = $org_id;
    		$this->invoice_no = $invoice_no;
    		$this->str_template = StateTemplate::where('org_id', $this->org_id)->get();

    		$this->sales_data = MachineReportLineItem::where('machine_report_id',$this->invoice_no)->get();

    	}

    	public function generate(){

    		foreach ($this->str_template as $template_line) {
    			$current_str_id = $template_line->id;
    			$matching_report_items = MachineReportLineItem::where()

    		}
    	}

    	public function fillStrLine($current_str_line){

    	}

        public function test() {
            return $this->sales_data;



        }
    }
}

?>