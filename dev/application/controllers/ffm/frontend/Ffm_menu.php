<?php
include(dirname(__FILE__)."/../Ffm_Controller.php");
/*
* for test
* Base Data of ability
* @author phanuphan
* @Create Date 2562-05-15
*/
class Ffm_menu extends Ffm_Controller {

	protected $view;
	protected $model;
	protected $controller;

	public function __construct()
	{
        parent::__construct();
		$this->view = "ffm/fontend/for_test/";
		$this->model = "ffm/fontend/for_test/";
		$this->controller = "for_test/";
		$this->folder = "ffm/";
    }
	
	function index($abil_id=""){
		$this->load->model($this->model.'M_complain_font','cp');
		echo "UsID ".$this->session->userdata("UsID");
		echo "UsPsCode ".$this->session->userdata("UsPsCode");
		
		$rs_test = $this->cp->ffm->query("select * from hr_province");
		$data['test'] = "eadfas";
		$this->output_frontend($this->view.'for_test');
	}
	
	function sys_menu(){
		echo "<a href='".site_url("ffm/fontend/C_test/show")."' target='_blank'>แบบฟอร์มข้อมูล</a>";
	}
	
	function test_get_pic(){
		$ps_id = $this->session->userdata("UsPsCode");
		$this->load->model('hr/M_hr_person_detail','psd');
		
		$this->psd->psd_ps_id = $ps_id;
		$this->psd->get_by_key(true);
		echo site_url("hr/getIcon?type=picturePerson&image=".$this->psd->psd_picture);
		echo "<image src='".site_url("hr/getIcon?type=picturePerson&image=".$this->psd->psd_picture)."'";
	}
	
	function test_timepicker(){
		$data['test'] = "abc";
		$session = array("UsPsCode"=>24,"UsID"=>3);
		$this->session->set_userdata($session);
		$this->output_frontend('ffm/frontend/v_test_timepicker',$data);
	}
	
	function test_service(){
		$test = $this->calculate_cost('09:00:00','20:00:00',1,1);
		pre($test);
	}
}
?>
