<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/Swm_front_end_controller.php");
class Swm_testload_data extends  Swm_front_end_controller{
	
	function __construct(){
		parent::__construct();
	}
    
	function test_data(){
		$this->load->model($this->model."M_swm_user","msu");
		$msu = $this->msu;
		$mpdf = new \Mpdf\Mpdf();
		// $mpdf->autoScriptToLang = true;
		$mpdf->useAdobeCJK = true;
		$mpdf->autoScriptToLang = true;
		$mpdf->autoLangToFont = true;
        ob_end_clean();
		
		$ses_data = $this->session->userdata('UsPsCode');
		$rs_person = $msu->get_data_hr($ses_data);
		if($rs_person->num_rows() > 0){
			$data['rs_ps'] = $rs_person->row();
		}else{
			$data['rs_ps'] = '';
		}
		// $data['rs_person'] = $rs_person;
		
		// $this->session->userdata('UsPsCode');
		// pre($rs_person);
		// $this->load->view($this->view."/TEST/test_pdf",$data);
		$x = $this->load->view($this->view."/TEST/test_pdf",$data,true);
		$mpdf->WriteHTML($x);
		$mpdf->Output();
		// echo $mslu->swm->last_query();
		
		// $this->output_frontend($this->view."/TEST/test",$data);
		// pre($data);	
    }
	
	
	
}
?>
