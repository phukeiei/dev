<?php

/*
*
*Swm_report_attend
*controller 
*@author Manita Doungrassamee
*@Create Date 2562-05-20
* 
*/ 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/Swm_front_end_controller.php");
class Swm_report_attend extends  Swm_front_end_controller{

    public $code;
    public $time;
    public $date;

    function __construct(){
        parent::__construct();
    }

	public function show_report_attend()
    { 
        $data['header_title'] = "";
        $this->load->model('swm/frontend/M_swm_attend','m_attend');
        $m_attend = $this->m_attend;
        $rs_data_service = $m_attend->get_time_us_attend();
        $data['rs_data_service'] = $rs_data_service->result();
        $this->output("swm/frontend/v_report_t",$data);
    }
	
	public function show_tam_nut()
    { 
        $this->output_frontend("swm/frontend/test_tam_nut");
    }
}
?>