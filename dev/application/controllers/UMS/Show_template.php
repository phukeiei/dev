<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// require('../UMS_Controller.php');
require_once(dirname(__FILE__)."/../UMS_Controller.php");
class Show_template extends UMS_Controller {

// Create __construct for load model use in this controller
	public function __construct(){
		//call parent::__construct() for use $this->load
		parent::__construct();
		//$this->load->model('UMS/UMS_model');
		$this->load->model('UMS/m_umtest');
	
		
	}
	
	public function index(){
		$data['OK'] = 0;
	// Show All Part of This System
		// $data['test']  = $this->m_umtest->get_all();
		
	// Output
		$this->output_frontend('UMS/v_ShowTest',$data);
	
	}
	
	public function Components(){
		$data['OK'] = 0;
		// pre($data);
		$this->output_frontend('template_front/v_components',$data);
	}
	

	
}
	?>