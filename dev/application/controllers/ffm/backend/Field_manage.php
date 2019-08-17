<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// require(dirname(__FILE__).'/../../../UMS_Controller.php'); //สำหรับ Camp ที่หอ
require(dirname(__FILE__).'/../../UMS_Controller.php'); //สำหรับ Camp
/*
* Controller Field_manage
* @Auther : Jiramate Phuaphan
* @Edit Last Date : 
*/
class Field_manage extends UMS_Controller {
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
		$this->v_manage_field_list();
	}

	function v_manage_field_list()
	{
		$this->load->model($this->path.'/M_football_field', 'mff');
		$this->data['rs'] = $this->mff->get_table()->result();	
		$this->output($this->path.'/v_manage_field_list',$this->data);
	}

	function v_manage_field_add()	
	{
		$this->output($this->path.'/v_manage_field_add',$this->data);
	}

	function v_price()	
	{
		$this->output($this->path.'/v_price',$this->data);
	}

	function v_manage_field_price($id)	
	{	
		$this->load->model($this->path.'/M_cost_config', 'mcc');
		$this->mcc->cc_ff_id = $id;
		// $this->data['rs_cost'] = $this->mcc->get_data_by_ff_id(1)->result();
		$this->load->model($this->path.'/M_football_field', 'mff');
		$this->mff->ff_id = $id;
		$this->data['rs_field'] = $this->mff->get_by_key()->result();
		$this->output($this->path.'/v_manage_field_price',$this->data);
	}
    
	/////////////// AM  19-0-2562 //////////////////////////
	function insert_field()
	{
		$this->load->model($this->path.'/M_football_field', 'mff');
			$mff = $this->mff;
			$mff->ff_id = "";
			$mff->ff_name = $this->input->post('ff_name');
			$mff->ff_size = $this->input->post('ff_size');
			$mff->ff_status = $this->input->post('ff_status');
			$mff->ff_user_update = $this->session->userdata('UsPsCode');
			$mff->insert();
		$this->index();
	}
	function update_field()
	{
		$this->load->model($this->path.'/M_football_field', 'mff');
			$mff = $this->mff;
			$mff->ff_id = $this->input->post('ff_id');
			$mff->ff_name = $this->input->post('ff_name');
			$mff->ff_size = $this->input->post('ff_size');
			$mff->ff_status = $this->input->post('ff_status');
			$mff->ff_user_update = $this->session->userdata('UsPsCode');
			$mff->update();
			redirect($this->path.'/Field_manage/');
	}
	
	function v_manage_update($id)
	{
		$this->load->model($this->path.'/M_football_field', 'mff');
		$this->mff->ff_id = $id;
		$this->data['rs'] = $this->mff->get_by_key()->result();
		$this->output($this->path.'/v_manage_field_edit',$this->data);
	}

	function delete_field($id)
	{
		$this->load->model($this->path.'/M_football_field', 'mff');
		$mff = $this->mff;
		$mff->ff_id = $id;
		$mff->ff_status = "D";
		$mff->update_status();

		redirect($this->path.'/Field_manage/');
	} // end gender_delete

	function get_table_cost_config($id) {
		$this->load->model($this->path.'/M_cost_config', 'mcc');
		$this->mcc->cc_ff_id = $id;
	
		$result = $this->mcc->get_data_by_ff_id()->result();

		 echo json_encode($result);
	}

	function update_cost($id) {
		$this->load->model($this->path.'/M_cost_config', 'mcc');
		$temp = $this->input->post('table_data');
		$this->mcc->update_status_false($id);
		foreach($temp as $row) {
			$this->mcc->cc_ff_id = $row['cc_ff_id'];
			$this->mcc->cc_start_time = $row['cc_start_time'];
			$this->mcc->cc_end_time =  $row['cc_end_time'];
			$this->mcc->cc_cost =  $row['cc_cost'];
			$this->mcc->cc_type =  $row['cc_type'];
			$this->mcc->cc_user_update = $this->session->userdata('UsPsCode');
			$this->mcc->cc_status = 'Y';
			$this->mcc->insert();
		}
	}
}//end class
?>