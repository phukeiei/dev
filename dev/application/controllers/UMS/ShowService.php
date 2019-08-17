<!--ยังไม่แก้เพราะไม่รู้ว่ามีเพื่ออะไร-->

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('UMS_Controller.php');
class ShowService extends UMS_Controller {

	// Create __construct for load model use in this controller
	public function __construct(){
		//call parent::__construct() for use $this->load
		parent::__construct();
		$this->load->model('UMS/m_umservice');
		$this->load->model('UMS/m_umicon');
	}
	
	public function index(){
	// Show All service in This System
		$data['service'] = $this->m_umservice->get_all();  
		$data['showicon']=$this->m_umicon->get_all();
	//Output!
		$this->output('UMS/v_showService',$data);
	}
	
	public function add(){
	// Insert into umgroup
		$this->m_umservice->SvID = "";
		$this->m_umservice->SvNameT = $this->input->post('SvNameT');
		$this->m_umservice->SvNameE = $this->input->post('SvNameE');
		$this->m_umservice->SvURL = $this->input->post('SvURL');
		$this->m_umservice->SvIcon = $this->input->post('SvIcon');
		$this->m_umservice->insert();
	// refresh to index()
		redirect('UMS/showService', 'refresh');
	}
	
	public function edit($SvID){
	// call old data want to edit
		$data['showicon']=$this->m_umicon->get_all();
		$this->m_umservice->SvID = $SvID;
		$data['show'] = $this->m_umservice->get_by_key()->row_array();
	// Show All WorkGroup in This System
		$data['service'] = $this->m_umservice->get_all();  
	// Show Output!! to Edit Data
		$this->output('UMS/v_showService_edit',$data);
	}
	
	public function update($SvID){
	// Update to umgroup
		$this->m_umservice->SvID = $SvID;
		$this->m_umservice->SvNameT = $this->input->post('SvNameT');
		$this->m_umservice->SvNameE = $this->input->post('SvNameE');
		$this->m_umservice->SvURL = $this->input->post('SvURL');
		$this->m_umservice->SvIcon = $this->input->post('SvIcon');
		$this->m_umservice->update();
	//refresh to index()
		redirect('UMS/showService', 'refresh');
	}
	
	
	public function remove($SvID){
	// Remove into umgroup
		$this->m_umservice->SvID=$SvID;
		$this->m_umservice->delete();
	// refresh to index()
		redirect('UMS/showService', 'refresh');
		
	}
	
	
	
	
}