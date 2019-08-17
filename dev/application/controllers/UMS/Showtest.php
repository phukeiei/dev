<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class Showtest extends UMS_Controller {

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
		$data['test']  = $this->m_umtest->get_all();
		
	// Output
		$this->output('UMS/v_ShowTest',$data);
	
	}
	
	public function add(){
	
		//$this->m_umtest->umtestID = $last+1;
		$this->m_umtest->TestNameT = $this->input->post('TestNameT');
		$this->m_umtest->TestNameE = $this->input->post('TestNameE');
		$this->m_umtest->Testno = $this->input->post('Testno');
		$this->m_umtest->insert();
		$data['OK'] = 1;
		$data['test']  = $this->m_umtest->get_all();
		// Output
			$this->output('UMS/v_ShowTest',$data);
	}
	
	public function edit($ID_TEST){
	// call old data want to edit
		$this->m_umtest->ID_TEST = $ID_TEST;
		$data['ID_TEST'] = $ID_TEST;
		$data['edit'] = $this->m_umtest->get_by_key() ->row_array();
	// Show All umtest in This System
		$data['test'] = $this->m_umtest->get_all();  	
		$this->output('UMS/v_showumtest_edit',$data);
		
	}
	
	public function update($ID_TEST){
	
		
	
	// Update to umtest
		$this->m_umtest->ID_TEST = $ID_TEST;
		$this->m_umtest->TestNameT = $this->input->post('TestNameT');
		$this->m_umtest->TestNameE = $this->input->post('TestNameE');
		$this->m_umtest->Testno = $this->input->post('Testno');
		$data['OK'] = 1;
		$this->m_umtest->update();
		$this->output('UMS/v_ShowTest',$data);
	}
	
	
	public function remove($umtestID){
		$this->m_umtest->umtestID=$umtestID;
		$this->m_umtest->delete();
		$data['OK'] = 1;
		$data['test']  = $this->m_umtest->get_all();
		$this->output('UMS/v_ShowTest',$data);
		
		
	}
	
	}
	?>