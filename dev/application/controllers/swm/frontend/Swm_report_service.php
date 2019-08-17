 <?php
/*
*
*Swm_report_service
*controller show_report_service
*@author Tiwakorn Hedmuin
*@Create Date 2562-05-20
*
*/

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/Swm_front_end_controller.php");
class Swm_report_service extends  Swm_front_end_controller{
	
	
/*
*
*show_report_service
*load view report service
*@author Tiwakorn Hedmuin
*@Create Date 2562-05-20
*
*/
	public function show_report_service()
    { 
        $this->load->model("swm/frontend/M_swm_attend", "msa");
        $rs_service_data = $this->msa->get_time_us_attend(getNowDate(),getNowDate());//startDate, endDate, startAge, endAge, state
        $data['rs_service_data'] = $rs_service_data->result();
        $this->output("swm/frontend/v_report_service", $data, true);
    }

    public function update_table_report(){
        $startDate = splitDateForm1($this->input->post("startDate"));
        $endDate = splitDateForm1($this->input->post("endDate"));
        $startAge = $this->input->post("startAge");
        $endAge =$this->input->post("endAge");
        $state = ($this->input->post("su_state") == 2)? $this->input->post("su_state"):"1,3,4";
        $this->load->model("swm/frontend/M_swm_attend", "msa");
        $rs_service_data = $this->msa->get_time_us_attend($startDate, $endDate, $startAge, $endAge, $state);//startDate, endDate, startAge, endAge, state
        $data['rs_service_data'] = $rs_service_data->result();
        $this->output("swm/frontend/v_report_service", $data, true);
    }

	
}