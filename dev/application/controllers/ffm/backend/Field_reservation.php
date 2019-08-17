<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// require(dirname(__FILE__).'/../../../UMS_Controller.php'); //สำหรับ Camp ที่หอ
require(dirname(__FILE__).'/../../UMS_Controller.php'); //สำหรับ Camp
/*
* Controller Field_reservation
* @Auther : Jiramate Phuaphan
* @Edit Last Date : 
*/
class Field_reservation extends UMS_Controller {
	public $path;
	public $data;
	function __construct(){
		parent::__construct();
		if(base_url() == "https://10.80.39.16/Camp/"){
			$this->path = "/60160157/ffm/backend";
			$this->data['dir'] = "/60160157/ffm/backend";
		}else if(base_url() == "http://10.80.39.251/ossd/"){
			$this->path = "/ffm/backend"; //แก้ชื่อตรงนี้ เช่น backend_ชื่อเล่น
			$this->data['dir'] = "/ffm/backend"; //แก้ชื่อตรงนี้ เช่น backend_ชื่อเล่น
		}
	}

	function index(){
		$this->v_request_list();
	}

	function v_request_list()
	{
		$field = NULL;
		$date = NULL;
		$temp = $this->input->post('date');
		if(isset($temp)){
			$field = $this->input->post('field');
			$date = $this->input->post('date');

			list($mm, $dd, $yy) = preg_split("[/|-]", $date);
			$yy -= 543;
			$date =  $yy.'-'.$mm.'-'.$dd;
			$this->data['rs_date'] = $dd.'/'.$mm.'/'.$yy;
		}
		$this->load->model($this->path.'/M_field_reservation', 'mfr');
		$this->load->model($this->path.'/M_football_field', 'mff');
		$this->data['rs_rsv'] = $this->mfr->get_data_reservation($field,$date)->result(); 
		$this->data['rs_opt'] = $this->mff->get_options()->result(); 
		$this->output($this->path.'/v_request_list',$this->data);
	}

	function update_status($status,$id,$date){	
		$this->load->model( $this->path.'/M_field_reservation' , 'mfr' ) ;
		$this->mfr->fr_id = $id;
		$this->mfr->update_status($status, $date);
		redirect($this->path.'/Field_reservation/v_request_list');
	}

	function get_detail($id){
		$this->load->model($this->path.'/M_field_reservation', 'mfr');
		$fr_id = $this->input->post("fre");
		$qs = $this->mfr->get_data_for_reservation_by_id($id)->result();
		echo json_encode($qs);
	}
}
?>