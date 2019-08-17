<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// require(dirname(__FILE__).'/../../../UMS_Controller.php'); //สำหรับ Camp ที่หอ
require(dirname(__FILE__).'/../../UMS_Controller.php'); //สำหรับ Camp
/*
* Controller Type_complain
* @Auther : Jiramate Phuaphan
* @Edit Last Date : 
*/
class Type_complain extends UMS_Controller {
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
		$this->v_complain_type();
	}

	function v_complain_type()
	{
		$this->load->model($this->path.'/M_type_complain', 'mtc');
		$this->data['rs'] = $this->mtc->get_all()->result();
		$this->output($this->path.'/v_complain_type',$this->data);
	}
	
	function delete_complain_type( $id ){
		$this->load->model($this->path .'/M_type_complain', 'mtc');
		$mtc = $this->mtc;
		$mtc->tp_id = $id;
		$mtc->delete();
		$this->data['dir'] = "ffm/backend";
		redirect($this->path.'/Type_complain');
	} // end complain_delete

	function insert_complain_type(){
		$this->load->model($this->path .'/M_type_complain','mtc');
		$mtc = $this->mtc;
		$mtc->tp_complain = $this->input->post('typecomment');
		$mtc->insert();
		redirect($this->path.'/Type_complain');
	}
	function type_complain_delete($id){
			// echo $id; die;
			$this->load->model($this->path.'/M_type_complain', 'mtc');
			$mtc = $this->mtc;
			$mtc->tp_id = $id;
			$mtc->complain_update();
		
			 redirect($this->path.'/Type_complain');
		} // end complain_delete


	////////////////FRZ ADD 19/05/2019
	function update_complain_type(){
		$this->load->model($this->path.'/M_type_complain','mtc');
		$mtc = $this->mtc;

		$mtc->tp_complain = $this->input->post('typecomment');
		$mtc->tp_id= $this->input->post('id_comment');
		$mtc->update_comment();

		redirect($this->path.'/Type_complain');

	}


}//end class
?>