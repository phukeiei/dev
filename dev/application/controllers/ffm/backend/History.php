<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// require(dirname(__FILE__).'/../../../UMS_Controller.php'); //สำหรับ Camp ที่หอ
require(dirname(__FILE__).'/../../UMS_Controller.php'); //สำหรับ Camp
/*
* Controller History
* @Auther : Jiramate Phuaphan
* @Edit Last Date : 
*/
class History extends UMS_Controller {
	public $path;
	public $data;
	function __construct(){
		parent::__construct();
		if(base_url() == "https://10.80.39.16/Camp/"){
			$this->path = "/60160157/ffm/backend";
			$this->data['dir'] = "/6016	0157/ffm/backend";
		}else if(base_url() == "http://10.80.39.251/ossd/"){
			$this->path = "/ffm/backend"; //แก้ชื่อตรงนี้ เช่น backend_ชื่อเล่น
			$this->data['dir'] = "/ffm/backend"; //แก้ชื่อตรงนี้ เช่น backend_ชื่อเล่น
		}
	}

	///////////////////////////////////////////////////////////////////////////////////////////

	function index(){
		$this->v_history();
	}

	function v_history()
	{
		$this->output($this->path.'/v_history_menu',$this->data);
	}	

	//กัน ประวัติผู้ใช้
	function v_history_user()
	{
		$this->load->model($this->path.'/M_field_reservation', 'mfr');
		$this->data['rs_user'] = $this->mfr->get_result_reservation()->result();
		foreach($this->data['rs_user'] as $row){
			$row->receive = sizeof($this->mfr->get_result_reservation_accep($row->fr_first_name)->result());
		}
		$this->output($this->path.'/v_history_user',$this->data);
	}

	
	function v_history_user_profile()
	{
		$this->output($this->path.'/v_history_user_profile',$this->data);
	}

	//นพ
	function v_history_field()
	{
		$this->load->model($this->path.'/M_football_field', 'mff');
		$this->load->model($this->path.'/M_hr_district', 'hrd');

		$mff = $this->mff;
		$hrd = $this->hrd;
		$data['ff_tm'] = $this->mff->time_count()->result(); 
		$data['ff_pp'] = $this->mff->pp_count()->result(); 
		//   echo $this->mff->ffm->last_query();die;  


	// 	if( $this->input->post('type_user')==245){

	// 		$hrd->dist_id = 7052;
	// 		$this->data['hr_all'] = $this->hrd->get_bapa($hrd->dist_idt)->result(); 
	// 	}elseif($this->input->post('type_user')=='out'){

	// 		$this->data['hr_all'] = $this->hrd->get_not_bapa()->result(); 
	// 	}else{
			
	// 		$this->hrd->dist_id = 7052;
	// 		$data['hr_all'] = $this->hrd->get_table()->result(); 
	// 	}
		
	// //	$this->data['ff_user'] = $this->mff->get_user_in_field()->result(); 
	// 	$this->data['ff_all'] = $this->mff->get_table()->result(); 
	$data['dir'] = "ffm/backend";
		$this->output($this->path.'/v_history_field',$data);
	}

	//นพ
	function v_history_income()
	{
		$this->load->model($this->path.'/M_field_reservation', 'mgd');
		
		$mgd = $this->mgd;
		
		
		$data['fd_date'] = $this->mgd->find_date()->result(); 
		
		$data['dir'] = "ffm/backend";
		$this->output($this->path.'/v_history_income',$data);
	}
}//end class
?>