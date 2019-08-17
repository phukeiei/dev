<!-- 
*Report_income
*view v_report_income
*@author Israpong Jenkan
@create Date 2562-05-21
-->
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/Swm_front_end_controller.php");
class  Swm_report_income extends  Swm_front_end_controller{
	
	function __construct(){
        	parent::__construct();
        	$this->user = $this->session->all_userdata();
    }
	
	function show_report_income(){
		$this->load->model("swm/frontend/M_swm_status", "mst");
		
		$this->output($this->view."v_report_income");
	}
}
?>