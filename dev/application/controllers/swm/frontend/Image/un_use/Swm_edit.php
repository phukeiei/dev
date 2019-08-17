<?php
/*
*
*show_form_edit
*controller Swm_editshow_form_edit
*@author Chanikan Khamruang
*@Create Date 2562-05-18
*
*/
 if (! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/Swm_front_end_controller.php");
class Swm_edit extends  Swm_front_end_controller{
	
/*
*
*form_edit
*input_form_edit
*input 
*output -
*@Create Date 2562-05-17
*
*/
	public function form_edit()
	{
		$this->load->model("swm/frontend/M_swm_user", "msu");
		$data["opt_prefix"] = $this->msu->get_options_prefix("N");
		pre($data["opt_prefix"]);
		$data['header_title'] = "";
		$this->output_frontend("swm/frontend/v_form_edit",$data, true);
	}	
}
	