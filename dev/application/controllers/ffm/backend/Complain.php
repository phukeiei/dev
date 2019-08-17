<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// require(dirname(__FILE__).'/../../../UMS_Controller.php'); //สำหรับ Camp ที่หอ
require(dirname(__FILE__).'/../../UMS_Controller.php'); //สำหรับ Camp
/*
* Controller Complain
* @Auther : Jiramate Phuaphan
* @Edit Last Date : 
*/
class Complain extends UMS_Controller {
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
		$this->v_complain_menu();
	}

	function v_complain_menu()
	{
		$this->output($this->path.'/v_complain_menu',$this->data);
	}

	function v_complain_list()
	{
		$this->load->model($this->path.'/M_complain', 'mcp');
		$this->data['rs_comp'] = $this->mcp->get_table_complain()->result();
		$this->output($this->path.'/v_complain_list',$this->data);
	}

	
}//end class
?>