<!--
*
*Swm_show_service
*controller main
*@author Tiwakorn Hedmuin
*@Create Date 2562-05-17
*
--> 
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/Swm_front_end_controller.php");
class Swm_show_service extends  Swm_front_end_controller{

    public $code;
    public $time;
    public $date;

    function __construct(){
        parent::__construct();
    }
    /* 
	*show data service of user
	*input  ps_id of user
	*output information service of user
	*@author Yaowapa Pongpadcha
	*@Create Date 2562-05-18	
	*/
	public function show_service()
    { 
        $data['header_title'] = "";
        $this->load->model('swm/frontend/M_swm_attend','m_attend');
        $m_attend = $this->m_attend;
        $session_id = ($this->session->userdata('UsPsCode')) ? $this->session->userdata('UsPsCode') : 0;
        $rs_data_service = $m_attend->get_data_service($session_id);
		
       //pre($rs_data_service->result());
        $data['rs_data_service'] = $rs_data_service;

        $this->output_frontend("swm/frontend/history/v_show_service",$data);
    }
}
?>