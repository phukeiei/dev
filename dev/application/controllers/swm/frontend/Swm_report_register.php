 <?php
/*
*
*Swm_report_register
*controller show_report_register
*@author Tiwakorn Hedmuin
*@Create Date 2562-05-20
*
*/

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/Swm_front_end_controller.php");
class Swm_report_register extends  Swm_front_end_controller{
	
	
/*
*
*show_report_register
*load view report register
*@author Tiwakorn Hedmuin ,Khwanchai Nontawichit
*@Create Date 2562-05-20
*
*/
	public function show_report_register()
    { 
		$this->load->model("swm/frontend/M_swm_status", "mst");
		$data["opt_status"] = $this->mst->get_all()->result();
		//$data['header_title'] = "";
        $this->output("swm/frontend/v_report_register",$data);
    }
	
	public function get_report_register()
	{
		$this->load->model("swm/frontend/M_swm_user","msu");
		$this->output("swm/frontend/v_report_register");
	}
}