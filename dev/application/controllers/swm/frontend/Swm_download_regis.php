<!--
*
*Swm_download_regis
*controller download_regis
*@author Pattarakorn Pamornchart ,Khwanchai Nontawichit
*@Create Date 2562-05-17
*
-->
<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/Swm_front_end_controller.php");
class Swm_download_regis extends  Swm_front_end_controller{
	
	public $user; 
	
	/*
	*__construct
	*input -
	*output -
	*@Create Date 2562-05-17
	*/
	function __construct(){
        parent::__construct();
        //$this->swm = $this->load->database('swm',true);      
    } 
	
	
	/*
	*show_form_print_register
	*input -
	*output Show register form
	*@author Khwanchai Nontawichit ,Pattarakorn Pamornchart
	*Create Date 2562-05-17 
	*/
	public function show_form_print_register()
	{
		$this->load->model("swm/frontend/M_swm_user","msu");
		//DB_Main
		$id_user = ($this->session->userdata('UsPsCode')) ? $this->session->userdata('UsPsCode') : 0;
		$rs_ps_data = $this->msu->get_data_hr($id_user)->result();
		$data['rs_ps_data'] = $rs_ps_data;
		//DB_sub
		$msu = $this->msu;
		$this->msu->su_ps_id = $this->session->userdata("UsPsCode");
		$rs_su_data = $this->msu->get_by_ps_id()->result();//$rs_su_data = $query	
		$data['rs_su_data'] = $rs_su_data;
		$this->output_frontend("swm/frontend/v_form_print_register", $data, true);
		
		
	}
	/*
	*show_form_print_register
	*input -
	*output Show register form
	*@author Pattarakorn Pamornchart ,Khwanchai Nontawichit 
	*Create Date 2562-05-17 
	*/
	public function export_form_register()
	{
		$this->load->model("swm/frontend/M_swm_user","msu");
		$msu = $this->msu;
		$mpdf = new \Mpdf\Mpdf();
		// $mpdf->autoScriptToLang = true;
		$mpdf->useAdobeCJK = true;
		$mpdf->autoScriptToLang = true;
		$mpdf->autoLangToFont = true;
        ob_end_clean();
		
		
		//DB_Main
		 $id_user = ($this->session->userdata('UsPsCode')) ? $this->session->userdata('UsPsCode') : 0;
		$rs_ps_data = $this->msu->get_data_hr($id_user)->result();
		$data['rs_ps_data'] = $rs_ps_data;
		//DB_sub
		$msu = $this->msu;
		$this->msu->su_ps_id = $this->session->userdata("UsPsCode");
		$rs_su_data = $this->msu->get_by_ps_id()->result();//$rs_su_data = $query	
		$data['rs_su_data'] = $rs_su_data;
		
		$x = $this->load->view($this->view."/v_form_export_register.php",$data,true);
		$mpdf->WriteHTML($x);
		$mpdf->Output();
		//$this->output_fancy("swm/frontend/v_form_export_register",$data,true);
	}
	
	
		
		
	
}
	